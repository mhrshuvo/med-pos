<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicineRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->medicine ? $this->medicine->id : '';
        return [
            'category_id' => 'required',
            'type_id' => 'required',
            'unit_id' => 'required',
            'name' => 'required|unique:medicines,name,'.$id,
            'price' => 'required',
            'purchase_price' => 'required',
        ];
    }
}
