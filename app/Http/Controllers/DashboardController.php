<?php

namespace App\Http\Controllers;

use App\Models\GameMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the Live Control Center dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // Fetch all matches belonging to the authenticated user,
        // ordered by most-recently-created first.
            $matches = GameMatch::where('user_id', $user->id)
            ->orderByRaw("FIELD(status, 'live', 'scheduled', 'ended')")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.index', [
            'matches'        => $matches,
            'activeCount'    => $matches->where('status', 'live')->count(),
            'scheduledCount' => $matches->where('status', 'scheduled')->count(),
            'archivedCount'  => $matches->where('status', 'ended')->count(),
        ]);
    }
}