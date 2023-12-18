document.addEventListener('DOMContentLoaded', function() {
    let counterValue = 0;
    let availableQuota = parseInt(document.getElementById('count-2').innerText);
    let pricePerTicket = parseFloat(document.getElementById('price').innerText);
    let titleElement = document.getElementById('title');
    let hitungElement = document.getElementById('hitung');

    function updateCounter() {
        document.getElementById('counter-1').innerText = counterValue;

        const decrementButton = document.getElementById('decrement1');
        decrementButton.className = `btn btn-sm btn-warning left ${counterValue > 0 ? '' : 'disabled'}`;

        const incrementButton = document.getElementById('increment1');
        incrementButton.className = `btn btn-sm btn-warning ${counterValue < availableQuota ? '' : 'disabled'}`;

        const ticketParagraph = document.querySelector('.cart-ticket-name');
        const subTotalPriceLabel = document.getElementById('sub-total-price');
        const checkoutButton = document.querySelector('.event-detail-cart-checkout button');

        if (counterValue > 0) {
            ticketParagraph.innerHTML = `${counterValue}x ${titleElement.innerText}`;
            ticketParagraph.classList.add('text-truncate', 'col', 'px-0');

            const subTotalPrice = pricePerTicket * counterValue;
            subTotalPriceLabel.innerHTML = `Rp. ${subTotalPrice.toLocaleString()}`;
            checkoutButton.removeAttribute('disabled');
            hitungElement.classList.remove('d-none');
        } else {
            ticketParagraph.innerHTML = 'Kamu belum memiliki tiket, Silakan pilih tiket terlebih dulu di <b>tab menu TIKET</b>';
            ticketParagraph.classList.remove('text-truncate', 'col', 'px-0');
            checkoutButton.setAttribute('disabled', true);
            hitungElement.classList.add('d-none');
        }
    }

    function handleButtonClick(isIncrement) {
        if ((isIncrement && counterValue < availableQuota) || (!isIncrement && counterValue > 0)) {
            counterValue += isIncrement ? 1 : -1;
            updateCounter();
        }
    }

    document.getElementById('increment1').addEventListener('click', function() {
        handleButtonClick(true);
    });

    document.getElementById('decrement1').addEventListener('click', function() {
        handleButtonClick(false);
    });

    updateCounter();
});