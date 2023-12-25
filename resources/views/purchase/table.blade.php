<div class="card">
    <div class="card-header">
        <h4>Purchase</h4>
        <div class="card-header-form">
            <a href="{{ route('purchase.create') }}" class="btn btn-primary float-right"><i
                    class="fa fa-plus"></i> Add Purchase </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Purchase No.</th>
                    <th scope="col">Total Quantity</th>
                    <th scope="col">Total Amount</th>
                    <th scope="col">Paid Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($purchases as $key=> $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ @$item->contact->name }}</td>
                        <td>PO - {{ @$item->purchase_no }}</td>
                        <td>{{ @$item->total_quantity }}</td>
                        <td>{{ @$item->total_amount }}</td>
                        <td>{{ @$item->payment->amount }}</td>
                        <td>
                            @if ($item->status == 1)
                                <span class="badge badge-success">Approved</span>
                            @else
                                <span class="badge badge-danger">Pending</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown d-inline">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-start">
                                    <a class="dropdown-item has-icon"
                                       href="{{ route('purchase.show',$item->id) }}"><i class="far fa-eye"></i> View</a>
                                    @if ($item->status == 0)
                                        <a class="dropdown-item has-icon"
                                           href="{{ route('purchase.approve',$item->id) }}"><i
                                                class="far fa-check-circle"></i> Approve</a>
                                        <a class="dropdown-item has-icon"
                                           href="{{ route('purchase.edit',$item->id) }}"><i
                                                class="fas fa-pencil-alt"></i> Edit</a>

                                        <a class="dropdown-item has-icon trash_btn" href="#"><i
                                                class="fas fa-trash"></i> Delete</a>
                                    @endif
                                </div>
                            </div>
                            <form class="trash_form" action="{{ route('purchase.destroy',$item->id) }}"
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
        {{ $purchases->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>

