<?php

namespace Database\Seeders;

use App\Models\OverlayTemplate;
use Illuminate\Database\Seeder;

class OverlayTemplateSeeder extends Seeder
{
    public function run(): void
    {
        OverlayTemplate::query()->delete();

        $templates = [

            /*
            |--------------------------------------------------------------------------
            | Scoreboard
            |--------------------------------------------------------------------------
            */

            [
                'name' => 'Red Swish',
                'slug' => 'red-swish',
                'category' => 'scoreboard',
                'sport' => 'Football',
                'thumbnail' => null,
                'accent_color' => '#ef4444',
                'secondary_color' => '#2563eb',
                'layout_style' => 'bar-bottom-split',
                'blade_view' => 'scoreboard.red-swish',
                'css_file' => 'overlay/templates/red-swish.css',
                'js_file' => null,
                'config' => [
                    'theme' => 'default',
                    'animation_style' => 'slide',
                    'show_logos' => true,
                    'show_timer' => true,
                    'show_score' => true,
                    'show_period' => true,
                    'show_sponsor' => false,
                    'show_ticker' => false,
                ],
                'is_active' => true,
            ],

            [
                'name' => 'Edge Series',
                'slug' => 'edge-series',
                'category' => 'scoreboard',
                'sport' => 'Basketball',
                'thumbnail' => null,
                'accent_color' => '#2563eb',
                'secondary_color' => '#f59e0b',
                'layout_style' => 'bar-bottom-split',
                'blade_view' => 'scoreboard.edge-series',
                'css_file' => 'overlay/templates/edge-series.css',
                'js_file' => null,
                'config' => [
                    'theme' => 'minimal',
                    'animation_style' => 'fade',
                    'show_logos' => true,
                    'show_timer' => true,
                    'show_score' => true,
                    'show_period' => true,
                    'show_sponsor' => false,
                    'show_ticker' => false,
                ],
                'is_active' => true,
            ],

            [
                'name' => 'Dark Blue',
                'slug' => 'dark-blue-scoreboard',
                'category' => 'scoreboard',
                'sport' => null,
                'thumbnail' => null,
                'accent_color' => '#1d4ed8',
                'secondary_color' => '#f59e0b',
                'layout_style' => 'pill-top-split',
                'blade_view' => 'scoreboard.blue-black',
                'css_file' => 'overlay/templates/blue-black.css',
                'js_file' => null,
                'config' => [
                    'theme' => 'broadcast-bold',
                    'animation_style' => 'fade',
                    'show_logos' => false,
                    'show_timer' => true,
                    'show_score' => true,
                    'show_period' => true,
                    'show_sponsor' => false,
                    'show_ticker' => false,
                ],
                'is_active' => true,
            ],
            /*
            |--------------------------------------------------------------------------
            | Team
            |--------------------------------------------------------------------------
            */

            [
                'name' => 'Starting Lineup',
                'slug' => 'starting-lineup',
                'category' => 'team',
                'sport' => null,
                'thumbnail' => null,
                'accent_color' => '#7C3AED',
                'secondary_color' => '#312e81',
                'layout_style' => 'list-panel',
                'blade_view' => 'team.starting-lineup',
                'css_file' => 'overlay/templates/starting-lineup.css',
                'js_file' => null,
                'config' => [
                    'theme' => 'default',
                    'animation_style' => 'slide',
                    'show_logos' => false,
                    'show_timer' => false,
                    'show_score' => false,
                    'show_period' => false,
                    'show_sponsor' => false,
                    'show_ticker' => false,
                ],
                'is_active' => true,
            ],

            [
                'name' => 'Team Card',
                'slug' => 'team-card',
                'category' => 'team',
                'sport' => 'Football',
                'thumbnail' => null,
                'accent_color' => '#2563eb',
                'secondary_color' => '#0f172a',
                'layout_style' => 'card-team',
                'blade_view' => 'team.team-card',
                'css_file' => 'overlay/templates/team-card.css',
                'js_file' => null,
                'config' => [
                    'theme' => 'minimal',
                    'animation_style' => 'fade',
                    'show_logos' => true,
                    'show_timer' => false,
                    'show_score' => false,
                    'show_period' => false,
                    'show_sponsor' => false,
                    'show_ticker' => false,
                ],
                'is_active' => true,
            ],

            /*
            |--------------------------------------------------------------------------
            | Lower Third
            |--------------------------------------------------------------------------
            */

            [
                'name' => 'Blue Announcement',
                'slug' => 'blue-announcement',
                'category' => 'lower_third',
                'sport' => null,
                'thumbnail' => null,
                'accent_color' => '#2563eb',
                'secondary_color' => null,
                'layout_style' => 'pill-bottom-left',
                'blade_view' => 'lower-third.blue-announcement',
                'css_file' => 'overlay/templates/blue-announcement.css',
                'js_file' => null,
                'config' => [
                    'theme' => 'default',
                    'animation_style' => 'slide',
                    'show_logos' => false,
                    'show_timer' => false,
                    'show_score' => false,
                    'show_period' => false,
                    'show_sponsor' => false,
                    'show_ticker' => true,
                    'ticker_text' => 'Announcement text goes here',
                ],
                'is_active' => true,
            ],

            [
                'name' => 'Black Pill',
                'slug' => 'black-pill',
                'category' => 'lower_third',
                'sport' => null,
                'thumbnail' => null,
                'accent_color' => '#111827',
                'secondary_color' => null,
                'layout_style' => 'pill-bottom-center',
                'blade_view' => 'lower-third.black-pill',
                'css_file' => 'overlay/templates/black-pill.css',
                'js_file' => null,
                'config' => [
                    'theme' => 'minimal',
                    'animation_style' => 'fade',
                    'show_logos' => false,
                    'show_timer' => false,
                    'show_score' => false,
                    'show_period' => false,
                    'show_sponsor' => false,
                    'show_ticker' => true,
                    'ticker_text' => 'Main announcement part',
                ],
                'is_active' => true,
            ],

            [
                'name' => 'Green Light',
                'slug' => 'green-light',
                'category' => 'lower_third',
                'sport' => null,
                'thumbnail' => null,
                'accent_color' => '#16a34a',
                'secondary_color' => null,
                'layout_style' => 'banner-bottom',
                'blade_view' => 'lower-third.green-light',
                'css_file' => 'overlay/templates/green-light.css',
                'js_file' => null,
                'config' => [
                    'theme' => 'default',
                    'animation_style' => 'slide',
                    'show_logos' => false,
                    'show_timer' => false,
                    'show_score' => false,
                    'show_period' => false,
                    'show_sponsor' => false,
                    'show_ticker' => true,
                    'ticker_text' => 'Announcement title goes here',
                ],
                'is_active' => true,
            ],
                        // ─────────────────────────────────────────────
            // Sponsor
            // ─────────────────────────────────────────────
            [
                'name' => 'Sponsor Corner',
                'slug' => 'sponsor-corner',
                'category' => 'sponsor',
                'sport' => null,
                'accent_color' => '#0f172a',
                'secondary_color' => '#f59e0b',
                'layout_style' => 'corner-badge',
                'blade_view' => 'sponsor.corner-badge',
                'config' => [
                    'theme' => 'minimal',
                    'animation_style' => 'fade',
                    'show_logos' => false,
                    'show_timer' => false,
                    'show_score' => false,
                    'show_period' => false,
                    'show_sponsor' => true,
                    'show_ticker' => false,
                ],
            ],
            [
                'name' => 'Sponsor Lower Banner',
                'slug' => 'sponsor-lower-banner',
                'category' => 'sponsor',
                'sport' => null,
                'accent_color' => '#2563eb',
                'secondary_color' => '#0f172a',
                'layout_style' => 'banner-bottom',
                'blade_view' => 'sponsor.lower-banner',
                'config' => [
                    'theme' => 'default',
                    'animation_style' => 'slide',
                    'show_logos' => false,
                    'show_timer' => false,
                    'show_score' => false,
                    'show_period' => false,
                    'show_sponsor' => true,
                    'show_ticker' => false,
                ],
            ],

            // ─────────────────────────────────────────────
            // Penalties
            // ─────────────────────────────────────────────
            [
                'name' => 'Red Card',
                'slug' => 'red-card',
                'category' => 'penalties',
                'sport' => 'Football',
                'accent_color' => '#dc2626',
                'secondary_color' => '#111827',
                'layout_style' => 'card-penalty',
                'blade_view' => 'penalties.red-card',
                'config' => [
                    'theme' => 'broadcast-bold',
                    'animation_style' => 'slide',
                    'show_logos' => false,
                    'show_timer' => false,
                    'show_score' => false,
                    'show_period' => false,
                    'show_sponsor' => false,
                    'show_ticker' => false,
                ],
            ],
            [
                'name' => 'Yellow Card',
                'slug' => 'yellow-card',
                'category' => 'penalties',
                'sport' => 'Football',
                'accent_color' => '#facc15',
                'secondary_color' => '#111827',
                'layout_style' => 'card-penalty',
                'blade_view' => 'penalties.yellow-card',
                'config' => [
                    'theme' => 'broadcast-bold',
                    'animation_style' => 'slide',
                    'show_logos' => false,
                    'show_timer' => false,
                    'show_score' => false,
                    'show_period' => false,
                    'show_sponsor' => false,
                    'show_ticker' => false,
                ],
            ], 
                        // ─────────────────────────────────────────────
            // Titles
            // ─────────────────────────────────────────────

            [
                'name' => 'Blue Black Title',
                'slug' => 'blue-black-title',
                'category' => 'titles',
                'sport' => null,
                'accent_color' => '#2563eb',
                'secondary_color' => '#111827',
                'layout_style' => 'fullscreen-center',
                'blade_view' => 'titles.blue-black',
                'css_file' => 'overlay/templates/blue-black.css',
                'js_file' => null,
                'config' => [
                    'theme' => 'broadcast-bold',
                    'animation_style' => 'fade',
                    'show_logos' => true,
                    'show_timer' => false,
                    'show_score' => false,
                    'show_period' => false,
                    'show_sponsor' => false,
                    'show_ticker' => false,
                ],
            ],

            [
                'name' => 'Modern Title',
                'slug' => 'modern-title',
                'category' => 'titles',
                'sport' => null,
                'accent_color' => '#7c3aed',
                'secondary_color' => '#312e81',
                'layout_style' => 'fullscreen-center',
                'blade_view' => 'titles.modern',
                'css_file' => 'overlay/templates/substitution-modern.css',
                'js_file' => null,
                'config' => [
                    'theme' => 'default',
                    'animation_style' => 'slide',
                    'show_logos' => false,
                    'show_timer' => false,
                    'show_score' => false,
                    'show_period' => false,
                    'show_sponsor' => false,
                    'show_ticker' => false,
                ],
            ],

            [
                'name' => 'Minimal Title',
                'slug' => 'minimal-title',
                'category' => 'titles',
                'sport' => null,
                'accent_color' => '#0f172a',
                'secondary_color' => '#475569',
                'layout_style' => 'fullscreen-center',
                'blade_view' => 'titles.minimal',
                'css_file' => 'overlay/templates/minimal.css',
                'js_file' => null,
                'config' => [
                    'theme' => 'minimal',
                    'animation_style' => 'fade',
                    'show_logos' => false,
                    'show_timer' => false,
                    'show_score' => false,
                    'show_period' => false,
                    'show_sponsor' => false,
                    'show_ticker' => false,
                ],
            ],

            // ─────────────────────────────────────────────
            // Substitution
            // ─────────────────────────────────────────────

            [
                'name' => 'Blue Black Substitution',
                'slug' => 'blue-black-substitution',
                'category' => 'substitution',
                'sport' => 'Football',
                'accent_color' => '#2563eb',
                'secondary_color' => '#dc2626',
                'layout_style' => 'arrow-card',
                'blade_view' => 'substitution.blue-black',
                'css_file' => 'overlay/templates/substitution-blue-black.css',
                'js_file' => null,
                'config' => [
                    'theme' => 'default',
                    'animation_style' => 'slide',
                    'show_logos' => false,
                    'show_timer' => false,
                    'show_score' => false,
                    'show_period' => false,
                    'show_sponsor' => false,
                    'show_ticker' => false,
                ],
            ],

            [
                'name' => 'Modern Substitution',
                'slug' => 'modern-substitution',
                'category' => 'substitution',
                'sport' => 'Football',
                'accent_color' => '#16a34a',
                'secondary_color' => '#0f172a',
                'layout_style' => 'arrow-card',
                'blade_view' => 'substitution.modern',
                'css_file' => 'overlay/templates/title-modern.css',
                'js_file' => null,
                'config' => [
                    'theme' => 'minimal',
                    'animation_style' => 'fade',
                    'show_logos' => false,
                    'show_timer' => false,
                    'show_score' => false,
                    'show_period' => false,
                    'show_sponsor' => false,
                    'show_ticker' => false,
                ],
            ],

            [
                'name' => 'Broadcast Substitution',
                'slug' => 'broadcast-substitution',
                'category' => 'substitution',
                'sport' => 'Football',
                'accent_color' => '#dc2626',
                'secondary_color' => '#111827',
                'layout_style' => 'arrow-card',
                'blade_view' => 'substitution.broadcast',
                'css_file' => 'overlay/templates/substitution-broadcast.css',
                'js_file' => null,
                'config' => [
                    'theme' => 'broadcast-bold',
                    'animation_style' => 'slide',
                    'show_logos' => false,
                    'show_timer' => false,
                    'show_score' => false,
                    'show_period' => false,
                    'show_sponsor' => false,
                    'show_ticker' => false,
                ],
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