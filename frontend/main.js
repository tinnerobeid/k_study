// ===== Mobile menu toggle =====
const hamburger = document.getElementById('hamburger');
const nav = document.getElementById('site-nav');

if (hamburger && nav) {
  hamburger.addEventListener('click', () => {
    const open = nav.classList.toggle('open');
    hamburger.setAttribute('aria-expanded', String(open));
  });

  // close on link click (mobile)
  nav.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', () => {
      nav.classList.remove('open');
      hamburger.setAttribute('aria-expanded', 'false');
    });
  });
}

// ===== Smooth scroll for same-page anchors =====
document.querySelectorAll('a[href^="#"]').forEach(a => {
  a.addEventListener('click', (e) => {
    const id = a.getAttribute('href');
    if (id && id.length > 1) {
      const el = document.querySelector(id);
      if (el) {
        e.preventDefault();
        el.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    }
  });
});

// ===== Footer year =====
const yearEl = document.getElementById('footer-year');
if (yearEl) yearEl.textContent = new Date().getFullYear();

// ===== Join form (inline validation + fake submit) =====
const form = document.getElementById('applyForm');
if (form) {
  const email = document.getElementById('joinEmail');
  const help  = document.getElementById('joinHelp');
  const msg   = document.getElementById('joinMsg');
  const btn   = form.querySelector('.cta-join__btn');

  const isValidEmail = (v) => /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v);

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    msg.textContent = '';
    help.textContent = '';

    const value = (email.value || '').trim();
    if (!isValidEmail(value)){
      help.textContent = 'Please enter a valid email address.';
      email.focus();
      return;
    }

    btn.disabled = true; btn.textContent = 'Submitting…';
    // TODO: replace with your real endpoint
    await new Promise(r => setTimeout(r, 700));
    btn.disabled = false; btn.textContent = 'Apply Now';
    form.reset();
    msg.textContent = 'Thanks! We’ll be in touch shortly.';
  });
}

// ===== Save power: pause hero video when tab hidden =====
const heroVideo = document.querySelector('.hero-video');
if (heroVideo) {
  document.addEventListener('visibilitychange', () => {
    if (document.hidden) heroVideo.pause();
    else heroVideo.play().catch(()=>{});
  });
}
