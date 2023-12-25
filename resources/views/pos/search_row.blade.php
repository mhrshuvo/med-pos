@if (count($medicines) > 0)
    @foreach ($medicines as $item)
        <div class="col-lg-2 pos_area">
            <a href="javascript:void(0)" data-id="{{ $item->id }}">
                <div class="card pos_medicine">
                    <img class="card-img-top" src="{{ asset($item->image) }}" width="200px"
                         alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text text-center">{{ $item->name }}</p>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
@else
    <h4>No Medicine Found...Try Something Else</h4>
@endif
