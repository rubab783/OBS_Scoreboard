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
        // ordered so live events surface first, then paused, then
        // scheduled, then archived — most recent within each group.
        $matches = GameMatch::where('user_id', $user->id)
            ->orderByRaw("FIELD(status, 'live', 'paused', 'scheduled', 'ended')")
            ->orderBy('created_at', 'desc')
            ->get();

        // NOTE: 'paused' is a valid status (see MatchController) but was
        // previously not counted anywhere on the dashboard — a paused
        // match simply vanished from every stat card. Counting it here
        // as part of "live" keeps the top-line number honest (still on
        // air, just not actively running) while `pausedCount` is kept
        // separately in case the UI wants to call it out.
        $liveCount      = $matches->whereIn('status', ['live', 'paused'])->count();
        $pausedCount    = $matches->where('status', 'paused')->count();
        $scheduledCount = $matches->where('status', 'scheduled')->count();
        $archivedCount  = $matches->where('status', 'ended')->count();

        // Simple week-over-week trend for the "Live Events" stat card so
        // it isn't just a bare number — gives the operator a sense of
        // whether activity is picking up or slowing down.
        $createdThisWeek = $matches->where('created_at', '>=', now()->startOfWeek())->count();
        $createdLastWeek = $matches->whereBetween('created_at', [
            now()->subWeek()->startOfWeek(),
            now()->subWeek()->endOfWeek(),
        ])->count();

        return view('dashboard.index', [
            'matches'         => $matches,
            'activeCount'     => $liveCount,
            'pausedCount'     => $pausedCount,
            'scheduledCount'  => $scheduledCount,
            'archivedCount'   => $archivedCount,
            'totalCount'      => $matches->count(),
            'createdThisWeek' => $createdThisWeek,
            'createdLastWeek' => $createdLastWeek,
        ]);
    }
}
