document.addEventListener('DOMContentLoaded', function () {
    let pesertaCounter = 1;

function addField() {
    pesertaCounter++;

    const template = document.querySelector('.list_peserta_group_template');
    const newField = template.cloneNode(true);
    newField.classList.remove('list_peserta_group_template');
    newField.classList.add('list_peserta_group');

    newField.querySelector('.peserta_list').textContent = `Peserta ${pesertaCounter}`;

    const inputs = newField.querySelectorAll('[name]');
    inputs.forEach(input => {
        const name = input.getAttribute('name');
        input.setAttribute('name', name.replace('1', pesertaCounter));

        if (input.id !== 'qty') {
            input.value = '';
        }
    });

    const removeButton = document.createElement('a');
    removeButton.href = '#';
    removeButton.className = 'text-danger remove-field';
    removeButton.innerHTML = '<i class="fas fa-minus-circle"></i>';
    removeButton.addEventListener('click', () => {
        removeField(newField);
    });

    newField.appendChild(removeButton);

    document.querySelector('.card-body').appendChild(newField);
}

    function removeField(field) {
        // Only allow removing fields from the second one onward
        if (pesertaCounter > 1) {
        pesertaCounter--;
        field.remove();

        // Update span text for remaining fields
        const fields = document.querySelectorAll('.list_peserta_group');
        fields.forEach((field, index) => {
            field.querySelector('.peserta_list').textContent = 'Peserta ' + (index + 1);
        });
        }
    }

    // Event listener for "Tambah Field" button
    document.querySelector('.btn-info').addEventListener('click', function () {
        addField();
    });

    // Event delegation for "Hapus Field" button
    document.querySelector('.card-body').addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-field')) {
        const field = event.target.closest('.list_peserta_group');
        removeField(field);
        }
    });
});