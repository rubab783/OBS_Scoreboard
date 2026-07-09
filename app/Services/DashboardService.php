<?php

namespace App\Services;

use App\Models\Team;

class DashboardService
{
    public function getStats(): array
    {
        return [

            'teamsCount' => Team::count(),

            'activeMatches' => 0,

            'activeFeeds' => 0,

            'scheduledFeeds' => 0,

            'archivedFeeds' => 0,

            'latency' => '<20ms',

            'systemStatus' => 'Online',
        ];
    }
}