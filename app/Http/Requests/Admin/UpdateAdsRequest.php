<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdsRequest extends FormRequest
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
            
            'ad_label' => 'required',
            'total_impressions' => 'max:2147483647|nullable|numeric',
            'total_networks' => 'max:2147483647|nullable|numeric',
            'total_channels' => 'max:2147483647|nullable|numeric',
            'category_id.*' => 'exists:categories,id',
            'video_screenshot' => 'nullable|mimes:png,jpg,jpeg,gif',
        ];
    }
}
