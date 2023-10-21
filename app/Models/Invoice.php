<?php

namespace App\Models;

use App\Models\InvoiceDetail;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'price', 'invoice_number', 'payment_method_id', 'payment_reference', 'delivery_address', 'delivery_status', 'resi_number', 'delivery_fee', 'delivery_courier', 'payment_status', 'payment_due_date'];

    protected $appends = ['totalPrice'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function invoiceDetails()
    {
        return $this->hasMany(InvoiceDetail::class);
    }

    public function getTotalPriceAttribute()
    {
        $total = 0;
        foreach ($this->invoiceDetails as $detail) {
            $total += $detail->price * $detail->quantity;
        }
        return $total;
    }
}
