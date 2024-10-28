<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <title>Document</title>
</head>
<style>
    body {
        background-color: #186112;
        color: white;
    }

    .sticker {
        border: 2px solid white;
        background-color: #186112;
        max-width: 800px;
        margin: 20px auto;
        padding: 15px;
    }

    .header,
    .footer {
        text-align: center;
        padding: 10px 0;
        font-weight: bold;
    }

    .title {
        text-align: center;
        font-weight: bold;
        padding: 10px 0;
        font-size: 18px;
        border-top: 2px solid white;
        border-bottom: 2px solid white;

    }

    .field-label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .field-value {
        background-color: white;
        height: 30px;
        border: 1px solid #fff;
        margin-bottom: 10px;
    }

    .qrcode {
    
    
 /* Maintain the height */
    display: flex;
    align-items: center;
    justify-content: center;
    
}

.qrcode img {
/* Ensure the image fits within the height */
    object-fit: contain; /* Maintain aspect ratio */
}


    .coa-section {
        text-align: center;
        margin-bottom: 10px;
    }

    .coa-table {
        width: 100%;
        border: 1px solid white;
    }

    .coa-table th,
    .coa-table td {
        border: 1px solid white;
        padding: 5px;
        text-align: center;
        color: #000;
        background-color: #d3d3d3;
    }

    .signature-box {
        background-color: white     ;
        height: 30px;
        border: 1px solid white;
        margin-top: 5px;

        
    }
    .field-value{
        font-weight: bold;
            
        }
</style>
<body>

<!-- show_sticker_modal.blade.php -->
<div class="modal fade" id="showModal{{ $sticker->id }}" tabindex="-1" aria-labelledby="showModalLabel{{ $sticker->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="showModalLabel{{ $sticker->id }}">Sticker Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
            <div class="sticker">
        <div class="header">
            <img src="{{ asset('images/headerr.jpg') }}
            " alt="Header Image" class="img-fluid" style="max-height: 100px;">
        </div>




        <div class="title text-light">PROPERTY INVENTORY STICKER</div>

        <div class="row">
            <div class="col-md-8">
                <div class="field-label text-light">Property No.:</div>
                <div class="field-value text-danger">{{ $sticker->property_no }}</div>

                <div class="field-label text-light">Serial No.:</div>
                <div class="field-value text-danger">{{ $sticker->serial_no }}</div>

                <div class="field-label text-light">Model No.:</div>
                <div class="field-value text-danger">{{$sticker->model_no}}</div>

                <div class="field-label text-light">Property Description:</div>
                <div class="field-value text-danger">{{ $sticker->description }}</div>

                <div class="row">
                    <div class="col-6">
                        <div class="field-label text-light">Acquisition Date:</div>
                        <div class="field-value text-danger">{{ $sticker->acquisition_date }}</div>
                    </div>
                    <div class="col-6">
                        <div class="field-label text-light">Acquisition Cost:</div>
                        <div class="field-value text-danger">{{$sticker->acquisition_cost}}</div>
                    </div>
                </div>

                <div class="field-label text-light">Accountable Person:</div>
                <div class="field-value text-danger">{{ $sticker->accountable }}</div>

                <div class="field-label text-light">Inventory Committee: Signature</div>
                <div class="signature-box"></div>
            </div>

            <div class="col-md-4">
                <div class="coa-section text-light">
                    <strong>COA Witness & Inventory Comm. Members:</strong>
                </div>

                <div>

                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="field-value"></div>
                            <div class="field-label text-light">2023</div>
                        </div>

                        <div class="col-md-4">
                            <div class="field-value"></div>
                            <div class="field-label text-light">2024</div>
                        </div>

                        <div class="col-md-4">
                            <div class="field-value"></div>
                            <div class="field-label text-light">2025</div>
                        </div>
                    </div>

                </div>

                <div>

                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="field-value"></div>
                            <div class="field-label text-light">2026</div>
                        </div>

                        <div class="col-md-4">
                            <div class="field-value"></div>
                            <div class="field-label text-light">2027</div>
                        </div>

                        <div class="col-md-4">
                            <div class="field-value"></div>
                            <div class="field-label text-light">2028</div>
                        </div>
                    </div>

                </div>

                <div>

                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="field-value"></div>
                            <div class="field-label text-light">2029</div>
                        </div>

                        <div class="col-md-4">
                            <div class="field-value"></div>
                            <div class="field-label text-light">2030</div>
                        </div>

                        <div class="col-md-4">
                            <div class="field-value"></div>
                            <div class="field-label text-light">2031</div>
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

        <div class="footer text-light">DO NOT TEAR/REMOVE</div>
    </div>
            </div>
            <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" id="downloadImage">Download as Image</button>
</div>

        </div>
    </div>
</div>
<script>
    document.getElementById('downloadImage').addEventListener('click', function () {
        const stickerElement = document.querySelector('.sticker');
        
        html2canvas(stickerElement).then(canvas => {
            const link = document.createElement('a');
            link.href = canvas.toDataURL('image/png');
            link.download = 'sticker.png';
            link.click();
        });
    });
</script>

    
</body>
</html>



