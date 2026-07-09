<?php

namespace Database\Seeders;

use App\Models\OverlayTemplate;
use Illuminate\Database\Seeder;

class OverlayTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            // ── Scoreboard ──────────────────────────────
            [
                'name' => 'Red Swish', 'slug' => 'red-swish', 'category' => 'scoreboard',
                'sport' => 'Football', 'accent_color' => '#ef4444', 'secondary_color' => '#2563eb',
                'layout_style' => 'bar-bottom-split',
                'config' => ['theme' => 'default', 'animation_style' => 'slide', 'show_logos' => true, 'show_timer' => true, 'show_score' => true, 'show_period' => true, 'show_sponsor' => false, 'show_ticker' => false],
            ],
            [
                'name' => 'Edge Series', 'slug' => 'edge-series', 'category' => 'scoreboard',
                'sport' => 'Basketball', 'accent_color' => '#2563eb', 'secondary_color' => '#f59e0b',
                'layout_style' => 'bar-bottom-split',
                'config' => ['theme' => 'minimal', 'animation_style' => 'fade', 'show_logos' => true, 'show_timer' => true, 'show_score' => true, 'show_period' => true, 'show_sponsor' => false, 'show_ticker' => false],
            ],
            [
                'name' => 'Dark Blue', 'slug' => 'dark-blue-scoreboard', 'category' => 'scoreboard',
                'sport' => null, 'accent_color' => '#1d4ed8', 'secondary_color' => '#f59e0b',
                'layout_style' => 'pill-top-split',
                'config' => ['theme' => 'broadcast-bold', 'animation_style' => 'fade', 'show_logos' => false, 'show_timer' => true, 'show_score' => true, 'show_period' => true, 'show_sponsor' => false, 'show_ticker' => false],
            ],

            // ── Team ──────────────────────────────
            [
                'name' => 'Starting Lineup', 'slug' => 'starting-lineup', 'category' => 'team',
                'sport' => null, 'accent_color' => '#7C3AED', 'secondary_color' => '#312e81',
                'layout_style' => 'list-panel',
                'config' => ['theme' => 'default', 'animation_style' => 'slide', 'show_logos' => false, 'show_timer' => false, 'show_score' => false, 'show_period' => false, 'show_sponsor' => false, 'show_ticker' => false],
            ],
            [
                'name' => 'Team Card', 'slug' => 'team-card', 'category' => 'team',
                'sport' => 'Football', 'accent_color' => '#2563eb', 'secondary_color' => '#0f172a',
                'layout_style' => 'card-team',
                'config' => ['theme' => 'minimal', 'animation_style' => 'fade', 'show_logos' => true, 'show_timer' => false, 'show_score' => false, 'show_period' => false, 'show_sponsor' => false, 'show_ticker' => false],
            ],

            // ── Lower Third ──────────────────────────────
            [
                'name' => 'Blue Announcement', 'slug' => 'blue-announcement', 'category' => 'lower_third',
                'sport' => null, 'accent_color' => '#2563eb', 'secondary_color' => null,
                'layout_style' => 'pill-bottom-left',
                'config' => ['theme' => 'default', 'animation_style' => 'slide', 'show_logos' => false, 'show_timer' => false, 'show_score' => false, 'show_period' => false, 'show_sponsor' => false, 'show_ticker' => true, 'ticker_text' => 'Announcement text goes here'],
            ],
            [
                'name' => 'Black Pill', 'slug' => 'black-pill', 'category' => 'lower_third',
                'sport' => null, 'accent_color' => '#111827', 'secondary_color' => null,
                'layout_style' => 'pill-bottom-center',
                'config' => ['theme' => 'minimal', 'animation_style' => 'fade', 'show_logos' => false, 'show_timer' => false, 'show_score' => false, 'show_period' => false, 'show_sponsor' => false, 'show_ticker' => true, 'ticker_text' => 'Main announcement part'],
            ],
            [
                'name' => 'Green Light', 'slug' => 'green-light', 'category' => 'lower_third',
                'sport' => null, 'accent_color' => '#16a34a', 'secondary_color' => null,
                'layout_style' => 'banner-bottom',
                'config' => ['theme' => 'default', 'animation_style' => 'slide', 'show_logos' => false, 'show_timer' => false, 'show_score' => false, 'show_period' => false, 'show_sponsor' => false, 'show_ticker' => true, 'ticker_text' => 'Announcement title goes here'],
            ],

            // ── Sponsor ──────────────────────────────
            [
                'name' => 'Sponsor Display', 'slug' => 'sponsor-display', 'category' => 'sponsor',
                'sport' => null, 'accent_color' => '#94a3b8', 'secondary_color' => null,
                'layout_style' => 'corner-badge',
                'config' => ['theme' => 'minimal', 'animation_style' => 'fade', 'show_logos' => false, 'show_timer' => false, 'show_score' => false, 'show_period' => false, 'show_sponsor' => true, 'show_ticker' => false],
            ],

            // ── Penalties ──────────────────────────────
            [
                'name' => 'Red Card', 'slug' => 'red-card', 'category' => 'penalties',
                'sport' => 'Football', 'accent_color' => '#dc2626', 'secondary_color' => null,
                'layout_style' => 'card-penalty',
                'config' => ['theme' => 'broadcast-bold', 'animation_style' => 'slide', 'show_logos' => false, 'show_timer' => false, 'show_score' => false, 'show_period' => false, 'show_sponsor' => false, 'show_ticker' => false],
            ],
            [
                'name' => 'Yellow Card', 'slug' => 'yellow-card', 'category' => 'penalties',
                'sport' => 'Football', 'accent_color' => '#eab308', 'secondary_color' => null,
                'layout_style' => 'card-penalty',
                'config' => ['theme' => 'broadcast-bold', 'animation_style' => 'slide', 'show_logos' => false, 'show_timer' => false, 'show_score' => false, 'show_period' => false, 'show_sponsor' => false, 'show_ticker' => false],
            ],

            // ── Titles ──────────────────────────────
            [
                'name' => 'Title Fullscreen Dark Blue', 'slug' => 'title-fullscreen-dark-blue', 'category' => 'titles',
                'sport' => null, 'accent_color' => '#1d4ed8', 'secondary_color' => '#0f172a',
                'layout_style' => 'fullscreen-center',
                'config' => ['theme' => 'broadcast-bold', 'animation_style' => 'fade', 'show_logos' => true, 'show_timer' => false, 'show_score' => false, 'show_period' => false, 'show_sponsor' => false, 'show_ticker' => false],
            ],

            // ── Substitution ──────────────────────────────
            [
                'name' => 'Navy Angular', 'slug' => 'navy-angular', 'category' => 'substitution',
                'sport' => 'Football', 'accent_color' => '#1e3a8a', 'secondary_color' => '#dc2626',
                'layout_style' => 'arrow-card',
                'config' => ['theme' => 'default', 'animation_style' => 'slide', 'show_logos' => false, 'show_timer' => false, 'show_score' => false, 'show_period' => false, 'show_sponsor' => false, 'show_ticker' => false],
            ],
        ];

        foreach ($templates as $template) {
            OverlayTemplate::updateOrCreate(
                ['slug' => $template['slug']],
                $template
            );
        }
    }
}