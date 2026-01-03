<?php

namespace Behin\SimpleWorkflowReport\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Models\InstallerApplication;
use App\Models\User;
use Behin\SimpleWorkflow\Controllers\Core\ProcessController;
use Behin\SimpleWorkflow\Models\Core\Cases;
use Behin\SimpleWorkflowReport\Models\InstallerApplicationProfile;
use Behin\SimpleWorkflowReport\Models\InstallerApplicationProject;
use Behin\Sms\Controllers\SmsController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class InstallerCasesReportController extends Controller
{
    public function index(): View
    {
        $cases = Cases::where('process_id', '3ed250f5-65fc-4f44-91af-00731d914a40')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('SimpleWorkflowReportView::Core.InstallerApplications.cases', compact('cases'));
    }
}
