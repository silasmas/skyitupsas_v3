/**
 * Modales recrutement : overlay centré (sans Lity), panneaux déplacés depuis le store caché.
 */
(function () {
  'use strict';

  var config = window.skyCareerModals || {};
  var overlay = null;
  var slot = null;
  var store = null;
  var activePanel = null;
  var lastFocus = null;

  /**
   * Résout l’identifiant du panneau à ouvrir.
   *
   * @param {string} type detail|apply
   * @param {string} slug Slug de l’offre
   * @returns {string} id DOM du panneau
   */
  function panelId(type, slug) {
    return type === 'apply' ? 'career-apply-' + slug : 'career-detail-' + slug;
  }

  /**
   * Met à jour aria-labelledby sur le dialogue.
   *
   * @param {HTMLElement} panel Panneau actif
   */
  function syncDialogLabel(panel) {
    var dialog = overlay && overlay.querySelector('.sky-career-overlay__dialog');
    var titleEl = panel && panel.querySelector('.sky-career-modal__title');
    if (!dialog || !titleEl) {
      return;
    }
    var titleId = titleEl.getAttribute('id');
    if (!titleId) {
      titleId = 'sky-career-modal-title-' + Date.now();
      titleEl.setAttribute('id', titleId);
    }
    dialog.setAttribute('aria-labelledby', titleId);
  }

  /**
   * Ferme la modale et renvoie le panneau dans le store.
   */
  function closeModal() {
    if (!overlay || !activePanel || !store) {
      return;
    }
    store.appendChild(activePanel);
    activePanel = null;
    slot.innerHTML = '';
    overlay.classList.remove('is-open');
    overlay.setAttribute('hidden', '');
    overlay.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('sky-career-modal-open');
    if (lastFocus && typeof lastFocus.focus === 'function') {
      lastFocus.focus();
    }
  }

  /**
   * Ouvre un panneau dans l’overlay.
   *
   * @param {string} id Identifiant du panneau (#career-detail-slug)
   */
  function openModal(id) {
    if (!store || !overlay || !slot) {
      return;
    }
    var panel = document.getElementById(id);
    if (!panel || !store.contains(panel)) {
      return;
    }
    if (activePanel) {
      store.appendChild(activePanel);
      activePanel = null;
    }
    lastFocus = document.activeElement;
    slot.appendChild(panel);
    activePanel = panel;
    syncDialogLabel(panel);
    overlay.removeAttribute('hidden');
    overlay.setAttribute('aria-hidden', 'false');
    requestAnimationFrame(function () {
      overlay.classList.add('is-open');
    });
    document.body.classList.add('sky-career-modal-open');
    var closeBtn = overlay.querySelector('.sky-career-overlay__close');
    if (closeBtn) {
      closeBtn.focus();
    }
    if (typeof window.skyCareerFormInit === 'function') {
      window.skyCareerFormInit(panel);
    }
  }

  /**
   * Ouvre depuis un bouton data-sky-career-open.
   *
   * @param {HTMLElement} trigger Élément déclencheur
   */
  function openFromTrigger(trigger) {
    var type = trigger.getAttribute('data-sky-career-open');
    var slug = trigger.getAttribute('data-sky-career-slug');
    if (!type || !slug) {
      return;
    }
    openModal(panelId(type, slug));
  }

  /**
   * Initialise les écouteurs d’événements.
   */
  function bindEvents() {
    document.addEventListener('click', function (event) {
      var opener = event.target.closest('[data-sky-career-open]');
      if (opener) {
        event.preventDefault();
        openFromTrigger(opener);
        return;
      }
      if (event.target.closest('[data-sky-career-close]')) {
        event.preventDefault();
        closeModal();
      }
    });

    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape' && activePanel) {
        event.preventDefault();
        closeModal();
      }
    });
  }

  /**
   * Ouvre une modale depuis la config URL (offer / apply).
   */
  function openFromConfig() {
    if (config.openApply) {
      openModal(panelId('apply', config.openApply));
      if (config.showToast && typeof window.skyCareerShowToast === 'function') {
        window.setTimeout(window.skyCareerShowToast, 500);
      }
      return;
    }
    if (config.openOffer) {
      openModal(panelId('detail', config.openOffer));
    }
  }

  document.addEventListener('DOMContentLoaded', function () {
    overlay = document.getElementById('sky-career-overlay');
    slot = document.getElementById('sky-career-overlay-slot');
    store = document.getElementById('sky-career-modals-store');
    if (!overlay || !slot || !store) {
      return;
    }
    bindEvents();
    openFromConfig();
  });
})();
