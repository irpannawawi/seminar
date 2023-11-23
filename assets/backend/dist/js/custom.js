/* Bootstrap 5 JS included */

console.clear();
('use strict');


// Drag and drop - single or multiple image files
// https://www.smashingmagazine.com/2018/01/drag-drop-file-uploader-vanilla-js/
// https://codepen.io/joezimjs/pen/yPWQbd?editors=1000
(function () {

'use strict';

// Four objects of interest: drop zones, input elements, gallery elements, and the files.
// dataRefs = {files: [image files], input: element ref, gallery: element ref}

const preventDefaults = event => {
event.preventDefault();
event.stopPropagation();
};

const highlight = event =>
event.target.classList.add('highlight');

const unhighlight = event =>
event.target.classList.remove('highlight');

const getInputAndGalleryRefs = element => {
const zone = element.closest('.upload_dropZone') || false;
const gallery = zone.querySelector('.upload_gallery') || false;
const input = zone.querySelector('input[type="file"]') || false;
return {input: input, gallery: gallery};
}

const handleDrop = event => {
const dataRefs = getInputAndGalleryRefs(event.target);
dataRefs.files = event.dataTransfer.files;
handleFiles(dataRefs);
}


const eventHandlers = zone => {

const dataRefs = getInputAndGalleryRefs(zone);
if (!dataRefs.input) return;

// Prevent default drag behaviors
;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(event => {
    zone.addEventListener(event, preventDefaults, false);
    document.body.addEventListener(event, preventDefaults, false);
});

// Highlighting drop area when item is dragged over it
;['dragenter', 'dragover'].forEach(event => {
    zone.addEventListener(event, highlight, false);
});
;['dragleave', 'drop'].forEach(event => {
    zone.addEventListener(event, unhighlight, false);
});

// Handle dropped files
zone.addEventListener('drop', handleDrop, false);

// Handle browse selected files
dataRefs.input.addEventListener('change', event => {
    dataRefs.files = event.target.files;
    handleFiles(dataRefs);
}, false);

}


// Initialise ALL dropzones
const dropZones = document.querySelectorAll('.upload_dropZone');
for (const zone of dropZones) {
eventHandlers(zone);
}


// No 'image/gif' or PDF or webp allowed here, but it's up to your use case.
// Double checks the input "accept" attribute
const isImageFile = file => 
['image/jpeg', 'image/png', 'image/svg+xml'].includes(file.type);


function previewFiles(dataRefs) {
if (!dataRefs.gallery) return;
for (const file of dataRefs.files) {
    let reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onloadend = function() {
    let img = document.createElement('img');
    img.className = 'upload_img mt-2';
    img.setAttribute('alt', file.name);
    img.src = reader.result;
    dataRefs.gallery.appendChild(img);
    }
}
}

// Based on: https://flaviocopes.com/how-to-upload-files-fetch/
const imageUpload = dataRefs => {

// Multiple source routes, so double check validity
if (!dataRefs.files || !dataRefs.input) return;

const url = dataRefs.input.getAttribute('data-post-url');
if (!url) return;

const name = dataRefs.input.getAttribute('data-post-name');
if (!name) return;

const formData = new FormData();
formData.append(name, dataRefs.files);

fetch(url, {
    method: 'POST',
    body: formData
})
.then(response => response.json())
.then(data => {
    console.log('posted: ', data);
    if (data.success === true) {
    previewFiles(dataRefs);
    } else {
    console.log('URL: ', url, '  name: ', name)
    }
})
.catch(error => {
    console.error('errored: ', error);
});
}


// Handle both selected and dropped files
const handleFiles = dataRefs => {

let files = [...dataRefs.files];

// Remove unaccepted file types
files = files.filter(item => {
    if (!isImageFile(item)) {
    console.log('Not an image, ', item.type);
    }
    return isImageFile(item) ? item : null;
});

if (!files.length) return;
dataRefs.files = files;

previewFiles(dataRefs);
imageUpload(dataRefs);
}

})();


// script.js
$(document).ready(function () {
    $('#to-regis').on("click", function() {
        $("#loginform").slideUp();
        $("#regisform").slideDown();
    });
    
    $('#to-login').on("click", function() {
        $("#regisform").slideUp();
        $("#loginform").slideDown();
    });
    
    // tny mce
    tinymce.init({
        selector: 'textarea#example',
        // width: 1000,
        height: 400,
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        content_style: 'body{font-family:Helvetica,Arial, sans-serif; font-seize:16px}'
    });
    
    /* Rupiah */
    var priceInput = document.getElementById('price');
    priceInput.addEventListener('input', function (e) {
        this.value = formatRupiah(this.value, 'Rp. ');
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
    // Date picker
    $('#date1, #date2').datetimepicker({
        format: 'L'
    });

    // Timepicker
    $('#timeevent1, #timeevent2').datetimepicker({
        format: 'LT'
    });

    // Initialize Select2 Elements
    $('.select2').select2();

    
    
});
