

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
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
