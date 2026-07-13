<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
 public function index(Request $request)
{
    $teams = Team::withCount('players')
        ->when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('short_name', 'like', '%' . $request->search . '%');
        })
        ->latest()
        ->paginate(10);

    return view('teams.index', compact('teams'));
}

    public function create()
    {
        return view('teams.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'short_name'      => ['required', 'string', 'max:10'],
            'logo'            => ['nullable', 'image', 'max:2048'],
            'primary_color'   => ['required'],
            'secondary_color' => ['nullable'],
            'description'     => ['nullable', 'string'],
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request
                ->file('logo')
                ->store('teams', 'public');
        }

        Team::create($validated);

        return redirect()
            ->route('teams.index')
            ->with('success', 'Team created successfully.');
    }

    public function show(Team $team)
    {
        return redirect()->route('teams.edit', $team);
    }

    public function edit(Team $team)
    {
        return view('teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'short_name'      => ['required', 'string', 'max:10'],
            'logo'            => ['nullable', 'image', 'max:2048'],
            'primary_color'   => ['required'],
            'secondary_color' => ['nullable'],
            'description'     => ['nullable', 'string'],
            'is_active'       => ['nullable'],
        ]);

        if ($request->hasFile('logo')) {

            if ($team->logo) {
                Storage::disk('public')->delete($team->logo);
            }

            $validated['logo'] = $request
                ->file('logo')
                ->store('teams', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');

        $team->update($validated);

        return redirect()
            ->route('teams.index')
            ->with('success', 'Team updated successfully.');
    }

    public function destroy(Team $team)
    {
        if ($team->logo) {
            Storage::disk('public')->delete($team->logo);
        }

        $team->delete();

        return redirect()
            ->route('teams.index')
            ->with('success', 'Team deleted successfully.');
    }
}
