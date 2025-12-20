<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIndustryRegistrationRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'company_name' => ['required', 'string', 'max:255'],
            'ceo_firstname' => ['required', 'string', 'max:100'],
            'ceo_lastname' => ['required', 'string', 'max:100'],
            'ceo_mobile' => ['required', 'string', 'max:32', 'unique:industry_registrations,ceo_mobile'],
            'representative_fullname' => ['nullable', 'string', 'max:200'],
            'representative_mobile' => ['nullable', 'string', 'max:32', 'unique:industry_registrations,representative_mobile'],
            'province' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:500'],
            'requested_capacity' => ['nullable', 'string', 'max:100'],
            'industry_ministry_code' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'company_name' => 'نام شرکت',
            'ceo_firstname' => 'نام مدیرعامل',
            'ceo_lastname' => 'نام خانوادگی مدیرعامل',
            'ceo_mobile' => 'شماره موبایل مدیرعامل',
            'representative_fullname' => 'نام نماینده',
            'representative_mobile' => 'شماره موبایل نماینده',
            'province' => 'استان',
            'address' => 'آدرس',
            'requested_capacity' => 'ظرفیت درخواستی',
            'industry_ministry_code' => 'کد دریافتی از وزارت صنعت',
            'description' => 'توضیحات',
        ];
    }
}
