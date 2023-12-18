document.addEventListener('DOMContentLoaded', function() {
    let counterValue = 0;
    let pricePerTicket = document.getElementById('price').innerText;
    let titleElement = document.getElementById('title');

    function updateCounter() {
        document.getElementById('counter-1').innerText = counterValue;

        const decrementButton = document.getElementById('decrement1');
        decrementButton.className = `btn btn-sm btn-warning ${counterValue > 0 ? 'left' : 'disabled left'}`;

        const incrementButton = document.getElementById('increment1');
        incrementButton.className = `btn btn-sm btn-warning ${counterValue < availableQuota ? '' : 'disabled'}`;

        const ticketParagraph = document.querySelector('.cart-ticket-name');
        const subTotalPriceLabel = document.getElementById('sub-total-price');
        const checkoutButton = document.querySelector('.event-detail-cart-checkout button');

        if (counterValue > 0) {
            ticketParagraph.innerText = `${counterValue}x ${titleElement.innerText}`;
            ticketParagraph.classList.add('text-truncate', 'col', 'px-0');

            const subTotalPrice = pricePerTicket * counterValue;
            subTotalPriceLabel.innerText = `Rp. ${subTotalPrice}`;
            checkoutButton.removeAttribute('disabled');
        } else {
            ticketParagraph.innerText = 'Kamu belum memiliki tiket, Silakan pilih tiket terlebih dulu di tab menu TIKET';
            ticketParagraph.classList.remove('text-truncate', 'col', 'px-0');
            subTotalPriceLabel.innerText = `Rp. ${pricePerTicket}`;
            checkoutButton.setAttribute('disabled', true);
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