@props(['team', 'component' => 'dropdown-link'])

<form method="POST" action="{{ route('current-team.update') }}" x-data>
    @method('PUT')
    @csrf

    {{-- hidden team id --}}
    <input type="hidden" name="team_id" value="{{ $team->id }}">

    <x-dynamic-component :component="$component" href="#" x-on:click.prevent="$root.submit();">
        <div class="flex items-center">
            <div class="truncate @if (auth()->user()->isCurrentTeam($team)) text-yellow-500 @endif" title="{{ $team->description }}">
                {{ $team->name }}
            </div>

            @if (auth()->user()->isCurrentTeam($team))
                <x-ts-icon icon="tabler.circle-check" class="inline-block size-5 ms-2 text-emerald-600" />
            @endif
        </div>
    </x-dynamic-component>
</form>
