<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','type_id','unit_id','name','generic_name','price','image','purchase_price','details'];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function stocks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Stock::class);
    }

    public function invoices(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(InvoiceItems::class)->where('medicineable_type',Pos::class);
    }

    public function purchases(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(InvoiceItems::class)->where('medicineable_type',Purchase::class);
    }

    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function unit(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function scopeActive($q)
    {
        return $q->where('status',1);
    }

    public function scopeStock($q)
    {
        return $q->whereHas('stocks',function ($query){
            $query->whereDate('expiry_date','>=',Carbon::now())->where('quantity','>',0);
        });
    }
}
