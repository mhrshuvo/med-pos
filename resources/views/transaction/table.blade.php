<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>

                <th scope="col">Title</th>
                <th scope="col">Amount</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($transactions as $key=> $item)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->amount }}</td>
                    <td>
                        <div class="dropdown d-inline">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-start">
                                <a class="dropdown-item has-icon"
                                   href="{{ route('transactions.edit',$item->id) }}"><i
                                        class="fas fa-pencil-alt"></i> Edit</a>

                                <a class="dropdown-item has-icon trash_btn" href="#"><i
                                        class="fas fa-trash"></i> Delete</a>
                            </div>
                        </div>
                        <form class="trash_form" action="{{ route('transactions.destroy',$item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td>Total</td>
                <td></td>
                <td>{{ $transactions->sum('amount') }}</td>
            </tr>
            </tfoot>
        </table>

    </div>
    <div class="card-footer text-right">
        {{ $transactions->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>

