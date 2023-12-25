<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItems extends Model
{
    use HasFactory;

    protected $fillable = ['medicine_id','medicineable_type','medicineable_id','batch_id','expiry_date','quantity','price','sub_total',''];

    public function medicineable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function medicine(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }

    public function scopeApproved($query)
    {
        return $query->whereHas('medicineable',function ($query){
            $query->Active();
        });
    }
}
