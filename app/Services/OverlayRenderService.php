<?php

namespace App\Services;

use App\Models\GameMatch;
use App\Models\OverlaySetting;
use App\Models\OverlayTemplate;

class OverlayRenderService
{
    /**
     * The Blade view used when a match has no template assigned yet,
     * or its assigned template is missing/inactive. Guarantees the
     * render page never crashes — it always has something to show.
     */
    private const FALLBACK_BLADE_VIEW = 'default';

    /**
     * Resolve everything needed to render a match's overlay:
     * the settings row, the template (or a safe fallback), and
     * the fully-qualified Blade view path to include.
     */
    public function resolve(GameMatch $match): array
    {
        $settings = OverlaySetting::firstOrCreate(['match_id' => $match->id]);

        $template = $settings->template && $settings->template->is_active
            ? $settings->template
            : $this->fallbackTemplate();

        return [
            'match'        => $match,
            'settings'     => $settings,
            'template'     => $template,
            'bladeView'    => $this->resolveBladeViewPath($template),
            'cssFile'      => $template?->css_file,
            'jsFile'       => $template?->js_file,
        ];
    }

    /**
     * Build the dot-notation Blade view path used by @includeIf.
     * Falls back to the guaranteed-safe default template if the
     * assigned template has no blade_view set for any reason.
     */
    public function resolveBladeViewPath(?OverlayTemplate $template): string
    {
        $slug = $template?->blade_view ?: self::FALLBACK_BLADE_VIEW;

        return 'overlay.templates.' . $slug;
    }

    /**
     * The safe, always-available default template — used when no
     * template is assigned yet, or the assigned one was deactivated
     * or deleted after being applied to a match.
     */
    public function fallbackTemplate(): ?OverlayTemplate
    {
        return OverlayTemplate::active()
            ->where('blade_view', self::FALLBACK_BLADE_VIEW)
            ->first();
    }

    /**
     * Templates available for a given sport + optional category filter,
     * used by the Step 2 gallery.
     */
    public function templatesFor(?string $sport, ?string $category = null)
    {
        return OverlayTemplate::active()
            ->forSport($sport)
            ->category($category)
            ->orderBy('category')
            ->orderBy('name')
            ->get();
    }
}