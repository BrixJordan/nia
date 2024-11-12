<x-app-layout>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Create Sticker
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Property Inventory Sticker</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Display Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="row g-3" method="POST" action="{{ route('stickers.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <label for="property_no" class="form-label">Property No.: </label>
                            <input type="text" name="property_no" class="form-control" id="property_no" required>
                        </div>

                        <div class="col-md-6">
                            <label for="serial_no" class="form-label">Serial No.:</label>
                            <input type="text" name="serial_no" class="form-control" id="serial_no" required>
                        </div>

                        <div class="col-md-6">
                            <label for="model_no" class="form-label">Model No.:</label>
                            <input type="text" name="model_no" class="form-control" id="model_no" required>
                        </div>

                        <div class="col-md-6">
                            <label for="description" class="form-label">Property Description:</label>
                            <input type="text" name="description" class="form-control" id="description" required>
                        </div>

                        <div class="col-md-6">
                            <label for="acquisition_date" class="form-label">Acquisition Date:</label>
                            <input type="date" name="acquisition_date" class="form-control" id="acquisition_date" required>
                        </div>

                        <div class="col-md-6">
                            <label for="acquisition_cost" class="form-label">Acquisition Cost:</label>
                            <input type="number" name="acquisition_cost" class="form-control" id="acquisition_cost" required>
                        </div>

                        <div class="col-md-6">
                            <label for="accountable" class="form-label">Accountable Person:</label>
                            <input type="text" name="accountable" class="form-control" id="accountable" required>
                        </div>

                        <div class="col-md-6">
                            <label for="image" class="form-label">Upload Image:</label>
                            <input type="file" name="image" class="form-control" id="image" accept="image/*" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>




<section>
<div class="container">
    

    <!-- Search Form -->
    <form method="GET" action="{{ route('stickers.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by Property No, Serial No, or Accountable" value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead class="text-center">
            <tr>
                <th>ID</th>
                <th>Property No</th>
                <th>Serial No</th>
                <th>Model No</th>
                <th>Description</th>
                <th>Acquisition Date</th>
                <th>Acquisition Cost</th>
                <th>Accountable</th>
                
                <th>QR Code</th>
                <th>201</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stickers as $sticker)
            <tr>
                <td>{{ $sticker->id }}</td>
                <td>{{ $sticker->property_no }}</td>
                <td>{{ $sticker->serial_no }}</td>
                <td>{{ $sticker->model_no }}</td>
                <td>{{ $sticker->description }}</td>
                <td>{{ $sticker->acquisition_date }}</td>
                <td>{{ $sticker->acquisition_cost }}</td>
                <td>{{ $sticker->accountable }}</td>
                
                <td>
                    @if($sticker->qr_code_path)
                        <img src="{{ asset('images/qrcodes/' . basename($sticker->qr_code_path)) }}" alt="QR Code" style="width: 100px;">
                    @else
                        No QR Code
                    @endif
                </td>
                <td>
                    @if($sticker->image_path)
                        <img src="{{ asset('storage/' . $sticker->image_path) }}" alt="Sticker Image" style="width: 100px;">
                    @else
                        No Image
                    @endif
                </td>
                <td>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $sticker->id }}">Edit</button>

                    <!-- Modal for Editing -->
                    <div class="modal fade" id="editModal{{ $sticker->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Sticker</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Display Validation Errors -->
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form class="row g-3" method="POST" action="{{ route('stickers.update', $sticker->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-md-6">
                                            <label for="property_no" class="form-label">Property No.: </label>
                                            <input type="text" name="property_no" class="form-control" id="property_no" value="{{ $sticker->property_no }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="serial_no" class="form-label">Serial No.:</label>
                                            <input type="text" name="serial_no" class="form-control" id="serial_no" value="{{ $sticker->serial_no }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="model_no" class="form-label">Model No.:</label>
                                            <input type="text" name="model_no" class="form-control" id="model_no" value="{{ $sticker->model_no }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="description" class="form-label">Property Description:</label>
                                            <input type="text" name="description" class="form-control" id="description" value="{{ $sticker->description }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="acquisition_date" class="form-label">Acquisition Date:</label>
                                            <input type="date" name="acquisition_date" class="form-control" id="acquisition_date" value="{{ $sticker->acquisition_date }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="acquisition_cost" class="form-label">Acquisition Cost:</label>
                                            <input type="number" name="acquisition_cost" class="form-control" id="acquisition_cost" value="{{ $sticker->acquisition_cost }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="accountable" class="form-label">Accountable Person:</label>
                                            <input type="text" name="accountable" class="form-control" id="accountable" value="{{ $sticker->accountable }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="image" class="form-label">Upload Image:</label>
                                            <input type="file" name="image" class="form-control" id="image" accept="image/*">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('stickers.destroy', $sticker->id) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this sticker?');">Delete</button>
                    </form>
                    <!-- Show Modal Button -->
                @if($sticker->acquisition_cost >= 50000)
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showModal{{ $sticker->id }}">Show</a>
                    @include('stickers.show_sticker_modal', ['sticker' => $sticker])
                @else
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#yellowModal{{ $sticker->id }}">Show</a>
                    @include('stickers.yellow_sticker_modal', ['sticker' => $sticker])
                @endif

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-between">
        <div>
            Showing {{ $stickers->firstItem() }} to {{ $stickers->lastItem() }} of {{ $stickers->total() }} stickers
        </div>
        <div>
            {{ $stickers->links() }}
        </div>
    </div>
</div>

   

</x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Document</title>
</head>
<body>
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif

    
</body>
</html>