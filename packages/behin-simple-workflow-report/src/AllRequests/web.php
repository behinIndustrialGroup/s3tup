<?php

use Behin\SimpleWorkflowReport\AllRequests\Controllers\AllRequestsReportController;
use Illuminate\Support\Facades\Route;

Route::name('allRequestsReport.')->prefix('all-request')->middleware(['web', 'auth', 'access:گزارش کل درخواست ها'])->group(function () {
    Route::get('', [AllRequestsReportController::class, 'index'])->name('index');
});
