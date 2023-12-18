(function() {
    // INITIALIZATION OF STICKY BLOCKS
    // =======================================================
    new HSStickyBlock('.js-sticky-block', {
        targetSelector: document.getElementById('header').classList.contains('navbar-fixed') ? '#header' : null
    })

    // INITIALIZATION OF HEADER
    // =======================================================
    new HSHeader('#header').init()


    // INITIALIZATION OF SHOW ANIMATIONS
    // =======================================================
    new HSShowAnimation('.js-animation-link')


    // INITIALIZATION OF BOOTSTRAP DROPDOWN
    // =======================================================
    HSBsDropdown.init()


    // INITIALIZATION OF GO TO
    // =======================================================
    new HSGoTo('.js-go-to')


    // INITIALIZATION OF AOS
    // =======================================================
    AOS.init({
        duration: 650,
        once: true
    });


    // INITIALIZATION OF TEXT ANIMATION (TYPING)
    // =======================================================
    HSCore.components.HSTyped.init('.js-typedjs')

});