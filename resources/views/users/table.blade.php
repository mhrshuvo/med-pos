<div class="card">
    <div class="card-header">
        <h4>Pharmacist</h4>
        <div class="card-header-form">
            <a href="{{ route('users.create') }}" class="btn btn-primary float-right"><i
                    class="fa fa-plus"></i> Add Pharmacist </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Username</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $key=> $user)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td><img width="50" src="{{ $user->image ?? 'assets/backend/image/user.png' }}" alt="user.png">
                        </td>
                        <td>{{ @$user->name }}</td>
                        <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                        <td><a href="tel:{{ $user->phone }}">{{ $user->phone }}</a></td>
                        <td>{{ $user->username }}</td>
                        <td>
                            <label class="custom-switch mt-2">
                                <input type="checkbox" name="custom-switch-checkbox" data-table="users"
                                       data-id="{{ $user->id }}"
                                       class="custom-switch-input" {{ $user->status == 1 ? 'checked' : '' }}>
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
                                       href="{{ route('users.edit',$user->id) }}"><i
                                            class="fas fa-pencil-alt"></i> Edit</a>

                                    <a class="dropdown-item has-icon trash_btn" href="#"><i
                                            class="fas fa-trash"></i> Delete</a>
                                </div>
                            </div>
                            <form class="trash_form" action="{{ route('users.destroy',$user->id) }}"
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
        {{ $users->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>

