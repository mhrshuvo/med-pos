<?php

namespace App\Traits;

trait Transaction
{
    public function makeTransaction($data, $class): bool
    {
        if ($class->transaction) {
            $class->transaction()->update([
                'amount' => $data['amount'],
            ]);
        } else {
            \App\Models\Transaction::create([
                'title' => $data['title'],
                'transactionable_type' => get_class($class),
                'transactionable_id' => $class->id,
                'amount' => $data['amount'],
                'description' => $data['description'],
                'type' => $data['type'],
            ]);
        }
        return true;
    }

}
