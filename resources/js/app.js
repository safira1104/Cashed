import './bootstrap';
document.querySelector('.scroll-btn').addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector('#cards').scrollIntoView({
        behavior: 'smooth'
    });
});
