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


