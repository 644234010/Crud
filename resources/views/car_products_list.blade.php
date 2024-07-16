<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Detail</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($car_products as $item)
            <tr>
                <td>
                    @if($item->car_image)
                        <img src="{{ asset('storage/' . $item->car_image) }}" alt="{{ $item->car_name }}" class="img-fluid" width="200" height="auto">
                    @endif
                </td>
                <td>{{ $item->car_name }}</td>
                <td>{{ Str::limit($item->car_detail, 50) }}</td>
                <td>{{ number_format($item->car_price) }}</td>
                <td>
                    <a href="{{ route('show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                </td>
                <td>
                    <a href="{{ route('edit', $item->id) }}" class="btn btn-warning btn-sm" onclick="confirmEdit(event, '{{ route('edit', $item->id) }}')">Edit</a>
                </td>
                <td>
                    <form action="{{ route('delete', $item->id) }}" method="POST" class="delete-form">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="confirmDelete(event, '{{ $item->car_name }}')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        @if ($car_products->lastPage() > 1)
            <ul class="pagination">
                @if ($car_products->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">Previous</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $car_products->previousPageUrl() }}">Previous</a></li>
                @endif

                @for ($i = 1; $i <= $car_products->lastPage(); $i++)
                    @if ($i == 1 || $i == $car_products->lastPage() || ($i >= $car_products->currentPage() - 1 && $i <= $car_products->currentPage() + 1))
                        @if ($i == $car_products->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $car_products->url($i) }}">{{ $i }}</a></li>
                        @endif
                    @elseif ($i == $car_products->currentPage() - 2 || $i == $car_products->currentPage() + 2)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
                @endfor

                @if ($car_products->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $car_products->nextPageUrl() }}">Next</a></li>
                @else
                    <li class="page-item disabled"><span class="page-link">Next</span></li>
                @endif
            </ul>
        @endif
    </div>
</div>

<script>
    function confirmDelete(event, name) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: `You won't be able to revert this!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Deleted!',
                    text: 'Your file has been deleted.',
                    icon: 'success'
                }).then(() => {
                    event.target.closest('form').submit();
                });
            }
        });
    }

    function confirmEdit(event, url) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to edit this item.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, edit it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>
