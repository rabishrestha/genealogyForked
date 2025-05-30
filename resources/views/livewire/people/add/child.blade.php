<form wire:submit="saveChild">
    @csrf

    <x-ts-tab selected="{{ __('person.add_new_person_as_child') }}" class="dark:bg-red-100">
        <x-ts-tab.items tab="{{ __('person.add_new_person_as_child') }}">
            <div class="p-4 rounded-sm md:w-192 bg-neutral-200">
                @if (auth()->user()->currentTeam->personal_team)
                    <div class="mb-4">
                        <x-ts-alert color="cyan" icon="tabler.exclamation-circle" close>
                            <x-slot:title>
                                {{ __('team.personal_team_caution') }}
                            </x-slot:title>

                            <p>{{ __('team.personal_team_avoid') }}</p><br />
                            <p>{{ __('team.personal_team_instead') }}</p><br />
                            <p>{{ __('team.personal_team_action') }}</p>
                        </x-ts-alert>
                    </div>
                @endif

                <x-ts-errors class="mb-2" close />

                <div class="grid grid-cols-6 gap-5">
                    {{-- firstname --}}
                    <div class="col-span-6 md:col-span-3">
                        <x-ts-input wire:model="childForm.firstname" id="firstname" label="{{ __('person.firstname') }} :" wire:dirty.class="bg-yellow-200 dark:text-black" autocomplete="firstname" />
                    </div>

                    {{-- surname --}}
                    <div class="col-span-6 md:col-span-3">
                        <x-ts-input wire:model="childForm.surname" id="surname" label="{{ __('person.surname') }} : *" wire:dirty.class="bg-yellow-200 dark:text-black" autocomplete="surname" />
                    </div>

                    {{-- birthname --}}
                    <div class="col-span-6 md:col-span-3">
                        <x-ts-input wire:model="childForm.birthname" id="birthname" label="{{ __('person.birthname') }} :" wire:dirty.class="bg-yellow-200 dark:text-black" autocomplete="birthname" />
                    </div>

                    {{-- nickname --}}
                    <div class="col-span-6 md:col-span-3">
                        <x-ts-input wire:model="childForm.nickname" id="nickname" label="{{ __('person.nickname') }}" wire:dirty.class="bg-yellow-200 dark:text-black" autocomplete="nickname" />
                    </div>
                    <x-hr.narrow class="col-span-6 my-0!" />

                    {{-- sex --}}
                    <div class="col-span-6 md:col-span-3">
                        <x-label for="sex" class="mr-5" value="{{ __('person.sex') }} ({{ __('person.biological') }}) : *" />
                        <div class="flex">
                            <div class="mt-3 mb-[0.125rem] mr-4 inline-block min-h-[1.5rem] pl-[1.5rem]">
                                <x-ts-radio color="primary" wire:model="childForm.sex" name="sex" id="sexM" value="m" label="{{ __('app.male') }}" />
                            </div>
                            <div class="mt-3 mb-[0.125rem] mr-4 inline-block min-h-[1.5rem] pl-[1.5rem]">
                                <x-ts-radio color="primary" wire:model="childForm.sex" name="sex" id="sexF" value="f" label="{{ __('app.female') }}" />
                            </div>
                        </div>
                    </div>

                    {{-- gender_id --}}
                    <div class="col-span-6 md:col-span-3">
                        <x-ts-select.styled wire:model="childForm.gender_id" id="gender_id" label="{{ __('person.gender') }} :" :options="$childForm->genders()" select="label:name|value:id"
                            placeholder="{{ __('app.select') }} ..." wire:dirty.class="bg-yellow-200 dark:text-black" searchable />
                    </div>
                    <x-hr.narrow class="col-span-6 my-0!" />

                    {{-- yob --}}
                    <div class="col-span-6 md:col-span-3">
                        <x-ts-input wire:model="childForm.yob" id="yob" label="{{ __('person.yob') }} :" wire:dirty.class="bg-yellow-200 dark:text-black" autocomplete="yob" type="number" aria-atomic=""max="{{ date('Y') }}"/>
                    </div>

                    {{-- dob --}}
                    <div class="col-span-6 md:col-span-3">
                        <x-ts-date wire:model="childForm.dob" id="dob" label="{{ __('person.dob') }} :" wire:dirty.class="bg-yellow-200 dark:text-black" format="YYYY-MM-DD" :max-date="now()"
                            placeholder="{{ __('app.select') }} ..." />
                    </div>

                    {{-- pob --}}
                    <div class="col-span-6">
                        <x-ts-input wire:model="childForm.pob" id="pob" label="{{ __('person.pob') }} :" wire:dirty.class="bg-yellow-200 dark:text-black" autocomplete="pod" />
                    </div>
                    <x-hr.narrow class="col-span-6 my-0!" />

                    {{-- uploads --}}
                    <div class="col-span-6">
                        <x-ts-upload id="uploads" wire:model="uploads"
                            label="{{ __('person.photos') }} :"
                            accept="{{ implode(',', array_keys(config('app.upload_photo_accept'))) }}"
                            hint="{{ __('person.upload_max_size', ['max' => config('app.upload_max_size')]) }}<br/>{{ __('person.upload_accept_types', ['types' => implode(', ', array_values(config('app.upload_photo_accept')))]) }}"
                            tip="{{ __('person.upload_photos_tip') }}"
                            multiple delete />
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end pt-4 text-right">
                <div class="flex-1 grow max-w-full text-left">
                    <x-action-message class="p-3 rounded-sm bg-yellow-200 text-yellow-700" role="alert" on="" wire:dirty>
                        {{ __('app.unsaved_changes') }} ...
                    </x-action-message>

                    <x-action-message class="p-3 rounded-sm bg-emerald-200 text-emerald-600" role="alert" on="saved">
                        {{ __('app.saved') }}
                    </x-action-message>
                </div>

                <div class="flex-1 grow max-w-full text-end">
                    <x-ts-button color="secondary" class="mr-1" wire:click="resetChild()" wire:dirty>
                        {{ __('app.cancel') }}
                    </x-ts-button>

                    <x-ts-button type="submit" color="primary">
                        {{ __('app.save') }}
                    </x-ts-button>
                </div>
            </div>
        </x-ts-tab.items>

        <x-ts-tab.items tab="{{ __('person.add_existing_person_as_child') }}">
            <div class="p-4 rounded-sm md:w-192 bg-neutral-200">
                <x-ts-errors class="mb-2" close />

                {{-- person_id --}}
                <div class="col-span-6">
                    <x-ts-select.styled wire:model="childForm.person_id" id="person_id" label="{{ __('person.person') }} : *" :options="$persons" select="label:name|value:id"
                        placeholder="{{ __('app.select') }} ..." wire:dirty.class="bg-yellow-200 dark:text-black" searchable>
                        <x-slot:after>
                            <div class="w-full px-2 mb-2">
                                <x-ts-alert title="{{ __('app.nothing_available') }}" text="{{ __('person.use_tab') . ' : ' . __('person.add_new_person_as_child') }}" color="cyan" />
                            </div>
                        </x-slot:after>
                    </x-ts-select.styled>
                </div>
            </div>

            <div class="flex items-center justify-end pt-4 text-right">
                <div class="flex-1 grow max-w-full text-left">
                    <x-action-message class="p-3 rounded-sm bg-yellow-200 text-yellow-700" role="alert" on="" wire:dirty>
                        {{ __('app.unsaved_changes') }} ...
                    </x-action-message>

                    <x-action-message class="p-3 rounded-sm bg-emerald-200 text-emerald-600" role="alert" on="saved">
                        {{ __('app.saved') }}
                    </x-action-message>
                </div>

                <div class="flex-1 grow max-w-full text-end">
                    <x-ts-button color="secondary" class="mr-1" wire:click="resetChild()" wire:dirty>
                        {{ __('app.cancel') }}
                    </x-ts-button>

                    <x-ts-button type="submit" color="primary">
                        {{ __('app.save') }}
                    </x-ts-button>
                </div>
            </div>
        </x-ts-tab.items>
    </x-ts-tab>
</form>
