document.addEventListener('DOMContentLoaded', function() {
    let subTotal = parseFloat(document.getElementById('subtotal').innerText.replace('IDR ', '').replace(/\./g, ''));
    let kodeunik = parseInt(document.getElementById('kodeunik').innerText);
    const total = document.getElementById('total');
    const nominal = document.getElementById('nominal');

    const hitung = subTotal + kodeunik;
    total.innerHTML = `Rp. ${hitung.toLocaleString(undefined, { minimumFractionDigits: 0, maximumFractionDigits: 0 })}`;
    nominal.value = `${hitung.toLocaleString(undefined, { minimumFractionDigits: 0, maximumFractionDigits: 0, useGrouping: false })}`;
});

document.addEventListener('DOMContentLoaded', function() {
    // Wait for the input element with ID 'email' to be available
    const emailInput = document.getElementById('email');

    if (emailInput) {
        // Now get the value
        const email = emailInput.value;

        const emailverif = document.getElementById('emailverif');
        if (emailverif) {
            emailverif.innerText = email;
        }
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const loadingOverlay = document.getElementById('loading-overlay');

    form.addEventListener('submit', function () {
        // Tampilkan loading overlay
        loadingOverlay.style.display = 'flex';

        // Simulasi loading selama 2 detik (gantilah dengan logika sebenarnya)
        setTimeout(function () {
            // Sembunyikan loading overlay setelah selesai loading
            loadingOverlay.style.display = 'none';
        }, 2000);
    });
});

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('btn_bayar').addEventListener('click', function() {
        // Dapatkan semua data form
        var formData = new FormData(document.getElementById('form_checkout'));

        // Kirim data menggunakan AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', baseurl + 'event/checkout', true);
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 400) {
                // Berhasil, lakukan sesuatu setelah pengiriman data
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Redirect ke halaman sukses jika diperlukan
                    window.location.href = baseurl + 'home';
                } else {
                    // Tampilkan pesan kesalahan jika diperlukan
                    alert('Terjadi kesalahan: ' + response.message);
                }
            } else {
                // Gagal, tampilkan pesan kesalahan jika diperlukan
                alert('Terjadi kesalahan saat mengirim data.');
            }
        };
        xhr.onerror = function() {
            // Gagal, tampilkan pesan kesalahan jika diperlukan
            alert('Terjadi kesalahan saat mengirim data.');
        };
        xhr.send(formData);
    });
});