<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Medicine;
use App\Models\Pos;
use App\Models\Purchase;
use App\Models\Stock;
use App\Traits\InvoiceItemStore;
use App\Traits\InvoicePaymentStore;
use App\Traits\Transaction;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{

    use InvoiceItemStore, InvoicePaymentStore, Transaction;

    public function index()
    {
        try {
            $data = [
                'purchases' => Purchase::with('contact', 'payment')->paginate(15)
            ];
            return view('purchase.index', $data);
        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong');
            return back();
        }
    }

    public function create()
    {
        try {
            $data = [
                'contacts' => Contact::supplier()->active()->get(),
                'medicines' => Medicine::active()->get(),
            ];
            return view('purchase.form', $data);
        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong');
            return back();
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'medicine_ids' => 'required',
            'expiry_dates' => 'required',
            'batch_ids' => 'required',
            'contact_id' => 'required',
            'purchase_no' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $data = $request->all();

            $data['total_quantity'] = array_sum($request->quantities);

            if ($data['paid_amount'] == $data['total_amount']) {
                $data['is_paid'] = 1;
            }

            $purchase = Purchase::create($data);

            $this->storeProducts($data, $purchase);

            if ($data['paid_amount'] > 0) {
                $this->storeAmount($data, $purchase);
            }

            DB::commit();
            Toastr::success('Purchase Created Successfully');

            return redirect()->route('purchase.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Something Went Wrong');
            return back();
        }
    }

    public function show(Purchase $purchase)
    {
        try {
            $data = [
                'purchase' => $purchase,
            ];
            return view('purchase.view', $data);
        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong');
            return back();
        }
    }

    public function edit(Purchase $purchase)
    {
        try {
            $data = [
                'contacts' => Contact::supplier()->active()->get(),
                'medicines' => Medicine::active()->get(),
                'purchase' => $purchase,
            ];
            return view('purchase.form', $data);
        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong');
            return back();
        }
    }

    public function update(Request $request, Purchase $purchase)
    {
        $request->validate([
           'medicine_ids' => 'required',
           'expiry_dates' => 'required',
           'batch_ids' => 'required',
           'contact_id' => 'required',
           'purchase_no' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $data = $request->all();

            $data['total_quantity'] = array_sum($request->quantities);

            if ($data['paid_amount'] == $data['total_amount']) {
                $data['is_paid'] = 1;
            }

            $purchase->update($data);

            $purchase->items()->delete();

            $this->storeProducts($data, $purchase);

            if ($data['paid_amount'] > 0) {
                $this->storeAmount($data, $purchase);
            }

            DB::commit();

            Toastr::success('Purchase Updated Successfully');

            return redirect()->route('purchase.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Something Went Wrong');
            return back();
        }
    }

    public function destroy(Purchase $purchase)
    {
        try {
            DB::beginTransaction();
            $purchase->delete();

            $purchase->items()->delete();

            $purchase->payment()->delete();

            DB::commit();
            Toastr::success('Purchase Deleted Successfully', 'success!');

            return back();

        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Something Went Wrong', 'error!');
            return back();
        }
    }

    public function approve($id)
    {
        DB::beginTransaction();
        try {
            $purchase = Purchase::find($id);

            $purchase->update([
                'status' => 1
            ]);

            foreach ($purchase->items as $item)
            {
                Stock::create([
                    'medicinable_type' => $item->medicineable_type,
                    'medicinable_id' => $item->medicineable_id,
                    'medicine_id' => $item->medicine_id,
                    'expiry_date' => $item->expiry_date,
                    'batch_id' => $item->batch_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
            }

            if ($purchase->payment) {
                $this->makeTransaction([
                    'title' => 'Purchase Medicines',
                    'amount' => @$purchase->payment->amount,
                    'description' => 'Transanction Has Been Made for Purchasing Medicines',
                    'type' => 0,
                ],$purchase);
            }

            DB::commit();

            Toastr::success('Purchase Approved Successfully', 'success!');

            return back();

        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Something Went Wrong', 'error!');
            return back();
        }
    }

    public function payment(Request $request): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {
            if ($request->type == 'pos') {
                $purchase = Pos::find($request->id);
            }
            else {
                $purchase = Purchase::find($request->id);
            }
            $data['paid_amount'] = @$purchase->payment->amount + $request->amount;
            $this->storeAmount($data, $purchase);
            $this->makeTransaction([
                'title' => 'Purchase Medicines',
                'amount' => $request->amount,
                'description' => 'Transanction Has Been Made for Purchasing Medicines',
                'type' => 0,
            ], $purchase);
            DB::commit();
            Toastr::success('Amount Added Successfully', 'success!');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Something Went Wrong', 'error!');
            return back();
        }
    }
}
