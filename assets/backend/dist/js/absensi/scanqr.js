$(document).ready(function() {
    let scanner = new Instascan.Scanner({ 
        video: document.getElementById('reader'),
        backgroundScan: false,
        mirror: false
    });

    scanner.addListener('scan', function (content) {
        // Make an AJAX request to fetch data based on the scanned id_order
        $.ajax({
            url: baseurl + '/admin/absensi/getdataScan',
            type: 'POST',
            data: { id_order: content },
            success: function(response) {
                if (response.success) {
                    // Update the view with the fetched data
                    $('#id_order').html(response.id_order);
                    $('#name').html(response.name);
                    $('#event_title').html(response.title);
                    $('#email').html(response.email);
                    $('#whatsapp').html(response.whatsapp);
                    $('#domisili').html(response.domisili);
                } else {
                    toastr.error('Data ' + content + ' Tidak Ditemukan')
                }
            },
            error: function(xhr, status, error) {
                toastr.error(error)
            }
        });
    });

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
