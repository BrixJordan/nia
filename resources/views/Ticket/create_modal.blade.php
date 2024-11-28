<div class="modal fade" id="createTicketModal" tabindex="-1" aria-labelledby="createTicketModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTicketModalLabel">Create Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('ticket.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                        <label for="">ITST NO</label>
                        <!-- ITST No -->
                        <x-forms.input 
                        type="text" 
                        name="ITST_no" 
                        label="ITST No" 
                        placeholder="Enter ITST Number" 
                        required />
                        </div>

                        <div class="col-md-6">
                            <!-- Date -->
                    <label for="">DATE</label>
                    <x-forms.input 
                        type="date" 
                        name="date" 
                        label="Date" 
                        required />

                        </div>

                        <div class="col-md-6">
                            <!-- Time -->
                            <label for="">TIME</label>
                            <x-forms.input 
                            type="time" 
                            name="time" 
                            label="Time" 
                            required />
                        </div>

                        <div class="col-md-6">
                            <!-- Client Name -->
                            <label for="">Client Name</label>
                            <x-forms.input 
                            type="text" 
                            name="client_name" 
                            label="Client Name" 
                            placeholder="Enter Client Name" 
                            required />

                        </div>

                        <div class="col-md-6">
                            <!-- Office -->
                            <label for="">OFFICE</label>
                            <x-forms.input 
                            type="text" 
                            name="office" 
                            label="Office"
                            placeholder="Enter Office" 
                            required />

                        </div>

                        <div class="col-md-6">
                            <!-- Equipment Type -->
                            <label for="">EQUIPMENT TYPE</label>
                            <x-forms.input 
                            type="text" 
                            name="equipment_type" 
                            label="Equipment Type" 
                            placeholder="Enter Equipment Type" 
                            required />

                        </div>

                        <div class="col-md-6">
                            <!-- Serial No -->
                            <label for="">SERIAL NO</label>
                            <x-forms.input 
                            type="text" 
                            name="serial_no" 
                            label="Serial No" 
                            placeholder="Enter Serial No" 
                            required />

                        </div>

                        <div class="col-md-6">
                            <!-- Problem -->
                            <label for="">PROBLEM</label>
                            <x-forms.input 
                            type="text" 
                            name="problem" 
                            label="Problem" 
                            placeholder="Describe the Problem" 
                            required />

                        </div>

                        <div class="col-md-6">
                            <!-- Validated Problem -->
                            <label for="">VALIDATED PROBLEM</label>
                            <x-forms.input 
                            type="text" 
                            name="validated_problem" 
                            label="Validated Problem" 
                            placeholder="Describe the Validated Problem" 
                            required />

                        </div>

                        
                        
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Ticket</button>
                </div>
            </form>
        </div>
    </div>
</div>