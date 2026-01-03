<?php

namespace Behin\SimpleWorkflowReport\Controllers\Core;

use App\Http\Controllers\Controller;
use Behin\SimpleWorkflow\Models\Core\Cases;
use Illuminate\View\View;

class InstallerCasesReportController extends Controller
{
    public function index(): View
    {
        $cases = Cases::where('process_id', '3ed250f5-65fc-4f44-91af-00731d914a40')
            ->orderByDesc('created_at')
            ->get();

        return view('SimpleWorkflowReportView::Core.InstallerApplications.cases', compact('cases'));
    }
}
