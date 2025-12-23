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
        $provinceCounts = $this->resolveProvinceCounts();

        return view('landing.industry-registration', compact('provinceCounts'));
    }

    public function store(StoreIndustryRegistrationRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['mobile'] = convertPersianToEnglish($data['mobile']);
        if (!empty($data['demand_kw'])) {
            $data['demand_kw'] = convertPersianToEnglish($data['demand_kw']);
        }

        $registration = IndustryRegistration::create($data);

        BotController::send(
            sprintf(
                'درخواست جدید صنایع: %s - شخص تماس: %s (%s)',
                $registration->company_name,
                $registration->contact_name,
                $registration->mobile,
            )
        );

        return redirect()
            ->route('landing.industry-registration')
            ->with('status', 'درخواست شما با موفقیت ثبت شد. همکاران ما به زودی با شما تماس می‌گیرند.');
    }

    private function resolveProvinceCounts(): array
    {
        $provinceConfig = collect(config('industry_provinces.provinces', []));
        $databaseCounts = IndustryRegistration::selectRaw('province, COUNT(*) as aggregate')
            ->groupBy('province')
            ->pluck('aggregate', 'province');

        return $provinceConfig
            ->map(fn (?int $override, string $province): int => $override ?? (int) ($databaseCounts[$province] ?? 0))
            ->toArray();
    }
}
