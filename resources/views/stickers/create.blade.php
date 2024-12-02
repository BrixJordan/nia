<div class="modal fade" id="exampleModal" tabindex="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Sticker</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('stickers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                        <label for="">PROPERTY NO</label>
                        
                        <x-forms.input 
                        type="text" 
                        name="property_no" 
                        label="Property No" 
                        placeholder="Enter Property No" 
                        required />
                        </div>

                        <div class="col-md-6">
                            
                    <label for="">SERIAL NO</label>
                    <x-forms.input 
                        type="text" 
                        name="serial_no" 
                        label="Date" 
                        placeholder="Enter Serial No"
                        required />

                        </div>

                        <div class="col-md-6">
                            <!-- Time -->
                            <label for="">MODEL NO</label>
                            <x-forms.input 
                            type="text" 
                            name="model_no" 
                            label="Model" 
                            placeholder="Enter Model no"
                            required />
                        </div>

                        <div class="col-md-6">
                            <!-- Client Name -->
                            <label for="">Property Description</label>
                            <x-forms.input 
                            type="text" 
                            name="description"
                            label="description" 
                            placeholder="Enter Description" 
                            required />

                        </div>

                        
                        <div class="col-md-6">
                            <!-- Office -->
                            <label for="">ACCOUNTABLE PERSON</label>
                            <x-forms.input 
                            type="text" 
                            name="accountable" 
                            label="accountable person"
                            placeholder="Enter accountable person" 
                            required />

                        </div>

                        <div class="col-md-6">
                            <!-- Equipment Type -->
                            <label for="">UPLOAD IMAGE</label>
                            <x-forms.input 
                            type="file" 
                            name="image" 
                            label="image" 
                            placeholder="Upload 201 Image" 
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