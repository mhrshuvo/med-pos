<tbody>

</tbody>
<tfoot>
<tr>
    <td colspan="3" class="text-right">Net Total</td>
    <td>
        <input type="number" step="0.1" readonly value="0" name="net_total"
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
                   value="0">
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
                   value="0">
        </div>
    </td>
    <td></td>
</tr>
<tr>
    <td colspan="3" class="text-right">Grand Total</td>
    <td>
        <input type="number" step="0.1" readonly name="total_amount" value="0"
               placeholder="Grand Total"
               class="form-control total_amount border-0">
    </td>
    <td></td>
</tr>
<tr class="paid_div" style="display: none">
    <td colspan="3" class="text-right">Paid Amount</td>
    <td>
        <input type="number" step="0.1" name="paid_amount" value="0"
               placeholder="Paid Amount"
               class="form-control paid_amount border-0">
    </td>
    <td></td>
</tr>
<tr class="due_div" style="display: none">
    <td colspan="3" class="text-right">Due Amount</td>
    <td>
        <input type="number" step="0.1" readonly name="due_amount" value="0"
               placeholder="Paid Amount"
               class="form-control due_amount border-0">
    </td>
    <td></td>
</tr>
</tfoot>
