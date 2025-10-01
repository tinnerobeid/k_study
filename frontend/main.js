// Mobile menu
const hamburger = document.querySelector('.hamburger');
const nav = document.querySelector('.nav');

hamburger?.addEventListener('click', () => {
  const isOpen = nav.classList.toggle('open');
  hamburger.setAttribute('aria-expanded', String(isOpen));
});

// Footer year
document.getElementById('year').textContent = new Date().getFullYear();
