// Rating
let stars = document.querySelectorAll('.stars label');

for (let star in stars) {
    if (stars.hasOwnProperty(star)) {
        stars[star].querySelector('input').addEventListener('change',  function () {
            // remove class active
            for (let i in stars) {
                if (stars.hasOwnProperty(i)) {
                    stars[i].classList.remove('active');
                }
            }
            for (let i = 1; i <= parseInt(this.value); i++) {
                document.querySelector('.stars label:nth-child(n+' + i + ')').classList.add('active');
            }
        });
    }
}

(function (jQuery) {
    'use strict';

    // mobile menu
    $('.header__button', '.header').on('click', function (e) {
        $('.header__nav').slideToggle('header__nav--close');
        $('.header__button').toggleClass('header__button--close');
        e.preventDefault();
    });
    if($(window).width() < 768) {
        $('.navigation li.drop_list>i').on('click', function() {
            $(this).toggleClass('open').next().next().slideToggle();
        })
    }
    // hide bottom line
    $('.promo__close', '.promo').on('click', function (e) {
        $('.promo').hide();
        e.preventDefault();
    });
})();


