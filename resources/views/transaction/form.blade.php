<div class="card">
    @php
    $route = isset($edit) ? route('transactions.update',$edit->id) : route('transactions.store');
    @endphp

    <form method="POST" action="{{ $route }}" enctype="multipart/form-data">
        @csrf
        @isset($edit)
            @method('PUT')
        @endisset
        <div class="card-header">
            <h4>{{ isset($edit) ? 'Edit' : 'Add' }} {{ isset($edit) && $edit->type == 0 ? 'Expense' : 'Income' }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-lg-12">
                    <label for="title">Title <strong class="text-danger">*</strong></label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                           value="{{ isset($edit) ? $edit->title : old('title') }}">
                    <span class="text-danger"> {{ $errors->first('title') }} </span>
                </div>

                <input type="hidden" name="type" value="{{ isset($edit) ? $edit->type : (request()->is('income') ? 1 : 0) }}">

                <div class="form-group col-lg-12">
                    <label for="amount">Amount <strong class="text-danger">*</strong></label>
                    <input type="number" step="0.1" id="amount" class="form-control" name="amount" placeholder="Amount"
                           value="{{ isset($edit) ? $edit->amount : old('amount') }}">
                    <span class="text-danger"> {{ $errors->first('amount') }} </span>
                </div>

                <div class="col-lg-12">
                    <label for="description">Description </label>
                    <textarea class="form-control" id="description"
                              name="description">{{ isset($edit) ? $edit->description : old('description') }}</textarea>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>

