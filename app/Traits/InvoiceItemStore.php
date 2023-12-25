<?php

namespace App\Traits;

use App\Models\InvoiceItems;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

trait InvoiceItemStore
{
    public function storeProducts($data,$class)
    {
        foreach ($data['medicine_ids'] as $key=> $medicine) {
            InvoiceItems::create([
                'medicine_id' => $medicine,
                'medicineable_type' => get_class($class),
                'medicineable_id' => $class->id,
                'batch_id' => array_key_exists('batch_ids',$data) ? $data['batch_ids'][$key] : '',
                'expiry_date' => array_key_exists('expiry_dates',$data) ? $data['expiry_dates'][$key] : null,
                'quantity' => $data['quantities'][$key],
                'price' => $data['prices'][$key],
                'sub_total' => $data['sub_totals'][$key],
            ]);
        }
        return true;
    }

}
