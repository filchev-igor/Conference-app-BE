<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConferenceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|string|regex:/^\d{2}:\d{2} - \d{2}:\d{2}$/',
            'location.venue' => 'required|string|max:255',
            'location.hall' => 'nullable|string|max:255',
            'location.address' => 'required|string|max:255',
            'speakers' => 'required|array|min:1',
            'speakers.*.name' => 'required|string|max:255',
            'speakers.*.role' => 'required|string|max:255',
            'speakers.*.company' => 'nullable|string|max:255',
            'agendas' => 'required|array|min:1',
            'agendas.*.id' => 'required|integer',
            'agendas.*.title' => 'required|string|max:255',
            'agendas.*.description' => 'required|string',
            'agendas.*.start_time' => 'required|date_format:H:i',
            'agendas.*.end_time' => 'required|date_format:H:i',
            'registration_info' => 'required|string|max:500',
            'registration_action' => 'required|string|max:255',
        ];
    }
}
