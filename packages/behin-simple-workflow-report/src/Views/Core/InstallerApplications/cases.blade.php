@extends('behin-layouts.app')

@section('title')
    گزارش پرونده های نصابان
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>شماره پرونده</th>
                    <th>تاریخ ایجاد</th>
                </tr>
                @foreach ($cases as $case)
                    <tr>
                        <td>{{ $case->number }}</td>
                        <td>{{ $case->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>
@endsection