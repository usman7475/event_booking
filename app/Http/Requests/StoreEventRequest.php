<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
   public function rules(){
 return [
  'title'=>'required|string|max:255',
  'description'=>'nullable|string',
  'location'=>'required|string|max:255',
  'event_datetime'=>'required|date|after:now',
  'total_seats'=>'required|integer|min:1|max:10000'
 ];
}
}
