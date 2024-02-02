$(document).ready(function () {
    const eventsId = $('#eventsId');
    const tableData = $('#table-data');
    const loadingOverlay = $('#loading-overlay');

    eventsId.on('change', function () {
        const selectedEventId = $(this).val();

        loadingOverlay.show();
        $.ajax({
            url: `${baseurl}/admin/partnership/get_partnership_data/${selectedEventId}`,
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                updateTable(data);
            },
            error: function (error) {
                alert('Kesalahan mengambil data partnership:', error);
            },
            complete: function () {
                loadingOverlay.hide();
            }
        });
    });

    function updateTable(data) {
    console.log('Selected Event ID:', eventsId.val()); // Tambahkan ini
    tableData.find('tbody').empty();

        if (data.length > 0) {
            $.each(data, function (index, item) {
                const row = `<tr>
                                <td>${index + 1}</td>
                                <td>${item.name}</td>
                                <td>${item.kuota_tiket}</td>
                                <td>${item.tiket_terjual}</td>
                            </tr>`;
                tableData.find('tbody').append(row);
            });
        } else {
            const row = `<tr><td colspan="5" class="text-center">Data tidak ditemukan</td></tr>`;
            tableData.find('tbody').append(row);
        }
    }
});
