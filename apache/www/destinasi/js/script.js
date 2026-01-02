const stars = document.querySelectorAll('#rating-stars span');
const ratingInput = document.getElementById('rating');

stars.forEach((star, index) => {
    star.addEventListener('click', () => {
        const value = star.getAttribute('data-value');
        ratingInput.value = value;

        stars.forEach((s, i) => {
            s.classList.toggle('active', i < value);
        });
    });
});

