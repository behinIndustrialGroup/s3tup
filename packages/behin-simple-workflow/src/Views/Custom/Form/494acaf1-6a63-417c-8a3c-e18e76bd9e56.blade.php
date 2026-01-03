
@php
use Behin\SimpleWorkflow\Models\Entities\Sales;
use Behin\SimpleWorkflow\Models\Entities\Sale_items;
use Behin\SimpleWorkflow\Models\Entities\Zarinpal_payment_records;
    $sale = Sales::where('case_number', $case->number)->first();
    $saleItems = Sale_items::where('case_number', $case->number)->get();
    $s3tupPayments = Zarinpal_payment_records::where('case_number', $case->number)->get();
@endphp


<table>
    <tr>
        <th>شرح پرداخت</th>
        <th>مبلغ کل</th>
        <th>درگاه</th>
        <th>پرداخت</th>
    </tr>
    @foreach ($s3tupPayments as $item)
        <tr>
            <td>{{ $item->description }}</td>    
            <td>{{ $item->total }}</td>    
            <td>{{ $item->payment_gateway }}</td>    
            <td>{{ $item->payment_status }}</td>    
        </tr>    
    @endforeach
</table>