function toggleInput(showId) {
    var showElement = document.getElementById(showId);

    // Hide all elements with class 'hidden'
    var hiddenElements = document.querySelectorAll('.hidden');
    hiddenElements.forEach(function (element) {
        element.style.maxHeight = '0';
    });

    showElement.style.maxHeight = showElement.scrollHeight + 'px';
}

/* Rupiah */
document.addEventListener('DOMContentLoaded', function() {
    var priceInput = document.getElementById('price');
    if (priceInput) {
        priceInput.addEventListener('input', function(e) {
            this.value = formatRupiah(this.value, 'Rp. ');
        });
    }
});

/* Fungsi */
function formatRupiah(angka, prefix) {
    var numberString = angka.replace(/[^,\d]/g, '').toString(),
        split = numberString.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/g);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix === undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}