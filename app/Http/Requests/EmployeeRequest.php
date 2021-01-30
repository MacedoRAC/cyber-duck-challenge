<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $employeeId = null;
        if (isset($this->employee)) {
            $employeeId = $this->employee->id;
        }

        return [
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'email'      => 'nullable|email|max:255|unique:employees,email,' . $employeeId,
            'phone'      => 'nullable|digits:10|unique:employees,phone,' . $employeeId,
        ];
    }

    public function messages(): array
    {
        return [
            'phone' => 'The phone must have 10 digits and the country code isn\'t needed.'
        ];
    }
}
