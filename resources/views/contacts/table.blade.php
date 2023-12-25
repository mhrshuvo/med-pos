<div class="card">
    <div class="card-header">
        <h4>Contact</h4>
        <div class="card-header-form">
            <a href="{{ route('contacts.create') }}" class="btn btn-primary float-right"><i
                    class="fa fa-plus"></i> Add Contact </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Contact ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Alternative Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($contacts as $key=> $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td><img width="50" src="{{ $item->image ?? 'assets/backend/image/user.png' }}" alt="user.png"></td>
                        <td>{{ @$item->contact_id }}</td>
                        <td>{{ @$item->name }}</td>
                        <td><a href="mailto:{{ $item->email }}">{{ $item->email }}</a></td>
                        <td><a href="tel:{{ $item->phone }}">{{ $item->phone }}</a></td>
                        <td><a href="tel:{{ $item->alternate_phone }}">{{ $item->alternate_phone }}</a></td>
                        <td>{{ $item->address }}</td>
                        <td>
                            <label class="custom-switch mt-2">
                                <input type="checkbox" name="custom-switch-checkbox" data-table="contacts"
                                       data-id="{{ $item->id }}"
                                       class="custom-switch-input" {{ $item->status == 1 ? 'checked' : '' }}>
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </td>
                        <td>
                            <div class="dropdown d-inline">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-start">
                                    <a class="dropdown-item has-icon"
                                       href="{{ route('contacts.edit',$item->id) }}"><i
                                            class="fas fa-pencil-alt"></i> Edit</a>

                                    <a class="dropdown-item has-icon trash_btn" href="#"><i
                                            class="fas fa-trash"></i> Delete</a>
                                </div>
                            </div>
                            <form class="trash_form" action="{{ route('contacts.destroy',$item->id) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <div class="card-footer text-right">
        {{ $contacts->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>

