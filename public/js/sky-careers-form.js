/**
 * Formulaire candidature : dropzones PDF, validation sous les champs, chargement submit, toast.
 */
(function () {
  'use strict';

  var pdfOnlyMessage = document.documentElement.lang === 'en'
    ? 'Only PDF files are accepted.'
    : 'Seuls les fichiers PDF sont acceptés.';

  /**
   * Affiche le nom du fichier sélectionné.
   *
   * @param {HTMLElement} zone Zone dropzone
   * @param {File|null} file Fichier
   */
  function setFileLabel(zone, file) {
    var nameEl = zone.querySelector('[data-sky-career-filename]');
    if (!nameEl) {
      return;
    }
    if (file) {
      nameEl.textContent = file.name;
      nameEl.hidden = false;
      zone.classList.add('has-file');
    } else {
      nameEl.textContent = '';
      nameEl.hidden = true;
      zone.classList.remove('has-file');
    }
  }

  /**
   * Assigne des fichiers à l’input file.
   *
   * @param {HTMLInputElement} input Input file
   * @param {File[]} files Liste de fichiers
   */
  function assignFiles(input, files) {
    var dt = new DataTransfer();
    var i;
    for (i = 0; i < files.length; i++) {
      dt.items.add(files[i]);
    }
    input.files = dt.files;
    input.dispatchEvent(new Event('change', { bubbles: true }));
  }

  /**
   * Vérifie qu’un fichier est un PDF.
   *
   * @param {File} file Fichier
   * @returns {boolean} true si PDF
   */
  function isPdf(file) {
    return file.type === 'application/pdf' || /\.pdf$/i.test(file.name);
  }

  /**
   * Active l’état dragover.
   *
   * @param {HTMLElement} zone Zone
   * @param {boolean} active Survol actif
   */
  function setDragover(zone, active) {
    zone.classList.toggle('is-dragover', active);
  }

  /**
   * Affiche une erreur client sous le champ.
   *
   * @param {HTMLElement} field Conteneur .sky-career-form__field
   * @param {string} message Message
   */
  function showClientError(field, message) {
    if (!field) {
      return;
    }
    field.classList.add('has-error');
    var clientEl = field.querySelector('.sky-career-form__error--client');
    if (clientEl) {
      clientEl.textContent = message;
      clientEl.hidden = false;
    }
    var control = field.querySelector('.sky-career-form__control, .sky-career-dropzone');
    if (control) {
      control.classList.add('is-invalid');
    }
  }

  /**
   * Efface l’erreur client du champ.
   *
   * @param {HTMLElement} field Conteneur champ
   */
  function clearClientError(field) {
    if (!field) {
      return;
    }
    field.classList.remove('has-error');
    var clientEl = field.querySelector('.sky-career-form__error--client');
    if (clientEl) {
      clientEl.textContent = '';
      clientEl.hidden = true;
    }
    var control = field.querySelector('.sky-career-form__control, .sky-career-dropzone');
    if (control) {
      control.classList.remove('is-invalid');
    }
  }

  /**
   * Retourne le conteneur champ parent.
   *
   * @param {HTMLElement} el Élément interne
   * @returns {HTMLElement|null} Conteneur
   */
  function getFieldWrap(el) {
    return el.closest('.sky-career-form__field');
  }

  /**
   * Initialise une zone d’upload PDF.
   *
   * @param {HTMLElement} zone Zone dropzone
   */
  function initFileDropzone(zone) {
    if (zone.dataset.skyCareerBound === '1') {
      return;
    }
    zone.dataset.skyCareerBound = '1';

    var input = zone.querySelector('input[type="file"]');
    var browseBtn = zone.querySelector('[data-sky-career-browse]');
    if (!input) {
      return;
    }

    if (browseBtn) {
      browseBtn.addEventListener('click', function (event) {
        event.preventDefault();
        event.stopPropagation();
        input.click();
      });
    }

    zone.addEventListener('click', function (event) {
      if (event.target.closest('[data-sky-career-browse]')) {
        return;
      }
      if (event.target === input) {
        return;
      }
      input.click();
    });

    input.addEventListener('change', function () {
      var field = getFieldWrap(zone);
      var file = input.files && input.files[0] ? input.files[0] : null;
      if (file && !isPdf(file)) {
        assignFiles(input, []);
        setFileLabel(zone, null);
        showClientError(field, pdfOnlyMessage);
        return;
      }
      clearClientError(field);
      setFileLabel(zone, file);
    });

    zone.addEventListener('dragenter', function (event) {
      event.preventDefault();
      setDragover(zone, true);
    });
    zone.addEventListener('dragover', function (event) {
      event.preventDefault();
      setDragover(zone, true);
    });
    zone.addEventListener('dragleave', function (event) {
      if (!zone.contains(event.relatedTarget)) {
        setDragover(zone, false);
      }
    });
    zone.addEventListener('drop', function (event) {
      event.preventDefault();
      setDragover(zone, false);
      var files = event.dataTransfer && event.dataTransfer.files;
      var field = getFieldWrap(zone);
      if (!files || !files.length) {
        return;
      }
      var file = files[0];
      if (!isPdf(file)) {
        showClientError(field, pdfOnlyMessage);
        return;
      }
      clearClientError(field);
      assignFiles(input, [file]);
      setFileLabel(zone, file);
    });
  }

  /**
   * Lie la validation HTML5 aux messages sous les champs.
   *
   * @param {HTMLFormElement} form Formulaire
   */
  function bindFieldValidation(form) {
    var controls = form.querySelectorAll('.sky-career-form__control, input[type="file"]');
    controls.forEach(function (control) {
      control.addEventListener('invalid', function () {
        var field = getFieldWrap(control);
        showClientError(field, control.validationMessage);
      });
      control.addEventListener('input', function () {
        clearClientError(getFieldWrap(control));
      });
      control.addEventListener('change', function () {
        clearClientError(getFieldWrap(control));
      });
    });
  }

  /**
   * Active l’état chargement du bouton submit.
   *
   * @param {HTMLButtonElement|null} btn Bouton
   * @param {boolean} loading En cours
   */
  function setSubmitLoading(btn, loading) {
    if (!btn) {
      return;
    }
    btn.classList.toggle('is-loading', loading);
    btn.disabled = loading;
    btn.setAttribute('aria-busy', loading ? 'true' : 'false');
    var loadingEl = btn.querySelector('.sky-career-form__submit-loading');
    var textEl = btn.querySelector('.sky-career-form__submit-text');
    if (loadingEl) {
      loadingEl.hidden = !loading;
    }
    if (textEl) {
      textEl.hidden = loading;
    }
  }

  /**
   * Affiche le toast de confirmation.
   */
  function showToast() {
    var toast = document.getElementById('sky-career-toast');
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
    var toast = document.getElementById('sky-career-toast');
    if (!toast) {
      return;
    }
    toast.classList.remove('is-visible');
    toast.hidden = true;
  }

  /**
   * Initialise un formulaire candidature.
   *
   * @param {HTMLFormElement} form Formulaire
   */
  function initForm(form) {
    if (!form || form.dataset.skyCareerFormBound === '1') {
      return;
    }
    form.dataset.skyCareerFormBound = '1';
    form.querySelectorAll('[data-sky-career-file-dropzone]').forEach(initFileDropzone);
    bindFieldValidation(form);
  }

  /**
   * Initialise les formulaires dans un panneau.
   *
   * @param {HTMLElement} root Racine
   */
  function initPanel(root) {
    var scope = root || document;
    scope.querySelectorAll('[data-sky-career-form]').forEach(initForm);
  }

  document.addEventListener('submit', function (event) {
    var form = event.target.closest('[data-sky-career-form]');
    if (!form) {
      return;
    }
    var btn = form.querySelector('[data-sky-career-submit]');
    if (btn && btn.classList.contains('is-loading')) {
      event.preventDefault();
      return;
    }
    if (!form.checkValidity()) {
      event.preventDefault();
      form.reportValidity();
      return;
    }
    setSubmitLoading(btn, true);
  });

  document.addEventListener('click', function (event) {
    if (event.target.closest('[data-sky-career-toast-close]')) {
      hideToast();
    }
  });

  document.addEventListener('DOMContentLoaded', function () {
    var store = document.getElementById('sky-career-modals-store');
    if (store) {
      initPanel(store);
    }
    if (window.skyCareerModals && window.skyCareerModals.showToast) {
      showToast();
    }
  });

  window.skyCareerFormInit = initPanel;
  window.skyCareerShowToast = showToast;
})();
