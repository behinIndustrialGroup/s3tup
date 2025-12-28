@extends('behin-layouts.app')

@section('title')
    گزارش ثبت‌نام صنایع
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">لیست ثبت‌نامی‌های صنایع</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>نام شرکت</th>
                                        <th>کد اقتصادی</th>
                                        <th>استان / شهر</th>
                                        <th>آدرس</th>
                                        <th>سطح ولتاژ</th>
                                        <th>توان درخواستی (کیلووات)</th>
                                        <th>اهداف</th>
                                        <th>کد وزارت صنعت</th>
                                        <th>نوع صنعت</th>
                                        <th>نام مخاطب</th>
                                        <th>سمت مخاطب</th>
                                        <th>موبایل</th>
                                        <th>ایمیل</th>
                                        <th>توضیحات</th>
                                        <th>تاریخ ایجاد</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registrations as $registration)
                                        <tr>
                                            <td>{{ $registration->id }}</td>
                                            <td>{{ $registration->company_name }}</td>
                                            <td>{{ $registration->economic_code }}</td>
                                            <td>{{ $registration->province }} / {{ $registration->city }}</td>
                                            <td>{{ $registration->address }}</td>
                                            <td>{{ $registration->voltage_level }}</td>
                                            <td>{{ $registration->demand_kw }}</td>
                                            <td>{{ $registration->goals }}</td>
                                            <td>{{ $registration->industry_ministry_code }}</td>
                                            <td>{{ $registration->industry_type }}</td>
                                            <td>{{ $registration->contact_name }}</td>
                                            <td>{{ $registration->contact_position }}</td>
                                            <td>{{ $registration->mobile }}</td>
                                            <td>{{ $registration->email }}</td>
                                            <td>{{ $registration->description }}</td>
                                            <td>{{ $registration->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3">
                            <div class="text-muted small">
                                نمایش {{ $registrations->firstItem() ?? 0 }} تا {{ $registrations->lastItem() ?? 0 }} از {{ number_format($registrations->total()) }} رکورد
                            </div>
                            <div>
                                {{ $registrations->onEachSide(1)->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
