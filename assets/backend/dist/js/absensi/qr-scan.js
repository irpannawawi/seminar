$(document).ready(function() {
    const scanner = new Html5QrcodeScanner("reader", {
        fps: 20,
        qrbox: {
            width: 400,
            height: 400
        }
    }, {
        facingMode: {
            exact: "environment"
        }
    }, {
        rememberLastUsedCamera: true
    }, );

    scanner.render(onScanSuccess, onScanFailure);

    function onScanSuccess(code) {
        // Make an AJAX request to fetch data based on the scanned QR code
        $.ajax({
            url: 'admin/absensi/getdataScan', // Ganti dengan controller dan method sesuai proyek Anda
            type: 'POST',
            data: {
                id_order: code
            },
            success: function(response) {
                if (response.success) {
                    $('#idorder').text(response.data.id_order);
                    $('#name').text(response.data.name);
                    $('#event_title').text(response.data.event_title);
                    $('#email').text(response.data.email);
                    $('#whatsapp').text(response.data.whatsapp);
                    $('#domisili').text(response.data.domisili);
                } else {
                    toast.error('Data ' + code + ' Tidak Ditemukan');
                }

                // Membersihkan hasil scan sebelumnya (opsional)
                scanner.clear();
                document.getElementById('reader').remove();
            },
            error: function(xhr, status, error) {
                toast.error(error);
            }
        });
    }

    function onScanFailure(error) {
        console.warn(`Gagal melakukan scan QR Code. ${error}`);
        toast.error('Gagal melakukan scan QR Code. Coba lagi atau periksa izin kamera.');
    }
});