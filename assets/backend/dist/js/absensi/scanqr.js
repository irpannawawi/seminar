$(document).ready(function() {
    const audio = new Audio();
    audio.src = navigator.userAgent.match(/Firefox/) ? 'assets/backend/dist/sound/shutter.ogg' : 'assets/backend/dist/sound/shutter.mp3';

    let scanner = new Instascan.Scanner({ 
        video: document.getElementById('reader'),
        backgroundScan: false,
        mirror: false
    });

    scanner.addListener('scan', function (content) {
        // Handle the scanned content (id_order or barcode)
        displayInfo(content);
    });

    function displayInfo(content) {
        $.ajax({
            url: baseurl + 'absensi/checkPesertaAbsensi',
            method: 'GET',
            data: { id_order: content },
            success: function (response) {
                if (response.success) {
                    toastr.success('Scan successful!');
                    console.log(response.data);
                    // updateUI(response.data);
                } else {
                    toastr.error('Failed to fetch data.');
                }
            },
            error: function (error) {
                toastr.error('Error fetching data.');
            }
        });
    }

    function updateUI(data) {
        $('#orderInfoForm').html(`
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="${data.name || ''}" readonly>
            </div>
            <div class="form-group">
                <label for="nowa">No. WhatsApp:</label>
                <input type="text" id="nowa" name="nowa" value="${data.nowa || ''}" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="${data.email || ''}" readonly>
            </div>
            <div class="form-group">
                <label for="domisili">Domisili:</label>
                <input type="text" id="domisili" name="domisili" value="${data.domisili || ''}" readonly>
            </div>
        `);
    }

    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            let selectedCameraIndex = cameras.findIndex(camera => camera && camera.name.toLowerCase().includes('back'));
    
            if (selectedCameraIndex === -1) {
                // If the back camera is not found, use the first available camera
                selectedCameraIndex = 0;
            }
    
            scanner.start(cameras[selectedCameraIndex]);
    
            // Check if there are radio buttons for camera selection
            let radioButtons = document.querySelectorAll('input[name="options"]');
            if (radioButtons.length > 0) {
                radioButtons.forEach((element) => {
                    element.addEventListener("change", function (event) {
                        const item = event.target.value;
                        if (item == 1 || item == 2) {
                            if (cameras[item - 1]) {
                                scanner.start(cameras[item - 1]);
                            } else {
                                toastr.error('Selected camera not available!');
                            }
                        } else {
                            toastr.error('Invalid camera selection!');
                        }
                    });
                });
            }
        } else {
            toastr.error('No cameras found.');
        }
        }).catch(function(e) {
            toastr.error(`${e}`);
        });
});
