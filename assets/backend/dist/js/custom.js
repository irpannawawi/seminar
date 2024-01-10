/* Bootstrap 5 JS included */

console.clear();
('use strict');

function readURL(input) {
if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
    $('.image-upload-wrap').hide();

    $('.file-upload-image').attr('src', e.target.result);
    $('.file-upload-content').show();

    $('.image-title').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

} 
}

// tny mce
tinymce.init({
    selector: 'textarea#description,textarea#snk,textarea#meta_google,textarea#description_web',
    // width: 1000,
    height: 400,
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    content_style: 'body{font-family:Helvetica,Arial, sans-serif; font-seize:16px}'
});

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

// badge status event
$(document).ready(function() {
    $('.status').each(function() {
        var status = $(this).data('status');
        var badgeClass = (status == 'draft') ? 'badge-info' : 'badge-success';
        $(this).addClass(badgeClass);
    });
});

// sweet alert delete
document.addEventListener('DOMContentLoaded', () => {
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', event => {
            event.preventDefault();

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Anda tidak akan dapat mengembalikan ini!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, yakin!'
            }).then(result => {
                if (result.isConfirmed) {
                    // Redirect to delete route if user confirms
                    window.location.href = button.getAttribute('href');
                }
            });
        });
    });
});
