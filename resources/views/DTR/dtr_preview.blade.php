<!-- DTR/dtr_preview.blade.php -->
<x-app-layout>
    <div class="container">
        <h2>DTR Records for {{ $employee->full_name }}</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Morning In</th>
                    <th>Morning Out</th>
                    <th>Afternoon In</th>
                    <th>Afternoon Out</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dtrRecords as $date => $times)
                <tr>
                    <td>{{ $date }}</td>
                    <td>{{ $times['morning_in'] ?? '-' }}</td>
                    <td>{{ $times['morning_out'] ?? '-' }}</td>
                    <td>{{ $times['afternoon_in'] ?? '-' }}</td>
                    <td>{{ $times['afternoon_out'] ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('dtr.download') }}" method="POST">
            @csrf
            <input type="hidden" name="employee" value="{{ $employee->id }}">
            <input type="hidden" name="from_date" value="{{ request('from_date') }}">
            <input type="hidden" name="to_date" value="{{ request('to_date') }}">
            <button type="submit" class="btn btn-primary">Download as Excel</button>
        </form>

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