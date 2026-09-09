/* GC Painting & Decorators - Interactive JavaScript Engine */

document.addEventListener('DOMContentLoaded', () => {
  if ('scrollRestoration' in history) {
    history.scrollRestoration = 'manual';
  }
  window.scrollTo(0, 0);
  
  initBeforeAfterSliders();
  initFilterTabs();
  initScrollToTop();
});

function initScrollToTop() {
  const scrollBtn = document.getElementById('scrollTopProgress');
  const progressCircle = document.querySelector('.progress-ring__circle');
  if (!scrollBtn || !progressCircle) return;

  const circumference = 119.38;

  const updateScrollProgress = () => {
    const scrollTop = window.scrollY;
    const docHeight = document.documentElement.scrollHeight - window.innerHeight;

    if (scrollTop > 150) {
      scrollBtn.classList.add('show');
    } else {
      scrollBtn.classList.remove('show');
    }

    if (docHeight > 0) {
      const scrollPercent = Math.min(Math.max(scrollTop / docHeight, 0), 1);
      const offset = circumference - (scrollPercent * circumference);
      progressCircle.style.strokeDashoffset = offset;
    }
  };

  window.addEventListener('scroll', updateScrollProgress, { passive: true });
  updateScrollProgress();

  scrollBtn.addEventListener('click', () => {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
}

function initBeforeAfterSliders() {
  const containers = document.querySelectorAll('.ba-container');

  containers.forEach(container => {
    const beforeWrapper = container.querySelector('.ba-image-before-wrapper');
    const beforeImg = container.querySelector('.ba-image-before');
    const handle = container.querySelector('.ba-handle');

    if (!beforeWrapper || !handle) return;

    let isDragging = false;
    let currentPercentage = 50;
    let autoMoveTimer = null;
    let animFrameId = null;
    let targetLeft = true; // toggles between true (0%) and false (100%)

    const updatePosition = (percentage) => {
      currentPercentage = Math.max(0, Math.min(100, percentage));
      beforeWrapper.style.width = `${currentPercentage}%`;
      handle.style.left = `${currentPercentage}%`;
      
      const rect = container.getBoundingClientRect();
      if (beforeImg && rect.width > 0) {
        beforeImg.style.width = `${rect.width}px`;
      }
    };

    const updateImgWidth = () => {
      const rect = container.getBoundingClientRect();
      if (beforeImg && rect.width > 0) {
        beforeImg.style.width = `${rect.width}px`;
      }
    };

    updateImgWidth();
    window.addEventListener('resize', updateImgWidth);

    const setPositionFromX = (x) => {
      const rect = container.getBoundingClientRect();
      let offsetX = x - rect.left;
      if (offsetX < 0) offsetX = 0;
      if (offsetX > rect.width) offsetX = rect.width;
      const percentage = (offsetX / rect.width) * 100;
      updatePosition(percentage);
    };

    // Smooth animation to target percentage over duration (ms)
    const animateTo = (targetPercentage, duration = 3000) => {
      if (animFrameId) cancelAnimationFrame(animFrameId);
      const startPercentage = currentPercentage;
      const startTime = performance.now();

      const step = (now) => {
        const elapsed = now - startTime;
        const progress = Math.min(elapsed / duration, 1);

        // Ease in-out cubic curve
        const eased = progress < 0.5
          ? 4 * progress * progress * progress
          : 1 - Math.pow(-2 * progress + 2, 3) / 2;

        const nextPos = startPercentage + (targetPercentage - startPercentage) * eased;
        updatePosition(nextPos);

        if (progress < 1) {
          animFrameId = requestAnimationFrame(step);
        }
      };

      animFrameId = requestAnimationFrame(step);
    };

    // Auto move function every 10 seconds: full coverage sweep 0% <-> 100%
    const startAutoMove = () => {
      stopAutoMove();
      autoMoveTimer = setInterval(() => {
        if (isDragging) return;
        
        // Full coverage: sweeps all the way from edge to edge (0% <-> 100%)
        const target = targetLeft ? 0 : 100;
        targetLeft = !targetLeft;
        
        animateTo(target, 3200);
      }, 10000);
    };

    const stopAutoMove = () => {
      if (autoMoveTimer) clearInterval(autoMoveTimer);
    };

    // Initial position & start 10-second timer
    updatePosition(50);
    startAutoMove();

    // Mouse Events
    container.addEventListener('mousedown', (e) => {
      isDragging = true;
      if (animFrameId) cancelAnimationFrame(animFrameId);
      setPositionFromX(e.clientX);
      startAutoMove();
    });

    window.addEventListener('mousemove', (e) => {
      if (!isDragging) return;
      setPositionFromX(e.clientX);
    });

    window.addEventListener('mouseup', () => {
      if (isDragging) {
        isDragging = false;
        startAutoMove();
      }
    });

    // Touch Events for Mobile & Tablet
    container.addEventListener('touchstart', (e) => {
      isDragging = true;
      if (animFrameId) cancelAnimationFrame(animFrameId);
      if (e.touches.length > 0) {
        setPositionFromX(e.touches[0].clientX);
      }
      startAutoMove();
    });

    window.addEventListener('touchmove', (e) => {
      if (!isDragging) return;
      if (e.touches.length > 0) {
        setPositionFromX(e.touches[0].clientX);
      }
    });

    window.addEventListener('touchend', () => {
      if (isDragging) {
        isDragging = false;
        startAutoMove();
      }
    });
  });
}

function initFilterTabs() {
  const filterBtns = document.querySelectorAll('.filter-btn');
  const items = document.querySelectorAll('.filterable-item');
  const emptyState = document.getElementById('noProjectsMessage');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active', 'btn-primary'));
      filterBtns.forEach(b => b.classList.add('btn-outline-secondary'));

      btn.classList.add('active', 'btn-primary');
      btn.classList.remove('btn-outline-secondary');

      const filter = btn.getAttribute('data-filter');
      let visibleCount = 0;

      items.forEach(item => {
        const category = item.getAttribute('data-category');
        if (filter === 'all' || category === filter || item.classList.contains(filter)) {
          item.style.display = 'block';
          visibleCount++;
        } else {
          item.style.display = 'none';
        }
      });

      if (emptyState) {
        emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
      }
    });
  });
}
