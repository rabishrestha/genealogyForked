<?php

declare(strict_types=1);

namespace App\Livewire\People\Add;

use App\Livewire\Forms\People\PartnerForm;
use App\Livewire\Traits\TrimStringsAndConvertEmptyStringsToNull;
use App\Models\Couple;
use App\Models\Person;
use App\PersonPhotos;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use TallStackUi\Traits\Interactions;

final class Partner extends Component
{
    use Interactions;
    use TrimStringsAndConvertEmptyStringsToNull;
    use WithFileUploads;

    // -----------------------------------------------------------------------
    public Person $person;

    public PartnerForm $partnerForm;

    public array $uploads = [];

    public array $backup = [];

    public Collection $persons;

    // -----------------------------------------------------------------------
    public function mount(): void
    {
        $this->persons = Person::PartnerOffset($this->person->birth_year)
            ->where('id', '!=', $this->person->id)
            ->orderBy('firstname')->orderBy('surname')
            ->get()
            ->map(fn ($p): array => [
                'id'   => $p->id,
                'name' => $p->name . ' [' . (($p->sex === 'm') ? __('app.male') : __('app.female')) . '] ' . ($p->birth_formatted ? ' (' . $p->birth_formatted . ')' : ''),
            ]);
    }

    public function deleteUpload(array $content): void
    {
        /* the $content contains:
            [
                'temporary_name',
                'real_name',
                'extension',
                'size',
                'path',
                'url',
            ]
        */

        if (empty($this->uploads)) {
            return;
        }

        $this->uploads = collect($this->uploads)
            ->filter(fn (UploadedFile $file): bool => $file->getFilename() !== $content['temporary_name'])
            ->values()
            ->toArray();

        rescue(
            fn () => File::delete(storage_path('app/livewire-tmp/' . $content['temporary_name'])),
            report: false
        );
    }

    public function updatingUploads(): void
    {
        $this->backup = $this->uploads;
    }

    public function updatedUploads(): void
    {
        if (empty($this->uploads)) {
            return;
        }

        $this->uploads = collect(array_merge($this->backup, (array) $this->uploads))
            ->unique(fn (UploadedFile $file): string => $file->getClientOriginalName())
            ->toArray();
    }

    public function savePartner(): void
    {
        if ($this->isDirty()) {
            $validated = $this->partnerForm->validate();

            if (isset($validated['person2_id'])) {
                if ($this->hasOverlap($validated['date_start'], $validated['date_end'])) {
                    $this->toast()->error(__('app.create'), 'RELATIONSHIP OVERLAP !!')->send();
                } else {
                    $couple = Couple::create([
                        'person1_id' => $this->person->id,
                        'person2_id' => $validated['person2_id'],
                        'date_start' => $validated['date_start'] ?? null,
                        'date_end'   => $validated['date_end'] ?? null,
                        'is_married' => $validated['is_married'],
                        'has_ended'  => $validated['has_ended'],
                        'team_id'    => $this->person->team_id,
                    ]);

                    $this->toast()->success(__('app.create'), $couple->name . ' ' . __('app.created'))->flash()->send();
                }
            } else {
                if ($this->hasOverlap($validated['date_start'], $validated['date_end'])) {
                    $this->toast()->error(__('app.create'), 'RELATIONSHIP OVERLAP !!')->send();
                } else {
                    $new_person = Person::create([
                        'firstname' => $validated['firstname'],
                        'surname'   => $validated['surname'],
                        'birthname' => $validated['birthname'],
                        'nickname'  => $validated['nickname'],
                        'sex'       => $validated['sex'],
                        'gender_id' => $validated['gender_id'] ?? null,
                        'yob'       => $validated['yob'],
                        'dob'       => $validated['dob'],
                        'pob'       => $validated['pob'],
                        'team_id'   => $this->person->team_id,
                    ]);

                    if ($this->uploads) {
                        $personPhotos = new PersonPhotos($new_person);
                        $personPhotos->save($this->uploads);
                    }

                    $this->toast()->success(__('app.create'), $new_person->name . ' ' . __('app.created') . '.')->flash()->send();

                    $couple = Couple::create([
                        'person1_id' => $this->person->id,
                        'person2_id' => $new_person->id,
                        'date_start' => $validated['date_start'] ?? null,
                        'date_end'   => $validated['date_end'] ?? null,
                        'is_married' => $validated['is_married'],
                        'has_ended'  => $validated['has_ended'],
                        'team_id'    => $this->person->team_id,
                    ]);

                    $this->toast()->success(__('app.create'), $couple->name . ' ' . __('app.created') . '.')->flash()->send();
                }
            }

            $this->redirect(route('people.show', $this->person->id));
        }
    }

    public function isDirty(): bool
    {
        return
        $this->partnerForm->firstname !== null or
        $this->partnerForm->surname !== null or
        $this->partnerForm->birthname !== null or
        $this->partnerForm->nickname !== null or
        $this->partnerForm->sex !== null or
        $this->partnerForm->gender_id !== null or
        $this->partnerForm->yob !== null or
        $this->partnerForm->dob !== null or
        $this->partnerForm->pob !== null or
        $this->partnerForm->photo = null or

        $this->partnerForm->person2_id !== null or
        $this->partnerForm->date_start !== null or
        $this->partnerForm->date_end !== null or
        $this->partnerForm->is_married !== false or
        $this->partnerForm->has_ended !== false;
    }

    public function resetPartner(): void
    {
        $this->partnerForm->resetFields();
        $this->uploads = [];
        $this->backup  = [];

        $this->resetErrorBag();
        $this->resetValidation();
    }

    // ------------------------------------------------------------------------------
    public function render(): View
    {
        return view('livewire.people.add.partner');
    }

    // -----------------------------------------------------------------------
    protected function rules(): array
    {
        return [
            'uploads.*' => [
                'file',
                'mimetypes:' . implode(',', array_keys(config('app.upload_photo_accept'))),
                'max:' . config('app.upload_max_size'),
            ],
        ];
    }

    protected function messages(): array
    {
        return [
            'uploads.*.file'      => __('validation.file', ['attribute' => __('person.photo')]),
            'uploads.*.mimetypes' => __('validation.mimetypes', [
                'attribute' => __('person.photo'),
                'values'    => implode(', ', array_values(config('app.upload_photo_accept'))),
            ]),
            'uploads.*.max' => __('validation.max.file', [
                'attribute' => __('person.photo'),
                'max'       => config('app.upload_max_size'),
            ]),
        ];
    }

    // -----------------------------------------------------------------------
    private function hasOverlap($start, $end): bool
    {
        $is_overlap = false;

        if (! empty($start) or ! empty($end)) {
            foreach ($this->person->couples as $couple) {
                if (! empty($couple->date_start) and ! empty($couple->date_end)) {
                    if (! empty($start) and $start >= $couple->date_start and $start <= $couple->date_end) {
                        $is_overlap = true;
                    } elseif (! empty($end) and $end >= $couple->date_start and $end <= $couple->date_end) {
                        $is_overlap = true;
                    }
                }
            }
        }

        return $is_overlap;
    }
}
