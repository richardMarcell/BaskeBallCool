<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

class StoreBookingRequest extends FormRequest
{

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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'pemesan' => ['required'],
            'email' => ['required', 'email'],
            'tanggal' => ['required','date','after_or_equal:today','before_or_equal:'.date('Y-m-d', strtotime('+5 days'))],
            'jam' => ['required','array'],
            'jumlah_pemain' => ['required','integer'],
            'jumlah_pemain_max' => ['required','integer'],
            'deskripsi' => ['required','string'],
            'lapangan_id' => ['required'],
            'izin_join' => ['required','in:ya,tidak'],
        ];
    }

}
