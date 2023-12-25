<tr id="{{ $medicine->id }}">
    <td width="30%"><input type="hidden" value="{{ $medicine->id }}" name="medicine_ids[]">{{ $medicine->name }}</td>
    <td width="20%"><input type="number" step="0.1" max="{{ $stock }}" class="form-control quantities" value="1"
                           name="quantities[]">
    </td>
    <td width="20%"><input type="number" step="0.1" class="form-control prices" value="{{ $medicine->price }}"
                           name="prices[]">
    </td>
    <td width="20%"><input type="number" step="0.1" class="form-control sub_totals" value="{{ $medicine->price }}"
                           name="sub_totals[]" readonly></td>
    <td><a href="javascript:void(0)" class="btn btn-danger remove_row"><i class="fas fa-trash"></i></a></td>
</tr>

