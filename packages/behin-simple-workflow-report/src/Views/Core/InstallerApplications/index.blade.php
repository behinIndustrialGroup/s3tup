@extends('behin-layouts.app')

@section('title')
    گزارش نصاب‌ها
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">درخواست‌های ارسال شده</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>نام</th>
                                        <th>نام خانوادگی</th>
                                        <th>کدملی</th>
                                        <th>تلفن</th>
                                        <th>استان / شهر</th>
                                        <th>خلاصه رزومه</th>
                                        <th>پروژه‌ها</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applications as $application)
                                        <tr>
                                            <td>{{ $application->first_name }}</td>
                                            <td>{{ $application->last_name }}</td>
                                            <td>{{ $application->national_id }}</td>
                                            <td>{{ $application->phone }}</td>
                                            <td>{{ $application->province }} / {{ $application->city }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit(optional($application->profile)->summary, 50) }}</td>
                                            <td>{{ $application->projects->count() }}</td>
                                            <td>
                                                <a href="{{ route('simpleWorkflowReport.installer-applications.edit', $application) }}"
                                                    class="btn btn-primary btn-sm">ویرایش</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3">
                            <div class="text-muted small">
                                نمایش {{ $applications->firstItem() ?? 0 }} تا {{ $applications->lastItem() ?? 0 }} از {{ number_format($applications->total()) }} رکورد
                            </div>
                            <div>
                                {{ $applications->onEachSide(1)->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
