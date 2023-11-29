function toggleInput(showId) {
    var showElement = document.getElementById(showId);

    // Hide all elements with class 'hidden'
    var hiddenElements = document.querySelectorAll('.hidden');
    hiddenElements.forEach(function(element) {
        element.style.maxHeight = '0';
    });

    showElement.style.maxHeight = showElement.scrollHeight + 'px';
}