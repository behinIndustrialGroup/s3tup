<?php

namespace Behin\SimpleWorkflowReport\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Models\InstallerApplication;
use App\Models\User;
use Behin\SimpleWorkflow\Controllers\Core\ProcessController;
use Behin\SimpleWorkflowReport\Models\InstallerApplicationProfile;
use Behin\SimpleWorkflowReport\Models\InstallerApplicationProject;
use Behin\Sms\Controllers\SmsController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class InstallerApplicationReportController extends Controller
{
    public function index(): View
    {
        $applications = InstallerApplication::with(['profile', 'projects'])
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('SimpleWorkflowReportView::Core.InstallerApplications.index', compact('applications'));
    }

    public function edit(InstallerApplication $installerApplication): View
    {
        $installerApplication->load(['profile', 'projects']);

        return view('SimpleWorkflowReportView::Core.InstallerApplications.edit', [
            'application' => $installerApplication,
        ]);
    }

    public function update(Request $request, InstallerApplication $installerApplication): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'national_id' => 'required|string|max:20',
            'phone' => 'required|string|max:32',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'description' => 'nullable|string',
            'resume_summary' => 'nullable|string',
            'projects' => 'array',
            'projects.*.id' => 'nullable|integer|exists:installer_application_projects,id',
            'projects.*.title' => 'nullable|string|max:255',
            'projects.*.description' => 'nullable|string',
            'projects.*.remove' => 'nullable|boolean',
            'projects.*.image' => 'nullable|image|max:5120',
        ]);

        $installerApplication->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'national_id' => $validated['national_id'],
            'phone' => $validated['phone'],
            'province' => $validated['province'],
            'city' => $validated['city'],
            'description' => $validated['description'] ?? null,
        ]);

        InstallerApplicationProfile::updateOrCreate(
            ['installer_application_id' => $installerApplication->id],
            ['summary' => $validated['resume_summary'] ?? null]
        );

        $projects = $request->input('projects', []);

        foreach ($projects as $index => $projectInput) {
            $projectId = $projectInput['id'] ?? null;
            $project = null;

            if ($projectId) {
                $project = InstallerApplicationProject::where('installer_application_id', $installerApplication->id)
                    ->findOrFail($projectId);
            }

            $shouldRemove = filter_var($projectInput['remove'] ?? false, FILTER_VALIDATE_BOOLEAN);

            if ($project && $shouldRemove) {
                if ($project->image_path) {
                    Storage::disk('public')->delete($project->image_path);
                }

                $project->delete();
                continue;
            }

            $hasContent = $projectId
                || ($projectInput['title'] ?? false)
                || ($projectInput['description'] ?? false)
                || $request->hasFile("projects.$index.image");

            if (! $hasContent) {
                continue;
            }

            if (! $project) {
                $project = new InstallerApplicationProject();
                $project->installer_application_id = $installerApplication->id;
            }

            $project->title = $projectInput['title'] ?? null;
            $project->description = $projectInput['description'] ?? null;

            if ($request->hasFile("projects.$index.image")) {
                $image = $request->file("projects.$index.image");
                if ($project->image_path) {
                    Storage::disk('public')->delete($project->image_path);
                }
                $project->image_path = $image->store('installer-projects', 'public');
            }

            $project->save();
        }

        return redirect()
            ->route('simpleWorkflowReport.installer-applications.edit', $installerApplication)
            ->with('success', 'اطلاعات با موفقیت به‌روزرسانی شد.');
    }

    public function sendForCompeleteProfile(InstallerApplication $installerApplication){
        //آیا کاربری با شماره موبایل نصاب وجود دارد؟
        // اگر وجود نداشت بساز
        $mobile = convertPersianToEnglish($installerApplication->phone);
        $user = User::where('mobile', $mobile)->first();
        if(!$user){
            $user = new User();
            $user->email = $mobile;
            $user->name = $installerApplication->first_name . ' ' . $installerApplication->last_name;
            $user->save();
        }
        $user->update(['role_id' => 10]);

        //ایجاد فرایندارزیابی و جذب نصابان
        $inbox = ProcessController::startFromScript(
            "",
            $user->id,
            null,
            null
        );

        //متغیرها از جدول نصابان در پرونده ذخیره شود
        $case = $inbox->case;
        $case->saveVariable('user-firstname', $installerApplication->first_name);
        $case->saveVariable('user-lastname', $installerApplication->last_name);
        $case->saveVariable('user-national-id', $installerApplication->national_id);
        $case->saveVariable('mobile', $installerApplication->phone);
        $case->saveVariable('province', $installerApplication->province);
        $case->saveVariable('city', $installerApplication->city);
        $case->saveVariable('description', $installerApplication->description);
        $case->saveVariable('installer_id', $user->id);

        //ارسال پیامک به نصاب جهت تکمیل پروفایل
        SmsController::sendByTemp(
            $mobile,
            786973,
            array([
                'key' => 'NAME',
                'value' => $installerApplication->first_name . ' ' . $installerApplication->last_name,
            ])
        );
        //حذف ثبت نام نصاب از جدول نصابان
        $installerApplication->delete();
    }
}
