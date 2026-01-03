<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstallerApplicationRequest;
use App\Models\InstallerApplication;
use BaleBot\Controllers\BotController;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InstallerRegistrationController extends Controller
{
    public function create(): View
    {
        return view('installer.apply');
    }

    public function store(StoreInstallerApplicationRequest $request): RedirectResponse
    {
        $request->validate([
            'phone' => 'required|numeric|digits:11|unique:installer_applications,phone',
            'national_id' => 'required|numeric|digits:10|unique:installer_applications,national_id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
        ]);
        $row = InstallerApplication::where('phone', $request->phone)->first();
        if($row){
            return redirect()
                ->route('installers.apply')
                ->with('status', 'با این شماره موبایل قبلا ثبت نام انجام شده است');
        }
        InstallerApplication::create($request->validated());
        BotController::send(
            $request->first_name . ' ' . $request->last_name . ' با شماره موبایل ' . $request->phone . ' ثبت نام کرد.', 
        );
        return redirect()
            ->route('installers.apply')
            ->with('status', 'درخواست شما با موفقیت ثبت شد. همکاران ما به زودی با شما تماس می‌گیرند.');
    }
}
