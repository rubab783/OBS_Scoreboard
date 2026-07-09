<?php

namespace App\Http\Controllers;

use App\Models\GameMatch;
use App\Models\OverlaySetting;
use App\Models\OverlayTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OverlayController extends Controller
{
    /**
     * List all of the authenticated user's matches for overlay configuration.
     */
    public function index()
    {
        $matches = GameMatch::where('user_id', auth()->id())
            ->with('overlaySetting')
            ->orderByRaw("FIELD(status, 'live', 'scheduled', 'ended')")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('overlay.index', [
            'matches' => $matches,
        ]);
    }

    /**
     * Show the overlay configuration form for a specific match.
     * Creates a default OverlaySetting row on first visit if one
     * doesn't exist yet, so the form never breaks on a fresh match.
     */
    public function edit(GameMatch $match)
    {
        abort_unless($match->user_id === auth()->id(), 403);

        $settings = OverlaySetting::firstOrCreate(
            ['match_id' => $match->id]
        );

        return view('overlay.config', [
            'match'    => $match,
            'settings' => $settings,
        ]);
    }

    /**
     * Save overlay configuration for a specific match.
     */
    public function update(Request $request, GameMatch $match)
    {
        abort_unless($match->user_id === auth()->id(), 403);

        $validated = $request->validate([
            'theme'           => ['required', 'in:default,minimal,broadcast-bold'],
            'animation_style' => ['required', 'in:none,fade,slide'],
            'accent_color'    => ['nullable', 'string', 'max:20'],
            'show_logos'      => ['nullable', 'boolean'],
            'show_timer'      => ['nullable', 'boolean'],
            'show_score'      => ['nullable', 'boolean'],
            'show_period'     => ['nullable', 'boolean'],
            'show_sponsor'    => ['nullable', 'boolean'],
            'show_ticker'     => ['nullable', 'boolean'],
            'sponsor_logo'    => ['nullable', 'image', 'max:2048'],
            'ticker_text'     => ['nullable', 'string', 'max:255'],
        ]);

        $settings = OverlaySetting::firstOrCreate(['match_id' => $match->id]);

        $data = [
            'theme'           => $validated['theme'],
            'animation_style' => $validated['animation_style'],
            'accent_color'    => $validated['accent_color'] ?? null,
            'show_logos'      => $request->boolean('show_logos'),
            'show_timer'      => $request->boolean('show_timer'),
            'show_score'      => $request->boolean('show_score'),
            'show_period'     => $request->boolean('show_period'),
            'show_sponsor'    => $request->boolean('show_sponsor'),
            'show_ticker'     => $request->boolean('show_ticker'),
            'ticker_text'     => $validated['ticker_text'] ?? null,
        ];

        if ($request->hasFile('sponsor_logo')) {
            if ($settings->sponsor_logo) {
                Storage::disk('public')->delete($settings->sponsor_logo);
            }

            $data['sponsor_logo'] = $request->file('sponsor_logo')->store('overlays/sponsors', 'public');
        }

        $settings->update($data);

        return redirect()
            ->route('overlay.edit', $match)
            ->with('success', 'Overlay settings saved successfully.');
    }

    /**
     * Toggle the "On Air" live state for a match's overlay.
     * Called via fetch from the config page — returns JSON, no redirect.
     */
    public function toggleLive(Request $request, GameMatch $match)
    {
        abort_unless($match->user_id === auth()->id(), 403);

        $validated = $request->validate([
            'is_live' => ['required', 'boolean'],
        ]);

        $settings = OverlaySetting::firstOrCreate(['match_id' => $match->id]);
        $settings->update(['is_live' => $validated['is_live']]);

        return response()->json([
            'success' => true,
            'is_live' => $settings->is_live,
        ]);
    }

    /**
     * Render the public, unauthenticated broadcast overlay for a match.
     * This is the page loaded by OBS Studio's Browser Source.
     */
    public function render(GameMatch $match)
    {
        $match->load(['teamA', 'teamB']);

        $settings = OverlaySetting::firstOrCreate(['match_id' => $match->id]);

        return view('overlay.render', [
            'match'    => $match,
            'settings' => $settings,
        ]);
    }

    /**
     * Step 1 of the template wizard — confirm/select the sport.
     */
    public function selectSport(GameMatch $match)
    {
        abort_unless($match->user_id === auth()->id(), 403);

        return view('overlay.select-sport', [
            'match'  => $match,
            'sports' => ['Football', 'Basketball', 'Cricket', 'Esports', 'Volleyball', 'Rugby', 'Hockey', 'Tennis'],
        ]);
    }

    /**
     * Persist the chosen sport, then move to Step 2.
     */
    public function updateSport(Request $request, GameMatch $match)
    {
        abort_unless($match->user_id === auth()->id(), 403);

        $validated = $request->validate([
            'sport' => ['required', 'string', 'max:50'],
        ]);

        $match->update(['sport' => $validated['sport']]);

        return redirect()->route('overlay.select-template', $match);
    }

    /**
     * Step 2 — categorized, searchable template gallery filtered by sport.
     */
    public function selectTemplate(Request $request, GameMatch $match)
    {
        abort_unless($match->user_id === auth()->id(), 403);

        $category = $request->query('category');

        $templates = OverlayTemplate::active()
            ->forSport($match->sport)
            ->category($category)
            ->orderBy('category')
            ->orderBy('name')
            ->get();

        $categories = [
            'scoreboard'   => 'Scoreboard',
            'team'         => 'Team',
            'lower_third'  => 'Lower Third',
            'sponsor'      => 'Sponsor',
            'penalties'    => 'Penalties',
            'titles'       => 'Titles',
            'substitution' => 'Substitution',
        ];

        return view('overlay.select-template', [
            'match'           => $match,
            'templates'       => $templates,
            'categories'      => $categories,
            'activeCategory'  => $category,
        ]);
    }

    /**
     * Apply a chosen template's config to the match's overlay settings,
     * then hand off to the existing Overlay Config page (Step 3) for
     * final review/editing.
     */
    public function applyTemplate(GameMatch $match, OverlayTemplate $template)
    {
        abort_unless($match->user_id === auth()->id(), 403);

        $settings = OverlaySetting::firstOrCreate(['match_id' => $match->id]);

        $settings->update(array_merge($template->config, [
            'overlay_template_id' => $template->id,
            'accent_color'        => $template->accent_color,
        ]));

        return redirect()
            ->route('overlay.edit', $match)
            ->with('success', "Template \"{$template->name}\" applied. Review and adjust below.");
    }
}