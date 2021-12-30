// Rating
let stars = document.querySelectorAll('.stars label');

for (let star in stars) {
    if (stars.hasOwnProperty(star)) {
        stars[star].querySelector('input').addEventListener('change',  function () {
            if (!localStorage.getItem('voted')) {
                for (let i in stars) {
                    if (stars.hasOwnProperty(i)) {
                        stars[i].classList.remove('active');
                    }
                }
                for (let i = 1; i <= parseInt(this.value); i++) {
                    document.querySelector('.stars label:nth-child(n+' + i + ')').classList.add('active');
                }
                localStorage.setItem('voted', true);

                let data = {
                    'page': $('.ratting').data('page')
                }

                $.post('/add-vote', data, function(response) {
                    $('.votes span').text(response);
                    swal({
                        title: 'Thank you for your vote!',
                        type: 'success',
                        buttons : {
                            confirm: {
                                className : 'btn btn-success'
                            }
                        }
                    });
                }).fail(function(error) {
                    console.log(error);
                });
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
        });
    }
    // hide bottom line
    $('.promo__close', '.promo').on('click', function (e) {
        $('.promo').hide();
        e.preventDefault();
    });

    // faq handler
    $('.faq__item', '.faq').on('click', function (e) {
        $(this).toggleClass('faq__item--active');
        $(this).find('.faq__value').slideToggle();
        e.preventDefault();
    });

    // faqs handler
    $('.faqs__item', '.faqs').on('click', function () {
        $(this).toggleClass('faqs__item--active');
        $(this).find('.faqs__value').slideToggle();
    });

    // Tooltips
    $('.qtiperar').on('click', function () {
        $('.qtiperar-tooltip').remove();
        let str = $(this).data('title');
        let arr = str.split('|');
        let html = '';
        for (let i = 0; i < arr.length; i++) {
            html += '<span>' + arr[i] + '</span>';
        }
        let content = '<span class="qtiperar-tooltip">' + html + '<span class="close"></span></span>';
        $('.qtiperar').append(content);
        $(this).find('.qtiperar-tooltip').addClass('opened');
    });

    // Close tooltip
    $('.qtiperar').on('click', '.close', function (e) {
        e.stopPropagation();
        $(this).closest('.qtiperar').find('.qtiperar-tooltip').remove();
    });
})();
