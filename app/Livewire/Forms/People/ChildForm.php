<?php

declare(strict_types=1);

namespace App\Livewire\Forms\People;

use App\Models\Gender;
use App\Models\Person;
use App\Rules\DobValid;
use App\Rules\YobValid;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Form;

final class ChildForm extends Form
{
    // -----------------------------------------------------------------------
    public Person $person;

    // -----------------------------------------------------------------------
    public $firstname = null;

    public $surname = null;

    public $birthname = null;

    public $nickname = null;

    public $sex = null;

    public $gender_id = null;

    #[Validate]
    public $yob = null;

    #[Validate]
    public $dob = null;

    public $pob = null;

    public $photo = null;

    // -----------------------------------------------------------------------
    public $person_id;

    // -----------------------------------------------------------------------
    #[Computed(persist: true, seconds: 3600, cache: true)]
    public function genders(): Collection
    {
        return Gender::select('id', 'name')->orderBy('name')->get();
    }

    // -----------------------------------------------------------------------
    public function resetFields(): void
    {
        $this->firstname = null;
        $this->surname   = null;
        $this->birthname = null;
        $this->nickname  = null;
        $this->sex       = null;
        $this->gender_id = null;
        $this->yob       = null;
        $this->dob       = null;
        $this->pob       = null;
        $this->photo     = null;

        $this->person_id = null;
    }

    public function rules(): array
    {
        return $rules = [
            'firstname' => ['nullable', 'string', 'max:255'],
            'surname'   => ['nullable', 'string', 'max:255', 'required_without:person_id', 'required_with:sex'],
            'birthname' => ['nullable', 'string', 'max:255'],
            'nickname'  => ['nullable', 'string', 'max:255'],

            'sex'       => ['nullable', 'in:m,f', 'required_without:person_id', 'required_with:surname'],
            'gender_id' => ['nullable', 'integer'],

            'yob' => [
                'nullable',
                'integer',
                'min:1',
                'max:' . date('Y'),
                new YobValid,
            ],
            'dob' => [
                'nullable',
                'date_format:Y-m-d',
                'before_or_equal:today',
                new DobValid,
            ],
            'pob' => ['nullable', 'string', 'max:255'],

            'photo' => ['nullable', 'string', 'max:255'],

            // -----------------------------------------------------------------------
            'person_id' => ['nullable', 'integer', 'required_without_all:surname,sex', 'exists:people,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'surname.required_without'   => __('validation.surname.required_without'),
            'person_id.required_without' => __('validation.person_id.required_without'),
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'firstname' => __('person.firstname'),
            'surname'   => __('person.surname'),
            'birthname' => __('person.birthname'),
            'nickname'  => __('person.nickname'),

            'sex'       => __('person.sex'),
            'gender_id' => __('person.gender'),

            'yob' => __('person.yob'),
            'dob' => __('person.dob'),
            'pob' => __('person.pob'),

            'photo' => __('person.photo'),

            'person_id' => __('person.person'),
        ];
    }
}
