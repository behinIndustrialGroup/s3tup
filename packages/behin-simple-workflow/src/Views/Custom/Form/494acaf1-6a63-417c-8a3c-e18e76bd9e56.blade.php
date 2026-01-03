@php

    use Behin\SimpleWorkflow\Models\Entities\Sales;
    use Behin\SimpleWorkflow\Models\Entities\Sale_items;
    use Behin\SimpleWorkflow\Models\Entities\Zarinpal_payment_records;
    use Behin\SimpleWorkflow\Models\Entities\Azkivam_payment_records;
    use App\Http\Controllers\zarinPal;

    if (isset($_GET['Authority'])) {
        $authority = $_GET['Authority'];
        $s3tupPayments = Zarinpal_payment_records::where('pay_token', $authority)->first();
        if ($s3tupPayments) {
            $zarinpalVerify = zarinPal::verify($authority, $s3tupPayments->amount);
            if ($zarinpalVerify['status'] == 200) {
                $s3tupPayments->status = 'success';
                $s3tupPayments->save();
                echo "<div class='alert alert-success'>پرداخت با موفقیت انجام شد</div>";
            } else {
                $s3tupPayments->status = 'failed';
                $s3tupPayments->save();
                echo "<div class='alert alert-danger'>خطا در پرداخت</div>";
            }
            // echo '<pre>';
            // print_r($zarinpalVerify);
            // echo '</pre>';
        }
    }
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
                    @if ($item->status == 'success')
                        پرداخت شده
                    @else
                        <button class="btn btn-success" onclick="s3yupPayment('{{ $item->id }}')">
                            پرداخت
                        </button>
                    @endif
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
        runScript(scriptId, fd, function(response) {
            console.log(response);
            if (response.pay_token) {
                var url = '{{ config('zarinpal.pay_url') }}' + response.pay_token;
                console.log(url);
                // window.location.href = '{{ config('zarinpal.pay_url') }}' + response.pay_token;
            } else {
                show_error("خطایی رخ داده است");
            }
        });
    }
</script>
