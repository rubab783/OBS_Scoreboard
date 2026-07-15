<?php

namespace App\Http\Controllers;

use App\Events\MatchUpdated;
use App\Models\GameMatch;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('matches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'sport'    => ['required', 'string', 'max:50'],
            'league'   => ['nullable', 'string', 'max:255'],
            'stage'    => ['nullable', 'string', 'max:255'],
            'venue'    => ['nullable', 'string', 'max:255'],
            'team_a'   => ['nullable', 'string', 'max:255'],
            'team_b'   => ['nullable', 'string', 'max:255'],
            'color_a'  => ['nullable', 'string', 'max:20'],
            'color_b'  => ['nullable', 'string', 'max:20'],
            'team_a_logo' => ['nullable', 'image', 'max:2048'],
            'team_b_logo' => ['nullable', 'image', 'max:2048'],
            'duration' => ['required', 'integer', 'min:1'],
        ]);

        $matchData = [
            'user_id'          => auth()->id(),
            'name'             => $validated['name'],
            'sport'            => $validated['sport'],
            'league'           => $validated['league'] ?? null,
            'stage'            => $validated['stage'] ?? null,
            'venue'            => $validated['venue'] ?? null,
            'team_a'           => $validated['team_a'] ?? null,
            'team_b'           => $validated['team_b'] ?? null,
            'team_a_color'     => $validated['color_a'] ?? '#7C3AED',
            'team_b_color'     => $validated['color_b'] ?? '#2563EB',
            'duration_minutes' => $validated['duration'],
            'status'           => 'scheduled',
            'score_a'          => 0,
            'score_b'          => 0,
        ];

        if ($request->hasFile('team_a_logo')) {
            $matchData['team_a_logo'] = $request->file('team_a_logo')->store('matches/logos', 'public');
        }

        if ($request->hasFile('team_b_logo')) {
            $matchData['team_b_logo'] = $request->file('team_b_logo')->store('matches/logos', 'public');
        }

        $match = GameMatch::create($matchData);

        return redirect()
            ->route('matches.control', $match)
            ->with('success', 'Broadcast event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Display the live Match Control Panel for a given match.
     */
    public function control(GameMatch $match)
    {
        abort_unless($match->user_id === auth()->id(), 403);

        $match->load(['teamA', 'teamB']);

        // If the timer was left running, calculate true elapsed seconds
        // based on real time passed since the last save — prevents the
        // clock from appearing frozen/stale after a page refresh.
        if ($match->timer_status === 'running' && $match->clock_updated_at) {
            $secondsSinceUpdate = now()->diffInSeconds($match->clock_updated_at);
            $match->clock_seconds += $secondsSinceUpdate;
        }

        return view('matches.control', [
            'match' => $match,
        ]);
    }

    /**
     * Handle a live update from the Match Control Panel.
     *
     * Accepts one of four update "types" in a single unified endpoint:
     *   - score   { type: 'score', team: 'a'|'b', value: int }
     *   - timer   { type: 'timer', clock_seconds: int, timer_status: string }
     *   - status  { type: 'status', status: string }
     *   - period  { type: 'period', period: string }
     *
     * Every successful update also broadcasts a MatchUpdated event on the
     * match's public `scoreboard.{id}` channel so the OBS overlay reflects
     * the change immediately, without needing a manual browser-source
     * refresh.
     */
    public function controlUpdate(Request $request, GameMatch $match)
    {
        abort_unless($match->user_id === auth()->id(), 403);

        $validated = $request->validate([
            'type' => ['required', Rule::in(['score', 'timer', 'status', 'period'])],

            'team'  => ['required_if:type,score', Rule::in(['a', 'b'])],
            'value' => ['required_if:type,score', 'integer', 'min:0'],

            'clock_seconds' => ['required_if:type,timer', 'integer', 'min:0'],
            'timer_status'  => ['required_if:type,timer', Rule::in(['stopped', 'running', 'paused'])],

            'status' => ['required_if:type,status', Rule::in(['live', 'paused', 'ended', 'scheduled'])],

            'period' => ['required_if:type,period', 'string', 'max:50'],
        ]);

        match ($validated['type']) {
            'score' => $match->update([
                $validated['team'] === 'a' ? 'score_a' : 'score_b' => $validated['value'],
            ]),

            'timer' => $match->update([
                'clock_seconds'    => $validated['clock_seconds'],
                'timer_status'     => $validated['timer_status'],
                'clock_updated_at' => now(),
            ]),

            'status' => $match->update([
                'status' => $validated['status'],
            ]),

            'period' => $match->update([
                'period' => $validated['period'],
            ]),
        };

        $match = $match->fresh(['teamA', 'teamB']);

        // Broadcast a minimal, type-specific payload rather than the whole
        // match model — keeps the socket message small and means the
        // overlay only has to reconcile the field that actually changed.
        $broadcastPayload = match ($validated['type']) {
            'score'  => ['team' => $validated['team'], 'value' => $validated['value']],
            'timer'  => ['clock_seconds' => $match->clock_seconds, 'timer_status' => $match->timer_status],
            'status' => ['status' => $match->status],
            'period' => ['period' => $match->period],
        };

        broadcast(new MatchUpdated($match, $validated['type'], $broadcastPayload));

        return response()->json([
            'success' => true,
            'match'   => $match,
        ]);
    }
}