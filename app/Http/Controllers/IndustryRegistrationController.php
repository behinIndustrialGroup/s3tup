<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIndustryRegistrationRequest;
use App\Models\IndustryRegistration;
use BaleBot\Controllers\BotController;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class IndustryRegistrationController extends Controller
{
    public function create(): View
    {
        return view('landing.industry-registration');
    }

    public function store(StoreIndustryRegistrationRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['ceo_mobile'] = convertPersianToEnglish($data['ceo_mobile']);
        if (!empty($data['representative_mobile'])) {
            $data['representative_mobile'] = convertPersianToEnglish($data['representative_mobile']);
        }

        $registration = IndustryRegistration::create($data);

        BotController::send(
            sprintf(
                'درخواست جدید صنایع: %s - مدیرعامل: %s %s (%s)',
                $registration->company_name,
                $registration->ceo_firstname,
                $registration->ceo_lastname,
                $registration->ceo_mobile,
            )
        );

        return redirect()
            ->route('landing.industry-registration')
            ->with('status', 'درخواست شما با موفقیت ثبت شد. همکاران ما به زودی با شما تماس می‌گیرند.');
    }
}
