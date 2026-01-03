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
                <td>{{ number_format($item->amount) }} ریال</td>
                <td>درگاه ستاپ</td>
                <td>
                    <button class="btn btn-success" onclick="s3yupPayment('{{ $item->id }}')">
                        پرداخت
                    </button>
                </td>
            </tr>
        @endforeach
        @foreach ($azkiPayments as $item)
            <tr>
                <td>{{ $item->description }}</td>
                <td>{{ number_format($item->amount) }} ریال</td>
                <td>درگاه ازکی وام</td>
                <td>{{ $item->status }}</td>
            </tr>
        @endforeach
    </table>
</div>
<script>
    function s3yupPayment(id) {
        var scriptId = 'fe098e3d-2af8-46ad-93ef-15ef9a406c05';
        var fd = new FormData();
        fd.append('item_id', id);
        fd.append('callback_url', window.location.href);
        runScript(scriptId, fd, function (response) {
            console.log(response);
            if(response.pay_token){
                var url = '{{ config("zarinpal.pay_url") }}' + response.pay_token;
                console.log(url);
                // window.location.href = '{{ config("zarinpal.pay_url") }}' + response.pay_token;
            }else{
                show_error("خطایی رخ داده است");
            }
        });
    }
</script>