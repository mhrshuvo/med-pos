<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Pos;
use App\Models\Purchase;
use App\Models\Stock;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function stock()
    {
        $data = [
            'medicines' => Medicine::with('invoices', 'purchases', 'stocks')
                ->whereHas('invoices', function ($query) {
                    $query->Approved();
                })->whereHas('purchases', function ($query) {
                    $query->Approved();
                })->active()->get()
        ];
        return view('report.stock', $data);
    }

    public function batchReport()
    {
        $data = [
            'stocks' => Stock::with('medicine')->stock()->get()
        ];
        return view('report.batch', $data);
    }

    public function purchaseReport()
    {
        $data = [
            'purchases' => Purchase::with('contact')->active()->get()
        ];
        return view('report.purchases', $data);
    }

    public function invoiceReport()
    {
        $data = [
            'invoices' => Pos::with('contact')->active()->get()
        ];
        return view('report.invoices', $data);
    }
}
