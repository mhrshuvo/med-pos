<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['expiry_date','batch_id','medicinable_id','medicinable_type','medicine_id','quantity','price'];

    public function medicine(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }

    public function scopeStock($query)
    {
        return $query->whereDate('expiry_date','>=',Carbon::now())->where('quantity','>',0);
    }
}
