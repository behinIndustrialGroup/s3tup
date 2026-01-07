@php

    use Behin\SimpleWorkflow\Models\Entities\Sales;
    use Behin\SimpleWorkflow\Models\Entities\Sale_items;
    use Behin\SimpleWorkflow\Models\Entities\Zarinpal_payment_records;
    use Behin\SimpleWorkflow\Models\Entities\Azkivam_payment_records;
    use App\Http\Controllers\zarinPal;
    use App\Http\Controllers\Azkivam;

    if (isset($_GET['Authority'])) {
        $authority = $_GET['Authority'];
        $s3tupPayments = Zarinpal_payment_records::where('pay_token', $authority)->first();
        if ($s3tupPayments and $s3tupPayments->status == 'pending') {
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
    if (isset($_GET['ticketId'])) {
        $ticket_id = $_GET['ticketId'];
        $azkiPayments = Azkivam_payment_records::where('ticket_id', $ticket_id)->first();
        if ($azkiPayments and $azkiPayments->status == 'pending') {
            $accessToken = Azkivam::getAccessToken();
            if ($accessToken['status'] != 200) {
                return response->json([
                    'status' => 400,
                    'result' => $accessToken,
                ]);
            }
            $accessToken = $accessToken['accessToken'];
            $verify = Azkivam::verifyAzkivamTicketWithToken($accessToken, ['ticket_id' => $ticket_id]);
            if ($verify['status'] == 200) {
                $azkiPayments->status = 'verify';
                $azkiPayments->save();
                echo "<div class='alert alert-success'>پرداخت با موفقیت انجام شد</div>";
            } else {
                $azkiPayments->status = 'failed';
                $azkiPayments->save();
                echo "<div class='alert alert-danger'>خطا در پرداخت</div>";
            }
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
                <td>
                    @if ($item->status == 'success')
                        پرداخت شده
                    @else
                        <button class="btn btn-success" onclick="azkiPayment('{{ $item->id }}')">
                            پرداخت
                        </button>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</div>
<script>
    function s3yupPayment(id) {
        var scriptId = 'fe098e3d-2af8-46ad-93ef-15ef9a406c05';
        var fd = new FormData();
        fd.append('item_id', id);
        fd.append('callback_url', window.location.origin + window.location.pathname);
        runScript(scriptId, fd, function(response) {
            if (response.status == 200) {
                var url = '{{ config('zarinpal.pay_url') }}' + response.pay_token;
                console.log(url);
                window.location.href = url;
            } else {
                console.log(response);
                show_error("خطایی رخ داده است");
            }
        });
    }

    function azkiPayment(id) {
        var scriptId = '0ab49d5d-5961-44f6-8cff-0d6535d862f8';
        var fd = new FormData();
        fd.append('item_id', id);
        fd.append('callback_url', window.location.origin + window.location.pathname);
        runScript(scriptId, fd, function(response) {
            console.log(response)
            if (response.status == 200) {
                window.location.href = response.payment_url;
            } else {
                console.log(response);
                show_error("خطایی رخ داده است");
            }
        });
    }
</script>
