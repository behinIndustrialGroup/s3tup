<?php

namespace Behin\SimpleWorkflowReport\Controllers\Core;

use App\Http\Controllers\Controller;
use Behin\SimpleWorkflowReport\Models\IndustryRegistration;
use Illuminate\View\View;

class IndustryRegistrationReportController extends Controller
{
    public function index(): View
    {
        $registrations = IndustryRegistration::orderByDesc('created_at')->paginate(15);

        return view('SimpleWorkflowReportView::Core.IndustryRegistrations.index', compact('registrations'));
    }
}
