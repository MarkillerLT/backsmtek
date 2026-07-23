/* =====================================================
   SMTEK Smart Technologies — script.js
   ===================================================== */

(function () {
  "use strict";

  // ── Dark mode ──────────────────────────────────────────
  const body = document.body;
  const toggleBtn = document.getElementById("dark-toggle");
  const toggleLabel = document.querySelector(".toggle-label");
  const logoImg = document.getElementById("logo-img");

  const LOGO_LIGHT = "/assets/img/1.svg";
  const LOGO_DARK  = "/assets/img/1b.svg";
  // const LOGO_LIGHT = window.SMTEK?.logoLight || "/assets/img/1.svg";
  // const LOGO_DARK  = window.SMTEK?.logoDark || "/assets/img/1b.svg";

  const LABEL_LIGHT = "Modo Oscuro";
  const LABEL_DARK  = "Modo Claro";

  function applyDarkMode(isDark) {
    body.classList.toggle("dark-mode", isDark);

    if (toggleLabel) {
      toggleLabel.textContent = isDark ? LABEL_DARK : LABEL_LIGHT;
    }

    if (logoImg) {
      logoImg.src = isDark ? LOGO_DARK : LOGO_LIGHT;
      logoImg.alt = "SMTEK Logo";
    }
    const toggleIcon = document.querySelector(".toggle-icon");
    if (toggleIcon) {
    toggleIcon.innerHTML = isDark
      ? // Sol
        `<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
          <title>light</title>
          <path fill="white" d="M12 17q-2.075 0-3.537-1.463T7 12t1.463-3.537T12 7t3.538 1.463T17 12t-1.463 3.538T12 17m-7-4H1v-2h4zm18 0h-4v-2h4zM11 5V1h2v4zm0 18v-4h2v4zM6.4 7.75L3.875 5.325L5.3 3.85l2.4 2.45zM18.7 20.15l-2.425-2.475L17.6 16.25l2.525 2.425zM16.25 6.4l2.425-2.525L20.15 5.3l-2.45 2.4zM3.85 18.7l2.475-2.425L7.75 17.6l-2.425 2.525z"/>
        </svg>`
      : // Luna
        `<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
          <title>dark</title>
          <path fill="currentColor" d="M12.741 20.917a9.4 9.4 0 0 1-1.395-.105a9.141 9.141 0 0 1-1.465-17.7a1.18 1.18 0 0 1 1.21.281a1.27 1.27 0 0 1 .325 1.293a8.1 8.1 0 0 0-.353 2.68a8.27 8.27 0 0 0 4.366 6.857a7.6 7.6 0 0 0 3.711.993a1.242 1.242 0 0 1 .994 1.963a9.15 9.15 0 0 1-7.393 3.738M10.261 4.05a.2.2 0 0 0-.065.011a8.137 8.137 0 1 0 9.131 12.526a.22.22 0 0 0 .013-.235a.23.23 0 0 0-.206-.136a8.6 8.6 0 0 1-4.188-1.116a9.27 9.27 0 0 1-4.883-7.7a9.1 9.1 0 0 1 .4-3.008a.29.29 0 0 0-.069-.285a.18.18 0 0 0-.133-.057"/>
        </svg>`;
      }

    try {
      localStorage.setItem("smtek-dark-mode", isDark ? "1" : "0");
    } catch (_) {}
  }

  // Restore preference
  let prefersDark = false;
  try {
    const saved = localStorage.getItem("smtek-dark-mode");
    if (saved !== null) {
      prefersDark = saved === "1";
    } else {
      prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
    }
  } catch (_) {}

  applyDarkMode(prefersDark);

  if (toggleBtn) {
    toggleBtn.addEventListener("click", function () {
      applyDarkMode(!body.classList.contains("dark-mode"));
    });
  }

  // ── Mobile nav ────────────────────────────────────────
  const hamburger = document.getElementById("hamburger");
  const nav = document.getElementById("nav-principal");

  if (hamburger && nav) {
    hamburger.addEventListener("click", function () {
      const isOpen = nav.classList.toggle("abierto");
      hamburger.setAttribute("aria-expanded", isOpen);
    });

    // Close on link click
    nav.querySelectorAll("a").forEach(function (link) {
      link.addEventListener("click", function () {
        nav.classList.remove("abierto");
        hamburger.setAttribute("aria-expanded", false);
      });
    });
  }

  // ── Animated counters ─────────────────────────────────
  function animateCounter(el) {
    const target = parseFloat(el.dataset.target);
    const suffix = el.dataset.suffix || "";
    const duration = 1800;
    const start = performance.now();

    function step(now) {
      const elapsed = now - start;
      const progress = Math.min(elapsed / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3); // ease-out-cubic
      const current = Math.round(eased * target);
      el.textContent = current + suffix;
      if (progress < 1) requestAnimationFrame(step);
    }

    requestAnimationFrame(step);
  }

  const counters = document.querySelectorAll("[data-counter]");

  if (counters.length && "IntersectionObserver" in window) {
    const observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            animateCounter(entry.target);
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.4 }
    );

    counters.forEach(function (counter) {
      observer.observe(counter);
    });
  }

  // ── Scroll reveal ─────────────────────────────────────
  const revealEls = document.querySelectorAll(".reveal");

  if (revealEls.length && "IntersectionObserver" in window) {
    const revealObserver = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add("visible");
            revealObserver.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.12 }
    );

    revealEls.forEach(function (el) {
      revealObserver.observe(el);
    });
  }
})();

// ── Sidebar admin (mobile) ─────────────────────────────
const sidebarToggle = document.getElementById("sidebarToggle");
const adminSidebar = document.getElementById("adminSidebar");

if (sidebarToggle && adminSidebar) {
  sidebarToggle.addEventListener("click", function () {
    adminSidebar.classList.toggle("open");
  });
}
