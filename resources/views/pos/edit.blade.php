<tbody>
@foreach ($pos->items as $medicine)
    @php
    $stock =  $medicine->medicine->stocks()->stock()->sum('quantity');
    @endphp
    <tr id="{{ $medicine->medicine_id }}">
        <td width="30%"><input type="hidden" value="{{ $medicine->medicine_id }}" name="medicine_ids[]">{{ @$medicine->medicine->name }}</td>
        <td width="20%"><input type="number" step="0.1" max="{{ $stock }}" class="form-control quantities" value="{{ $medicine->quantity }}"
                               name="quantities[]">
        </td>
        <td width="20%"><input type="number" step="0.1" class="form-control prices" value="{{ $medicine->price }}"
                               name="prices[]">
        </td>
        <td width="20%"><input type="number" step="0.1" class="form-control sub_totals" value="{{ $medicine->sub_total }}"
                               name="sub_totals[]" readonly></td>
        <td><a href="javascript:void(0)" class="btn btn-danger remove_row"><i class="fas fa-trash"></i></a></td>
    </tr>
@endforeach

</tbody>
<tfoot>
<tr>
    <td colspan="3" class="text-right">Net Total</td>
    <td>
        <input type="number" step="0.1" readonly value="{{ $pos->items->sum('sub_total') }}" name="net_total"
               placeholder="Net Total"
               class="form-control net_total border-0">
    </td>
    <td></td>
</tr>
<tr>
    <td colspan="3" class="text-right">Vat</td>
    <td>
        <div class="input-group">
            <input type="number" step="0.1" class="form-control vat_amount"
                   name="vat_amount"
                   value="{{ $pos->vat_amount }}">
        </div>
    </td>
    <td></td>
</tr>
<tr>
    <td colspan="3" class="text-right">Discount</td>
    <td>
        <div class="input-group">
            <input type="number" step="0.1" class="form-control discount_amount"
                   name="discount_amount"
                   value="{{ $pos->discount_amount }}">
        </div>
    </td>
    <td></td>
</tr>
<tr>
    <td colspan="3" class="text-right">Grand Total</td>
    <td>
        <input type="number" step="0.1" readonly name="total_amount" value="{{ $pos->total_amount }}"
               placeholder="Grand Total"
               class="form-control total_amount border-0">
    </td>
    <td></td>
</tr>
@php
$amount = $pos->payment ? $pos->payment->amount : 0;
@endphp
<tr class="paid_div">
    <td colspan="3" class="text-right">Paid Amount</td>
    <td>
        <input type="number" step="0.1" name="paid_amount" value="{{ $amount }}"
               placeholder="Paid Amount"
               class="form-control paid_amount border-0">
    </td>
    <td></td>
</tr>
<tr class="due_div">
    <td colspan="3" class="text-right">Due Amount</td>
    <td>
        <input type="number" step="0.1" readonly name="due_amount" value="{{ $pos->total_amount - $amount }}"
               placeholder="Paid Amount"
               class="form-control due_amount border-0">
    </td>
    <td></td>
</tr>
</tfoot>
