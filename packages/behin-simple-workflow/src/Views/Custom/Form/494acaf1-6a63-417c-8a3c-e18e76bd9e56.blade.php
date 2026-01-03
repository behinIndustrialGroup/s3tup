@extends('behin-layouts.app')

@section('title', $form->name)

@php
use Behin\SimpleWorkflow\Models\Entities\Sales;
use Behin\SimpleWorkflow\Models\Entities\Sale_items;
    $sale = Sales::where('case_number', $case->number)->first();
    $saleItems = Sale_items::where('case_number', $case->number)->get();
@endphp

@section('content')

<table>
    <tr>
        <th>شرح پرداخت</th>
        <th>مبلغ کل</th>
        <th>درگاه</th>
        <th>پرداخت</th>
    </tr>
    @foreach ($saleItems as $item)
        <tr>
            <td>{{ $item->description }}</td>    
            <td>{{ $item->total }}</td>    
            <td>{{ $item->payment_gateway }}</td>    
            <td>{{ $item->payment_status }}</td>    
        </tr>    
    @endforeach
</table>
@endsection