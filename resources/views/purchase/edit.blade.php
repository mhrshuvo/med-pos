<table class="table table-bordered purchase_invoice_table">
    <thead>
    <tr>
        <th scope="col">Medicine</th>
        <th scope="col">Expiry Date</th>
        <th scope="col">Batch Id</th>
        <th scope="col">Price</th>
        <th scope="col">Quantity</th>
        <th scope="col">Subtotal</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody class="table_body">
    @foreach ($purchase->items as $item)
        <tr>
            <td width="20%">

                <select class="form-control medicine_id product"
                        name="medicine_ids[]">
                    <option value="">Select One</option>
                    @foreach ($medicines as $medicine)
                        <option value="{{ $medicine->id }}" {{ $item->medicine_id == $medicine->id ? 'selected' : '' }}
                        data-purchase_price="{{ $medicine->purchase_price }}"
                                data-price="{{ $medicine->price }}">{{ $medicine->name }}</option>
                    @endforeach
                </select>

            </td>
            <td width="15%">

                <input type="text" name="expiry_dates[]" value="{{ $item->expiry_date }}"
                       placeholder="Expiry Date"
                       class="form-control datepicker expiry_dates">

            </td>
            <td width="15%">

                <input type="number" step="0.1" name="batch_ids[]" placeholder="Batch ID"
                       class="form-control" value="{{ $item->batch_id }}">

            </td>
            <td width="10%">

                <input type="number" step="0.1" name="prices[]" value="{{ $item->price }}" placeholder="Price"
                       class="form-control prices">

            </td>
            <td width="10%">

                <input type="number" step="0.1" name="quantities[]" value="{{ $item->quantity }}" placeholder="Quantity"
                       class="form-control quantities">

            </td>
            <td width="20%">

                <input type="number" step="0.1" readonly name="sub_totals[]" value="{{ $item->sub_total }}"
                       placeholder="Sub Total"
                       class="form-control sub_totals">

            </td>
            <td width="10%"></td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="5" class="text-right">Net Total</td>
        <td>

            <input type="number" step="0.1" readonly value="{{ $purchase->items->sum('sub_total') }}" name="net_total"
                   placeholder="Net Total"
                   class="form-control net_total border-0">

        </td>
    </tr>
    <tr>
        <td colspan="5" class="text-right">Vat</td>
        <td>

            <div class="input-group">
                <input type="number" step="0.1" class="form-control vat" name="vat" value="{{ $purchase->vat }}">
                <select class="custom-select vat_type" name="vat_type">
                    <option value="0" {{ $purchase->vat_type == 0 ? 'selected' : '' }}>Fixed</option>
                    <option value="1" {{ $purchase->vat_type == 1 ? 'selected' : '' }}>Percentage</option>
                </select>
                <input type="number" step="0.1" class="form-control vat_amount" readonly name="vat_amount"
                       value="{{ $purchase->vat_amount }}">
            </div>

        </td>
    </tr>
    <tr>
        <td colspan="5" class="text-right">Discount</td>
        <td>
            <div class="input-group">
                <input type="number" step="0.1" class="form-control discount" name="discount"
                       value="{{ $purchase->discount }}">
                <select class="custom-select discount_type" name="discount_type">
                    <option value="0" {{ $purchase->discount_type == 0 ? 'selected' : '' }}>Fixed</option>
                    <option value="1" {{ $purchase->discount_type == 1 ? 'selected' : '' }}>Percentage</option>
                </select>
                <input type="number" step="0.1" class="form-control discount_amount" readonly name="discount_amount"
                       value="{{ $purchase->discount_amount }}">
            </div>

        </td>
    </tr>
    <tr>
        <td colspan="5" class="text-right">Grand Total</td>
        <td>
            <input type="number" step="0.1" readonly name="total_amount" value="{{ $purchase->total_amount }}"
                   placeholder="Grand Total"
                   class="form-control total_amount border-0">

        </td>
    </tr>
    <tr>
        <td colspan="5" class="text-right">Paid Amount</td>
        <td>
            <input type="number" step="0.1" name="paid_amount" value="{{ @$purchase->payment->amount }}"
                   placeholder="Paid Amount"
                   class="form-control paid_amount border-0">
        </td>
    </tr>
    <tr>
        <td colspan="5" class="text-right">Due Amount</td>
        <td>
            <input type="number" step="0.1" readonly name="due_amount"
                   value="{{ $purchase->total_amount - @$purchase->payment->amount }}" placeholder="Due Amount"
                   class="form-control due_amount border-0">
        </td>
    </tr>
    </tfoot>
</table>
