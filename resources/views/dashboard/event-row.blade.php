<div class="dash-event-row">
    <div class="flex items-center justify-between">

        <div>
            <h3 class="text-white text-lg font-semibold">
                {{ $event->name }}
            </h3>

            <p class="text-slate-400 text-sm mt-1">
                {{ strtoupper($event->sport) }}
            </p>
        </div>

        <div class="flex items-center gap-8">

            <div class="text-center">
                <p class="text-xs text-slate-500">
                    {{ $event->team_a }}
                </p>

                <h2 class="text-3xl font-bold text-white">
                    {{ $event->score_a }}
                </h2>
            </div>

            <span class="text-slate-500 text-xl">-</span>

            <div class="text-center">
                <p class="text-xs text-slate-500">
                    {{ $event->team_b }}
                </p>

                <h2 class="text-3xl font-bold text-white">
                    {{ $event->score_b }}
                </h2>
            </div>

            <a
                href="{{ route('matches.control', $event->id) }}"
                class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white transition">

                Open Control

            </a>

        </div>

    </div>
</div>