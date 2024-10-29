<!-- index.blade -->

<x-app-layout>
<div class="container">
        <h3>Employee List</h3>
        <div class="">
            <!-- Import Button -->
            <div class="d-flex justify-content-between my-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal">
                    Import Employee CSV
                </button>
                <!-- Search Form -->
                <form class="d-flex" action="{{ route('employee.index') }}" method="GET">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>

            @include('employee.uploadcsv_modal')
        </div>
        <table class="table table-bordered">
            <thead class="text-center">
                <tr>
                    <th>ID</th>
                    <th>Acc_no</th>
                    <th>Fullname</th>
                    <th>Department</th>
                    <th>Created_at</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->acc_no }}</td>
                    <td>{{ $employee->full_name }}</td>
                    <td>{{ $employee->department }}</td>
                    <td>{{ $employee->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $employees->links() }}
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
