<?php

namespace App\Http\Controllers;

use App\Models\GameMatch;
use App\Models\OverlaySetting;
use App\Models\OverlayTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\OverlayRenderService;
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

   $settings = OverlaySetting::with('template')
    ->firstOrCreate([
        'match_id' => $match->id
    ]); return view('overlay.configure', [
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

    $settings = OverlaySetting::with('template')
        ->firstOrCreate([
            'match_id' => $match->id
        ]);

    if (!$settings->template) {
        abort(404, 'No overlay template selected.');
    }

    return view(
        $settings->template->blade_view_path,
        [
            'match' => $match,
            'settings' => $settings,
            'template' => $settings->template,
        ]
    );
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
   public function selectTemplate(Request $request, GameMatch $match, OverlayRenderService $overlayService)
{
    abort_unless($match->user_id === auth()->id(), 403);

    $category = $request->query('category');

    $templates = $overlayService->templatesFor($match->sport, $category);

   $settings = OverlaySetting::with('template')
    ->firstOrCreate([
        'match_id'=>$match->id
    ]); $categories = [
        'scoreboard'   => 'Scoreboard',
        'team'         => 'Team',
        'lower_third'  => 'Lower Third',
        'sponsor'      => 'Sponsor',
        'penalties'    => 'Penalties',
        'titles'       => 'Titles',
        'substitution' => 'Substitution',
    ];

    return view('overlay.select-template', [
        'match'              => $match,
        'templates'          => $templates,
        'categories'         => $categories,
        'activeCategory'     => $category,
        'selectedTemplateId' => $settings->template_id,
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

    $settings = OverlaySetting::firstOrCreate([
        'match_id' => $match->id,
    ]);

    $settings->fill(array_merge(
        $template->config ?? [],
        [
            'template_id'  => $template->id,
            'accent_color' => $template->accent_color,
        ]
    ));

    $settings->save();

    return redirect()
        ->route('overlay.edit', $match)
        ->with('success', "Template '{$template->name}' applied successfully.");
} /**
 * Render an ephemeral preview of the overlay using query-string
 * overrides layered on top of the saved settings — nothing is
 * persisted here. Used as the live-preview iframe source on the
 * Configure page so operators see changes before saving.
 */
public function preview(Request $request, GameMatch $match)
{
    abort_unless($match->user_id === auth()->id(), 403);

    $settings = OverlaySetting::firstOrCreate(['match_id' => $match->id]);

    $booleanFields = ['show_logos', 'show_timer', 'show_score', 'show_period', 'show_sponsor', 'show_ticker'];
    $textFields    = ['theme', 'animation_style', 'accent_color', 'ticker_text'];

    foreach ($booleanFields as $field) {
        if ($request->has($field)) {
            $settings->$field = filter_var($request->input($field), FILTER_VALIDATE_BOOLEAN);
        }
    }

    foreach ($textFields as $field) {
        if ($request->filled($field)) {
            $settings->$field = $request->input($field);
        }
    }

 $match->load(['teamA', 'teamB']);

$settings->load('template');

if (!$settings->template) {
    abort(404, 'No overlay template selected.');
}

return view(
    $settings->template->blade_view_path,
    [
        'match'    => $match,
        'settings' => $settings,
        'template' => $settings->template,
    ]
);}
}