<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactCompaniesRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [

            'logo'                    => 'nullable|mimes:png,jpg,jpeg,gif',
            'phones.*.phone_number'   => 'required',
            'ads.*.ad_label'          => 'required',
            'ads.*.total_impressions' => 'max:2147483647|nullable|numeric',
            'ads.*.total_networks'    => 'max:2147483647|nullable|numeric',
            'ads.*.total_channels'    => 'max:2147483647|nullable|numeric',
        ];
    }
}
