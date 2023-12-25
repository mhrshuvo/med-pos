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
    <tr>
        <td width="20%">
            <div class="form-group">
                <select class="form-control medicine_id product"
                        name="medicine_ids[]">
                    <option value="">Select One</option>
                    @foreach ($medicines as $medicine)
                        <option value="{{ $medicine->id }}"
                                data-purchase_price="{{ $medicine->purchase_price }}"
                                data-price="{{ $medicine->price }}">{{ $medicine->name }}</option>
                    @endforeach
                </select>
            </div>
        </td>
        <td width="15%">
            <div class="form-group">
                <input type="text" name="expiry_dates[]"
                       placeholder="Expiry Date"
                       class="form-control datepicker expiry_dates">
            </div>
        </td>
        <td width="15%">
            <div class="form-group">
                <input type="text" name="batch_ids[]" placeholder="Batch ID"
                       class="form-control">
            </div>
        </td>
        <td width="10%">
            <div class="form-group">
                <input type="number" step="0.1" name="prices[]" value="0" placeholder="Price"
                       class="form-control prices">
            </div>
        </td>
        <td width="10%">
            <div class="form-group">
                <input type="number" step="0.1" name="quantities[]" value="0" placeholder="Quantity"
                       class="form-control quantities">
            </div>
        </td>
        <td width="20%">
            <div class="form-group">
                <input type="number" readonly name="sub_totals[]" value="0" placeholder="Sub Total"
                       class="form-control sub_totals">
            </div>
        </td>
        <td width="10%"></td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="5" class="text-right">Net Total</td>
        <td>
            <div class="form-group">
                <input type="number" step="0.1" readonly value="0" name="net_total" placeholder="Net Total"
                       class="form-control net_total border-0">
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="5" class="text-right">Vat</td>
        <td>
            <div class="form-group">
                <div class="input-group">
                    <input type="number" step="0.1" class="form-control vat" name="vat" value="0">
                    <select class="custom-select vat_type" name="vat_type">
                        <option value="0">Fixed</option>
                        <option value="1">Percentage</option>
                    </select>
                    <input type="number" step="0.1" class="form-control vat_amount" readonly name="vat_amount" value="0">
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="5" class="text-right">Discount</td>
        <td>
            <div class="form-group">
                <div class="input-group">
                    <input type="number" step="0.1" class="form-control discount" name="discount" value="0">
                    <select class="custom-select discount_type" name="discount_type">
                        <option value="0">Fixed</option>
                        <option value="1">Percentage</option>
                    </select>
                    <input type="number" step="0.1" class="form-control discount_amount" readonly name="discount_amount" value="0">
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="5" class="text-right">Grand Total</td>
        <td>
            <div class="form-group">
                <input type="number" readonly name="total_amount" value="0" placeholder="Grand Total"
                       class="form-control total_amount border-0">
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="5" class="text-right">Paid Amount</td>
        <td>
            <div class="form-group">
                <input type="number" step="0.1" name="paid_amount" value="0" placeholder="Paid Amount"
                       class="form-control paid_amount border-0">
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="5" class="text-right">Due Amount</td>
        <td>
            <div class="form-group">
                <input type="number" step="0.1" readonly name="due_amount" value="0" placeholder="Due Amount"
                       class="form-control due_amount border-0">
            </div>
        </td>
    </tr>
    </tfoot>
</table>
