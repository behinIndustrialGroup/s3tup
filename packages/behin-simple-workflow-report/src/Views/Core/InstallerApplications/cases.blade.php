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
                    <th>آخرین وضعیت</th>
                    <th>وضعیت قبلی</th>
                </tr>
                @foreach ($cases as $case)
                    <tr>
                        <td>
                            <a href="{{ route('simpleWorkflow.inbox.caseHistoryView', ['caseNumber' => $case->number]) }}"
                                target="_blank">
                                <i class="material-icons">history</i>
                            </a>
                            {{ $case->number }}
                        </td>
                        <td>{{ $case->created_at->format('Y-m-d') }}</td>
                        <td>
                            @foreach ($case->whereIs() as $inbox)
                                {{ $inbox->task->name ?? '' }}
                            @endforeach
                        </td>
                        <td>{{ $case->previous_status }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>
@endsection
