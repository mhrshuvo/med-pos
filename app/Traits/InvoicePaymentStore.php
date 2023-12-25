<?php

namespace App\Traits;

use App\Models\InvoiceItems;
use App\Models\InvoicePayment;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

trait InvoicePaymentStore
{
    public function storeAmount($data, $class): bool
    {

        if ($class->payment) {
            $class->payment->update([
                'amount' => $data['paid_amount'],
            ]);
        }
        else {
            InvoicePayment::create([
                'medicineable_type' => get_class($class),
                'medicineable_id' => $class->id,
                'amount' => $data['paid_amount'],
            ]);
        }

        return true;
    }

}
