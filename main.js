// ==========================================================
//  main.js – Eneby Vision
// ==========================================================

// ---------- Menu mobile ----------
const mobileMenuButton = document.getElementById('mobile-menu-button');
const mobileMenu       = document.getElementById('mobile-menu');

if (mobileMenuButton && mobileMenu) {
  mobileMenuButton.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });
}

// ---------- Scroll fluide pour les ancres ----------
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    const targetId = this.getAttribute('href');
    if (!targetId || targetId === '#') return;
    const targetElement = document.querySelector(targetId);
    if (!targetElement) return;
    // Empêche l'ancrage automatique si on clique sur un lien menant à la section carrousel
    if (targetId === '#features' || targetId === '#features-carousel') return;
    e.preventDefault();
    if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
      mobileMenu.classList.add('hidden');
    }
    window.scrollTo({
      top      : targetElement.offsetTop - 80,
      behavior : 'smooth'
    });
  });
});

// ==========================================================
//  Carrousel desktop / tablette  (features-carousel)
// ==========================================================
(function () {
  const carousel = document.getElementById('features-carousel');
  if (!carousel) return;

  let slides       = Array.from(carousel.children);
  let currentSlide = 0;
  let scrollTimer  = null;

  const isMobile = () => window.innerWidth <= 768;

  function updateDots () {
    const dots = document.querySelectorAll('.carousel-dot');
    dots.forEach((dot, idx) => {
      dot.classList.toggle('ring-4', idx === currentSlide);
      dot.classList.toggle('ring-blue-400'  , idx === 0 && currentSlide === 0);
      dot.classList.toggle('ring-purple-400', idx === 1 && currentSlide === 1);
      dot.classList.toggle('ring-indigo-400', idx === 2 && currentSlide === 2);
    });
  }

  function goToSlide (idx, animate = true) {
    if (!slides.length) return;

    currentSlide = (idx + slides.length) % slides.length;

    if (isMobile()) {
      // centre la slide dans la vue
      const slide        = slides[currentSlide];
      const carouselRect = carousel.getBoundingClientRect();
      const slideRect    = slide.getBoundingClientRect();
      const targetLeft   = carousel.scrollLeft +
        (slideRect.left - carouselRect.left) -
        (carouselRect.width / 2 - slideRect.width / 2);

      carousel.scrollTo({
        left     : targetLeft,
        behavior : animate ? 'smooth' : 'auto'
      });
    } else {
      carousel.style.transition = animate ? 'transform 0.7s cubic-bezier(0.4,0,0.2,1)' : 'none';
      carousel.style.transform  = `translateX(-${currentSlide * 100}%)`;
    }
    updateDots();
  }

  // boutons flèches
  window.moveCarousel = direction => goToSlide(currentSlide + direction);
  window.moveCarouselTo = idx     => goToSlide(idx);

  // rotation auto desktop
  const autoRotate = setInterval(() => { if (!isMobile()) window.moveCarousel(1); }, 8000);

  // aimant de centrage après scroll manuel
  carousel.addEventListener('scroll', () => {
    clearTimeout(scrollTimer);
    scrollTimer = setTimeout(() => {
      if (!isMobile()) {
        // Desktop : snap classique
        const { left: carLeft, width: carWidth } = carousel.getBoundingClientRect();
        let idx = 0, minDist = Infinity;
        slides.forEach((slide, i) => {
          const { left, width } = slide.getBoundingClientRect();
          const dist = Math.abs((left + width / 2) - (carLeft + carWidth / 2));
          if (dist < minDist) { minDist = dist; idx = i; }
        });
        goToSlide(idx, true);
      }
      // Sur mobile, on laisse l'utilisateur scroller librement (pas de snap automatique)
    }, 120);
  });

  // bloque le scroll vertical lorsqu'on swipe horizontalement
  let startX = 0, startY = 0, dragging = false;
  carousel.addEventListener('touchstart', e => {
    if (e.touches.length === 1) {
      startX = e.touches[0].clientX;
      startY = e.touches[0].clientY;
      dragging = false;
    }
  }, { passive: true });

  carousel.addEventListener('touchmove', e => {
    if (e.touches.length !== 1) return;
    const dx = Math.abs(e.touches[0].clientX - startX);
    const dy = Math.abs(e.touches[0].clientY - startY);
    if (dx > 10 && dx > dy) { dragging = true; e.preventDefault(); }
  }, { passive: false });

  function toggleArrows () {
    const left  = document.getElementById('features-carousel-btn-left');
    const right = document.getElementById('features-carousel-btn-right');
    if (!left || !right) return;
    const show = !isMobile();
    left.style.display  = show ? '' : 'none';
    right.style.display = show ? '' : 'none';
  }

  window.addEventListener('resize', () => {
    slides = Array.from(carousel.children);
    goToSlide(currentSlide, false);
    toggleArrows();
  });

  document.addEventListener('DOMContentLoaded', () => {
    slides = Array.from(carousel.children);
    goToSlide(0, false);
    toggleArrows();
  });

  // petit délai pour être sûr que tout est chargé
  setTimeout(() => { slides = Array.from(carousel.children); goToSlide(0, false); updateDots(); }, 100);
})();

// ==========================================================
//  Carrousel mobile dédié  (features-carousel-mobile)
// ==========================================================
(function () {
  const mobileCarousel = document.getElementById('features-carousel-mobile');
  const mobileDots     = document.getElementById('features-carousel-mobile-dots');
  if (!mobileCarousel || !mobileDots) return;

  const slides = Array.from(mobileCarousel.children);
  const dots   = Array.from(mobileDots.children);

  function updateMobileDots () {
    const { left: carLeft, width: carWidth } = mobileCarousel.getBoundingClientRect();
    let idx = 0, minDist = Infinity;
    slides.forEach((slide, i) => {
      const { left, width } = slide.getBoundingClientRect();
      const dist = Math.abs((left + width / 2) - (carLeft + carWidth / 2));
      if (dist < minDist) { minDist = dist; idx = i; }
    });
    dots.forEach((dot, i) => { dot.style.opacity = i === idx ? '0.8' : '0.4'; });
  }

  // clic sur un dot
  dots.forEach((dot, i) => {
    dot.addEventListener('click', () => {
      slides[i].scrollIntoView({
        behavior : 'smooth',
        inline   : 'center',
        block    : 'nearest'
      });
    });
  });

  mobileCarousel.addEventListener('scroll', updateMobileDots);
  window.addEventListener('resize', updateMobileDots);
  updateMobileDots();
})();

// ==========================================================
//  Animation d’apparition au scroll
// ==========================================================
(function () {
  const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate-fadeIn');
        obs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.feature-card, .card-hover, .team-card, .process-step')
          .forEach(el => observer.observe(el));
})();