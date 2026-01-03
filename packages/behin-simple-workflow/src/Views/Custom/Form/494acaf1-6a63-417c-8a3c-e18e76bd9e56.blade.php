@php
    use Behin\SimpleWorkflow\Models\Entities\Sales;
    use Behin\SimpleWorkflow\Models\Entities\Sale_items;
    use Behin\SimpleWorkflow\Models\Entities\Zarinpal_payment_records;
    use Behin\SimpleWorkflow\Models\Entities\Azkivam_payment_records;
    $sale = Sales::where('case_number', $case->number)->first();
    $saleItems = Sale_items::where('case_number', $case->number)->get();
    $s3tupPayments = Zarinpal_payment_records::where('case_number', $case->number)->get();
    $azkiPayments = Azkivam_payment_records::where('case_number', $case->number)->get();
@endphp

<div class="table-responsive">
    <table class="table table-striped">
        <tr>
            <th>شرح پرداخت</th>
            <th>مبلغ کل</th>
            <th>درگاه</th>
            <th>پرداخت</th>
        </tr>
        @foreach ($s3tupPayments as $item)
            <tr>
                <td>{{ $item->description }}</td>
                <td>{{ $item->amount }}</td>
                <td>درگاه ستاپ</td>
                <td>{{ $item->status }}</td>
            </tr>
        @endforeach
        @foreach ($azkiPayments as $item)
            <tr>
                <td>{{ $item->description }}</td>
                <td>{{ $item->amount }}</td>
                <td>درگاه ازکی وام</td>
                <td>{{ $item->status }}</td>
            </tr>
        @endforeach
    </table>
</div>
