

<!-- Edit Modal -->
<div class="modal fade" id="editTicketModal{{ $ticket->id }}" tabindex="-1" aria-labelledby="editTicketModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editTicketModalLabel">Edit Sticker</h1>
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

                <!-- Form -->
                <form class="row g-3" enctype="multipart/form-data" action="{{ route('Ticket.update', $ticket->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="col-md-6">
                        <label for="ITST_no" class="form-label">ITST NO:</label>
                        <input type="text" name="ITST_no" class="form-control" id="ITST_no" value="{{ $ticket->ITST_no }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="Date" class="form-label">Date:</label>
                        <input type="date" name="date" class="form-control" id="date" value="{{ $ticket->date }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="Time" class="form-label">Time:</label>
                        <input type="time" name="time" class="form-control" id="time" value="{{ $ticket->time }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="Client Name" class="form-label">Client Name:</label>
                        <input type="text" name="client_name" class="form-control" id="client_name" value="{{ $ticket->client_name }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="Office" class="form-label">Office:</label>
                        <input type="text" name="office" class="form-control" id="office" value="{{ $ticket->office }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="Equipment Tyoe" class="form-label">Equipment Type:</label>
                        <input type="text" name="equipment_type" class="form-control" id="equipment_type" value="{{ $ticket->equipment_type }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="serial_no" class="form-label">Serial No:</label>
                        <input type="text" name="serial_no" class="form-control" id="serial_no" value="{{ $ticket->serial_no }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="problem" class="form-label">Problem:</label>
                        <input type="text" name="problem" class="form-control" id="problem" value="{{ $ticket->problem }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="validated_problem" class="form-label">Validated Problem:</label>
                        <input type="text" name="validated_problem" class="form-control" id="validated_problem" value="{{ $ticket->validated_problem }}" required>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
