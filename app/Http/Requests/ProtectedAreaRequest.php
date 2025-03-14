<?php

namespace App\Http\Requests;

use App\Traits\NumberTools;
use Illuminate\Foundation\Http\FormRequest;

class ProtectedAreaRequest extends FormRequest
{
    use NumberTools;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'continentWith' => 'required|integer|min:' . config('constants.CONTINENT_WIDTH.MIN') . '|max:' . config('constants.CONTINENT_WIDTH.MAX'),
            'altitudes' => [
                'required',
                // à déplacer dans un validator à part ?
                function ($attribute, $value, $fail){
                    $continentWidth = (int)$this->get('continentWith');

                    if (substr_count(trim($value), ' ') !== $continentWidth - 1) {
                        $fail("Le nombre d'altitudes doit être exactement égal à la largeur du continent.");
                    }

                    if ($continentWidth <= 0) {
                        $fail("Le champ Largeur du continent doit être un entier positif.");
                        return;
                    }

                    $count = 0;
                    $currentNumber = '';
                    $length = strlen($value);

                    for ($i = 0; $i < $length; $i++) {
                        $char = $value[$i];

                        if ($char === ' ') {
                            if ($currentNumber !== '') {
                                if (!$this->isValidNumber($currentNumber, $fail)) return;
                                $count++;
                                $currentNumber = '';
                            }
                        } else {
                            if (!ctype_digit($char)) {
                                $fail(sprintf(
                                    "Chaque nombre doit être un entier compris entre %d et %d.",
                                    config('constants.ALTITUDE.MIN'),
                                    config('constants.ALTITUDE.MAX')
                                ));
                                return;
                            }
                            $currentNumber .= $char;
                        }
                    }

                    if ($currentNumber !== '') {
                        if (!$this->isValidNumber($currentNumber, $fail)) return;
                        $count++;
                    }

                    if ($count !== $continentWidth) {
                        $fail("Le champ $attribute doit contenir le même nombre d'éléments que celui spécifié dans le champ largeur du continent.");
                    }
                },
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'continentWith' => "'Largeur du continent'",
        ];
    }
}
