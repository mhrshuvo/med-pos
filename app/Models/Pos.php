<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    use HasFactory;

    protected $fillable = ['date','contact_id','invoice_no','discount','discount_type','discount_amount','vat','vat_type','vat_amount','total_quantity','total_amount','status','is_paid','notes'];

    public function contact(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function items(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(InvoiceItems::class, 'medicineable');
    }

    public function payment(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(InvoicePayment::class, 'medicineable');
    }

    public function transaction(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Transaction::class, 'transactionable');
    }

    public function scopeNonPaid($q)
    {
        return $q->where('is_paid',0);
    }

    public function scopeActive($q)
    {
        return $q->where('status',1);
    }
}
