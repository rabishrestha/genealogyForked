<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

final class YobValid implements DataAwareRule, ValidationRule
{
    /**
     * All of the data under validation.
     *
     * @var array<string, mixed>
     */
    private array $data = [];

    /**
     * Set the data under validation.
     *
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->data['dob']) {
            // yob must match dob->year
            if ((int) $value !== (int) date('Y', strtotime((string) $this->data['dob']))) {
                $fail(__('person.yob_not_matching_dob', ['value' => $this->data['dob']]));
            }
        } elseif (isset($this->data['person'])) {
            if ($this->data['person']['dod']) {
                // yob may not be after dod->year
                if ((int) $value < (int) date('Y', strtotime((string) $this->data['person']['dod']))) {
                    $fail(__('person.yob_after_dod', ['value' => $this->data['person']['dod']]));
                }
            } elseif ($this->data['person']['yod']) {
                // yob may not be after yod
                if ((int) $value < (int) $this->data['person']['yod']) {
                    $fail(__('person.yob_after_yod', ['value' => $this->data['person']['yod']]));
                }
            }
        }
    }
}
