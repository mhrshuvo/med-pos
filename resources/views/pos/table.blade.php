<div class="card">
    <div class="card-header">
        <h4>POS</h4>
        <div class="card-header-form">
            <a href="{{ route('pos.draft') }}" class="btn btn-primary float-right"><i
                    class="fa fa-list"></i> Draft list </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Invoice No.</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Total Quantity</th>
                    <th scope="col">Total Amount</th>
                    <th scope="col">Paid Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($pos_list as $key=> $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ @$item->invoice_no }}</td>
                        <td>{{ @$item->contact->name }}</td>
                        <td>{{ @$item->total_quantity }}</td>
                        <td>{{ @$item->total_amount }}</td>
                        <td>{{ @$item->payment->amount }}</td>
                        <td>
                            @if ($item->status == 0)
                                <span class="badge badge-danger">Pending</span>
                            @else
                                <span class="badge badge-success">Approve</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown d-inline">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-start">
                                    <a class="dropdown-item has-icon" href="{{ route('pos.show',$item->id) }}"><i
                                            class="far fa-eye"></i> View</a>
                                    @if ($item->status == 0)
                                        <a class="dropdown-item has-icon"
                                           href="{{ route('pos.edit',$item->id) }}"><i
                                                class="fas fa-pencil-alt"></i> Edit</a>
                                        <a class="dropdown-item has-icon"
                                           href="{{ route('pos.approve',$item->id) }}"><i
                                                class="fas fa-check"></i> Approve</a>
                                        <a class="dropdown-item has-icon trash_btn" href="#"><i
                                                class="fas fa-trash"></i> Delete</a>
                                    @endif
                                </div>
                            </div>
                            <form class="trash_form" action="{{ route('pos.destroy',$item->id) }}"
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
        {{ $pos_list->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>

