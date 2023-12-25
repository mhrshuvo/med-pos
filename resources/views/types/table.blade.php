<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>

                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($types as $key=> $item)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td>{{ $item->name }}</td>
                    <td><label class="custom-switch mt-2">
                            <input type="checkbox" name="custom-switch-checkbox" data-table="types"
                                   data-id="{{ $item->id }}"
                                   class="custom-switch-input" {{ $item->status == 1 ? 'checked' : '' }}>
                            <span class="custom-switch-indicator"></span>
                        </label></td>
                    <td>
                        <div class="dropdown d-inline">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-start">
                                <a class="dropdown-item has-icon"
                                   href="{{ route('types.edit',$item->id) }}"><i
                                        class="fas fa-pencil-alt"></i> Edit</a>

                                <a class="dropdown-item has-icon trash_btn" href="#"><i
                                        class="fas fa-trash"></i> Delete</a>
                            </div>
                        </div>
                        <form class="trash_form" action="{{ route('types.destroy',$item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer text-right">
        {{ $types->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>

