// ----------------BOUTON FLECHE POUR REMONTER EN HAUT DE LA PAGE / PRESENT DANS FOOTER-----------------

const btnArrow = document.querySelector('.btn-arrow');
const btnVisibility = () => {
    if (window.scrollY > 700) {
        btnArrow.classList.add('visible');
    } else {
        btnArrow.classList.remove('visible');
    }
};
window.addEventListener('scroll', () => {
   btnVisibility();
})


btnArrow.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        left:0,
        behavior: 'smooth'
    })
});
