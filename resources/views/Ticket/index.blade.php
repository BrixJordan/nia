<x-app-layout>
    <h1>This is Ticket Dashboard</h1>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createTicketModal">
        Create Sticker
    </button>
    @include('Ticket.create_modal')
    <div class="container">
        <table class="table table-bordered">
            <thead class="text-center">
                <tr>
                <th>ID</th>
                <th>ITST No</th>
                <th>Date</th>
                <th>Time</th>
                <th>Client Name</th>
                <th>Office</th>
                <th>Equipment Type</th>
                <th>Action</th>
                </tr>
            </thead>
        
        <tbody>
            @foreach($tickets as $ticket)
            <tr>
                <td>{{$ticket->id}}</td>
                <td>{{$ticket->ITST_no}}</td>
                <td>{{$ticket->date}}</td>
                <td>{{$ticket->time}}</td>
                <td>{{$ticket->client_name}}</td>
                <td>{{$ticket->office}}</td>
                <td>{{$ticket->equipment_type}}</td>
                <td>
                    <button>edit</button>
                    <button>delete</button>
                    done
                </td>
            </tr>
            @endforeach

        </tbody>
        </table>
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