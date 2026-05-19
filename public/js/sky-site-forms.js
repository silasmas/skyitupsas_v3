/**
 * Formulaires contact / newsletter et toast de confirmation site.
 */
(function () {
  'use strict';

  /**
   * Affiche le toast de confirmation.
   */
  function showToast() {
    var toast = document.getElementById('sky-site-toast');
    if (!toast) {
      return;
    }
    toast.hidden = false;
    toast.classList.add('is-visible');
    window.setTimeout(function () {
      hideToast();
    }, 12000);
  }

  /**
   * Masque le toast.
   */
  function hideToast() {
    var toast = document.getElementById('sky-site-toast');
    if (!toast) {
      return;
    }
    toast.classList.remove('is-visible');
    toast.hidden = true;
  }

  /**
   * Active l’état chargement sur le bouton d’envoi.
   *
   * @param {HTMLButtonElement|null} btn Bouton submit
   * @param {boolean} loading En chargement
   */
  function setSubmitLoading(btn, loading) {
    if (!btn) {
      return;
    }
    var textEl = btn.querySelector('[data-sky-contact-submit-text], [data-sky-newsletter-submit-text]');
    var loadingEl = btn.querySelector('[data-sky-contact-submit-loading], [data-sky-newsletter-submit-loading]');
    if (loading) {
      btn.disabled = true;
      btn.classList.add('is-loading');
    } else {
      btn.disabled = false;
      btn.classList.remove('is-loading');
    }
    if (textEl) {
      textEl.hidden = loading;
    }
    if (loadingEl) {
      loadingEl.hidden = !loading;
    }
  }

  document.addEventListener('submit', function (event) {
    var contactForm = event.target.closest('[data-sky-contact-form]');
    if (contactForm) {
      var contactBtn = contactForm.querySelector('[data-sky-contact-submit]');
      if (contactBtn && contactBtn.classList.contains('is-loading')) {
        event.preventDefault();
        return;
      }
      if (!contactForm.checkValidity()) {
        event.preventDefault();
        contactForm.reportValidity();
        return;
      }
      setSubmitLoading(contactBtn, true);
      return;
    }

    var newsletterForm = event.target.closest('[data-sky-newsletter-form]');
    if (newsletterForm) {
      var newsletterBtn = newsletterForm.querySelector('[data-sky-newsletter-submit]');
      if (newsletterBtn && newsletterBtn.classList.contains('is-loading')) {
        event.preventDefault();
        return;
      }
      if (!newsletterForm.checkValidity()) {
        event.preventDefault();
        newsletterForm.reportValidity();
        return;
      }
      setSubmitLoading(newsletterBtn, true);
    }
  });

  document.addEventListener('click', function (event) {
    if (event.target.closest('[data-sky-site-toast-close]')) {
      hideToast();
    }
  });

  document.addEventListener('DOMContentLoaded', function () {
    if (window.skySite && window.skySite.showToast) {
      showToast();
    }
  });
})();
