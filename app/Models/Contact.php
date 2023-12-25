<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','phone','status','image','alternate_phone','contact_id','address','contact_type'];

    public function scopeCustomer($q)
    {
        return $q->where('contact_type',1);
    }

    public function scopeSupplier($q)
    {
        return $q->where('contact_type',0);
    }

    public function scopeActive($q)
    {
        return $q->where('status',1);
    }
}
