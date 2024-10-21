<!-- yellow_sticker_modal.blade.php -->
<div class="modal fade" id="yellowModal{{ $sticker->id }}" tabindex="-1" aria-labelledby="yellowModalLabel{{ $sticker->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" >
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="yellowModalLabel{{ $sticker->id }}">Sticker Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="sticker" style="background-color: #FEEF20;">
                    <div class="header">
                        <img src="{{ asset('images/header2.jpg') }}" alt="Header Image" class="img-fluid" style="max-height: 100px;">
                    </div>

                    <div class="title text-dark">PROPERTY INVENTORY STICKER</div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="field-label text-dark">Property No.:</div>
                            <div class="field-value text-danger">{{ $sticker->property_no }}</div>

                            <div class="field-label text-dark">Serial No.:</div>
                            <div class="field-value text-danger">{{ $sticker->serial_no }}</div>

                            <div class="field-label text-dark">Model No.:</div>
                            <div class="field-value text-danger">{{ $sticker->model_no }}</div>

                            <div class="field-label text-dark">Property Description:</div>
                            <div class="field-value text-danger">{{ $sticker->description }}</div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="field-label text-dark">Acquisition Date:</div>
                                    <div class="field-value text-danger">{{ $sticker->acquisition_date }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="field-label text-dark">Acquisition Cost:</div>
                                    <div class="field-value text-danger">{{ $sticker->acquisition_cost }}</div>
                                </div>
                            </div>

                            <div class="field-label text-dark">Accountable Person:</div>
                            <div class="field-value text-danger">{{ $sticker->accountable }}</div>

                            <div class="field-label text-dark">Inventory Committee: Signature</div>
                            <div class="signature-box"></div>
                        </div>

                        <div class="col-md-4">
                            <div class="coa-section text-dark">
                                <strong>COA Witness & Inventory Comm. Members:</strong>
                            </div>

                            <div>
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <div class="field-value"></div>
                                        <div class="field-label text-dark">2023</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="field-value"></div>
                                        <div class="field-label text-dark">2024</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="field-value"></div>
                                        <div class="field-label text-dark">2025</div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <div class="field-value"></div>
                                        <div class="field-label text-dark">2026</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="field-value"></div>
                                        <div class="field-label text-dark">2027</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="field-value"></div>
                                        <div class="field-label text-dark">2028</div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <div class="field-value"></div>
                                        <div class="field-label text-dark">2029</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="field-value"></div>
                                        <div class="field-label text-dark">2030</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="field-value"></div>
                                        <div class="field-label text-dark">2031</div>
                                    </div>
                                </div>
                            </div>

                            <div class="qrcode">
                                @if($sticker->qr_code_path)
                                    <img src="{{ asset('images/qrcodes/' . basename($sticker->qr_code_path)) }}" alt="QR Code">
                                @else
                                    <p>No QR Code Available</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="footer text-dark">DO NOT TEAR/REMOVE</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="downloadYellowImage{{ $sticker->id }}">Download as Image</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('downloadYellowImage{{ $sticker->id }}').addEventListener('click', function () {
        const stickerElement = document.querySelector('#yellowModal{{ $sticker->id }} .sticker');
        
        html2canvas(stickerElement).then(canvas => {
            const link = document.createElement('a');
            link.href = canvas.toDataURL('image/png');
            link.download = 'yellow_sticker_{{ $sticker->id }}.png'; // Dynamic name for yellow sticker
            link.click();
        });
    });
</script>

