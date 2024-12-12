<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="modal fade" id="ticketModal{{$ticket->id}}" tabindex="-1" aria-labelledby="ticketModalLabel{{$ticket->id}}" aria-hidden="true">
    <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title" id="ticketModalLabel{{$ticket->id}}">Ticket Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>ID:</strong> {{$ticket->id}}</p>
                            <p><strong>ITST No:</strong> {{$ticket->ITST_no}}</p>
                            <p><strong>Date:</strong> {{$ticket->date}}</p>
                            <p><strong>Time:</strong> {{$ticket->time}}</p>
                            <p><strong>Client Name:</strong> {{$ticket->client_name}}</p>
                            <p><strong>Office:</strong> {{$ticket->office}}</p>
                            <p><strong>Equipment Type:</strong> {{$ticket->equipment_type}}</p>
                            <p><strong>Serial No</strong> {{$ticket->serial_no}}</p>
                            <p><strong>Problem</strong> {{$ticket->problem}}</p>
                            <p><strong>Validated Problem</strong> {{$ticket->validated_problem}}</p>
                            
                            
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-secondary">
    <a href="{{ route('export.ticket', $ticket->id) }}" class="text-white text-decoration-none">Download</a>
</button>

                        </div>
            </div>
    </div>
</div>

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
    
</body>
</html>