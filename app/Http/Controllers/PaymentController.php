<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function callback()
    {
        $payload = request()->all();
        try {
            if (isset($payload) && md5(env('DUITKU_MERCHANT_CODE') . $payload['amount'] . $payload['merchantOrderId'] . env('DUITKU_KEY')) == $payload['signature']) {
                $inv = Invoice::where([
                    'payment_reference' => $payload['reference'],
                    'invoice_number' => $payload['merchantOrderId'],
                ])->first();
                if ($inv) {
                    if ($payload['resultCode'] == 00) {
                        $inv->payment_status = '1';
                    } else {
                        $inv->payment_status = '2';
                    }
                    $inv->save();
                    return response()->json(['status' => 'OK']);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['status' => $e->getMessage()]);
        }

        return response()->json(['status' => 'ERROR']);
    }
}
