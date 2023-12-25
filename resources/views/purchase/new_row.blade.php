<div class="modal" id="row_modal">
    <table>
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
                    <input type="text" name="prices[]" value="0" placeholder="Price"
                           class="form-control prices">
                </div>
            </td>
            <td width="10%">
                <div class="form-group">
                    <input type="text" name="quantities[]" value="0" placeholder="Quantity"
                           class="form-control quantities">
                </div>
            </td>
            <td width="20%">
                <div class="form-group">
                    <input type="text" readonly name="sub_totals[]" value="0" placeholder="Sub Total"
                           class="form-control sub_totals">
                </div>
            </td>
            <td>
                <a href="javascript:void(0)" class="btn btn-icon btn-danger remove_row"><i
                        class="fas fa-trash"></i></a>
            </td>
        </tr>
    </table>
</div>
