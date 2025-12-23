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
            'economic_code' => ['nullable', 'string', 'max:100'],
            'industry_ministry_code' => ['nullable', 'string', 'max:100'],
            'industry_type' => ['required', 'string', 'max:150'],
            'contact_name' => ['required', 'string', 'max:150'],
            'contact_position' => ['required', 'string', 'max:100'],
            'mobile' => ['required', 'string', 'max:32'],
            'email' => ['nullable', 'email', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:150'],
            'address' => ['required', 'string', 'max:500'],
            'voltage_level' => ['required', 'string', 'max:50'],
            'demand_kw' => ['nullable', 'string', 'max:100'],
            'goals' => ['required', 'array', 'min:1'],
            'goals.*' => ['string', 'in:prevent_outage,stable_power,cost_reduction,peak_management,environment'],
            'description' => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'company_name' => 'نام شرکت',
            'economic_code' => 'شناسه ملی / کد اقتصادی',
            'industry_ministry_code' => 'کد دریافتی از وزارت صمت',
            'industry_type' => 'حوزه فعالیت صنعتی',
            'contact_name' => 'نام و نام خانوادگی',
            'contact_position' => 'سمت سازمانی',
            'mobile' => 'شماره موبایل',
            'email' => 'ایمیل',
            'province' => 'استان',
            'city' => 'شهر / شهرستان',
            'address' => 'نشانی دقیق',
            'voltage_level' => 'سطح ولتاژ برق',
            'demand_kw' => 'دیماند قراردادی',
            'goals' => 'هدف اصلی پروژه',
            'description' => 'توضیحات',
        ];
    }

    protected function prepareForValidation(): void
    {
        $mobile = $this->input('mobile');
        $demandKw = $this->input('demand_kw');

        $this->merge([
            'mobile' => $mobile !== null ? convertPersianToEnglish($mobile) : null,
            'demand_kw' => $demandKw !== null ? convertPersianToEnglish($demandKw) : null,
        ]);
    }
}
