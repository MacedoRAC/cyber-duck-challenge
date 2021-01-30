<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
        $companyId = null;
        if(isset($this->company)) {
            $companyId = $this->company->id;
        }

        return [
            'name'    => 'required|max:255|unique:companies,name,' . $companyId,
            'email'   => 'nullable|email|max:255|unique:companies,email,' . $companyId,
            'website' => 'nullable|url|max:255|unique:companies,website,' . $companyId,
            'logo'    => 'file|mimes:jpeg,png|dimensions:min_width=100,min_height=100,ratio=1/1|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'logo' => 'The image must square and have at least 100px of width and height'
        ];
    }
}
