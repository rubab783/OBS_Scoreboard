<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{
public function index(Request $request)
{
    $players = Player::with('team')
        ->when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        })
        ->latest()
        ->paginate(15);

    return view('players.index', [
        'players'      => $players,
        'totalPlayers' => Player::count(),
        'totalTeams'   => Team::count(),
        'captains'     => Player::where('is_captain', true)->count(),
        'starters'     => Player::where('is_starter', true)->count(),
    ]);
}

    public function create()
    {
        $teams = Team::orderBy('name')->get();

        return view('players.create', compact('teams'));
    }

    public function store(Request $request)
{
     $validated = $request->validate([
            'team_id' => ['required', 'exists:teams,id'],
            'name' => ['required', 'string', 'max:255'],
            'jersey_number' => ['nullable', 'integer'],
            'position' => ['nullable', 'string', 'max:100'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'is_captain' => ['nullable', 'boolean'],
            'is_starter' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')
                ->store('players', 'public');
        }

        $validated['is_captain'] = $request->boolean('is_captain');
        $validated['is_starter'] = $request->boolean('is_starter');

    Player::create($validated);

     return redirect()
        ->route('players.index')
        ->with('success', 'Player created successfully.');
}

    public function edit(Player $player)
    {
        $teams = Team::orderBy('name')->get();

        return view('players.edit', compact('player', 'teams'));
    }

   public function update(Request $request, Player $player)
{
    $validated = $request->validate([
        'team_id' => ['required', 'exists:teams,id'],
        'name' => ['required', 'string', 'max:255'],
        'jersey_number' => ['nullable', 'integer'],
        'position' => ['nullable', 'string', 'max:100'],
        'photo' => ['nullable', 'image', 'max:2048'],
        'is_captain' => ['nullable', 'boolean'],
        'is_starter' => ['nullable', 'boolean'],
    ]);
     if ($request->hasFile('photo')) {

        if ($player->photo) {
            Storage::disk('public')->delete($player->photo);
        }

        $validated['photo'] = $request
            ->file('photo')
            ->store('players', 'public');
    }  $validated['is_captain'] = $request->boolean('is_captain');
    $validated['is_starter'] = $request->boolean('is_starter');

    $player->update($validated);
  return redirect()
        ->route('players.index')
        ->with('success', 'Player updated successfully.');
}

    public function destroy(Player $player)
    {
        if ($player->photo) {
            Storage::disk('public')->delete($player->photo);
        }

        $player->delete();

        return back()->with('success', 'Player deleted.');
    }
}