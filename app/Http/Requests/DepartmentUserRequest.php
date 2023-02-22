<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "shift_id" => ["required"],
            "user_id" => ["required"],
            "department_id" => ["required"],
            "enter_time" => ["required"],
            "max_enter_time" => ["required"],
            "exit_time" => ["required"],
            "owner" => ["required"],
        ];
    }
}
