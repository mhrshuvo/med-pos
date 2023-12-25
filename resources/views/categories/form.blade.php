<div class="card">
    @php
    $route = isset($category) ? route('categories.update',$category->id) : route('categories.store');
    @endphp

    <form method="POST" action="{{ $route }}" enctype="multipart/form-data">
        @csrf
        @isset($category)
            @method('PUT')
        @endisset
        <div class="card-header">
            <h4>{{ isset($category) ? 'Edit' : 'Add' }} Category</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-lg-12">
                    <label for="name">Name <strong class="text-danger">*</strong></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                           value="{{ isset($category) ? $category->name : old('name') }}">
                    <span class="text-danger"> {{ $errors->first('name') }} </span>
                </div>

                <div class="col-lg-12">
                    <label for="description">Description </label>
                    <textarea class="form-control" id="description"
                              name="description">{{ isset($category) ? $category->description : old('description') }}</textarea>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>

