<!-- export_modal Modal -->

<div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exportModalLabel">Export DTR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dtr.export') }}" method="GET">
                    @csrf
                    <!-- Select Employee -->
                    <div class="mb-3">
                        <label for="employee" class="form-label">Select Employee</label>
                        <select class="form-select" name="acc_no" id="employee" required>
                            <option value="">Choose an Employee</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->acc_no }}">
                                    {{ $employee->full_name }} -- {{ $employee->department }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Start Date -->
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" name="start_date" id="start_date" required>
                    </div>

                    <!-- End Date -->
                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" name="end_date" id="end_date" required>
                    </div>

                    <!-- Export Button -->
                    <button type="submit" class="btn btn-success">Export</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
