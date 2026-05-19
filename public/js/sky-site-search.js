/**
 * Recherche asynchrone dans l’en-tête du site.
 */
(function () {
  'use strict';

  var debounceTimer = null;
  var abortController = null;

  /**
   * Retourne le libellé du type de résultat.
   *
   * @param {string} type Type de contenu
   * @returns {string} Libellé
   */
  function typeLabel(type) {
    var i18n = (window.skySite && window.skySite.i18n) || {};
    var map = {
      service: i18n.searchTypeService || 'Service',
      realisation: i18n.searchTypeRealisation || 'Réalisation',
      job: i18n.searchTypeJob || 'Offre',
      page: i18n.searchTypePage || 'Page',
    };
    return map[type] || type;
  }

  /**
   * Crée ou récupère le conteneur de résultats.
   *
   * @param {HTMLElement} container Conteneur du formulaire
   * @returns {HTMLElement} Dropdown
   */
  function getDropdown(container) {
    var existing = container.querySelector('[data-sky-search-dropdown]');
    if (existing) {
      return existing;
    }
    var dropdown = document.createElement('div');
    dropdown.className = 'sky-search-dropdown';
    dropdown.setAttribute('data-sky-search-dropdown', '');
    dropdown.setAttribute('role', 'listbox');
    container.appendChild(dropdown);
    return dropdown;
  }

  /**
   * Affiche un message dans le dropdown.
   *
   * @param {HTMLElement} dropdown Conteneur
   * @param {string} message Texte
   */
  function showStatus(dropdown, message) {
    dropdown.innerHTML = '<p class="sky-search-dropdown__status">' + message + '</p>';
    dropdown.classList.add('is-open');
  }

  /**
   * Affiche les résultats de recherche.
   *
   * @param {HTMLElement} dropdown Conteneur
   * @param {Array} results Résultats API
   */
  function renderResults(dropdown, results) {
    if (!results.length) {
      showStatus(dropdown, (window.skySite && window.skySite.i18n && window.skySite.i18n.searchEmpty) || 'Aucun résultat');
      return;
    }
    var html = '';
    results.forEach(function (item) {
      html += '<a class="sky-search-dropdown__item" href="' + item.url + '" role="option">';
      html += '<span class="sky-search-dropdown__type">' + typeLabel(item.type) + '</span>';
      html += '<span class="sky-search-dropdown__title">' + item.title + '</span>';
      if (item.excerpt) {
        html += '<span class="sky-search-dropdown__excerpt">' + item.excerpt + '</span>';
      }
      html += '</a>';
    });
    dropdown.innerHTML = html;
    dropdown.classList.add('is-open');
  }

  /**
   * Lance la requête de recherche.
   *
   * @param {string} query Terme
   * @param {HTMLElement} dropdown Dropdown
   */
  function fetchResults(query, dropdown) {
    if (!window.skySite || !window.skySite.searchUrl) {
      return;
    }
    if (abortController) {
      abortController.abort();
    }
    abortController = new AbortController();
    var url = window.skySite.searchUrl + '?q=' + encodeURIComponent(query);
    showStatus(dropdown, (window.skySite.i18n && window.skySite.i18n.searchLoading) || 'Recherche…');

    fetch(url, {
      headers: { Accept: 'application/json' },
      signal: abortController.signal,
    })
      .then(function (response) {
        if (!response.ok) {
          throw new Error('search failed');
        }
        return response.json();
      })
      .then(function (data) {
        renderResults(dropdown, data.results || []);
      })
      .catch(function (error) {
        if (error.name === 'AbortError') {
          return;
        }
        showStatus(dropdown, (window.skySite.i18n && window.skySite.i18n.searchError) || 'Erreur de recherche');
      });
  }

  /**
   * Initialise un champ de recherche.
   *
   * @param {HTMLInputElement} input Champ
   */
  function initSearchInput(input) {
    var form = input.closest('form');
    if (!form) {
      return;
    }
    var container = form.closest('.ld-search-form-container') || form.parentElement;
    if (!container) {
      return;
    }
    var dropdown = getDropdown(container);

    form.addEventListener('submit', function (event) {
      event.preventDefault();
      var query = input.value.trim();
      if (query.length >= 2) {
        fetchResults(query, dropdown);
      }
    });

    input.addEventListener('input', function () {
      var query = input.value.trim();
      window.clearTimeout(debounceTimer);
      if (query.length < 2) {
        dropdown.classList.remove('is-open');
        dropdown.innerHTML = '';
        return;
      }
      debounceTimer = window.setTimeout(function () {
        fetchResults(query, dropdown);
      }, 320);
    });

    document.addEventListener('click', function (event) {
      if (!container.contains(event.target)) {
        dropdown.classList.remove('is-open');
      }
    });
  }

  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-sky-search-input]').forEach(initSearchInput);
  });
})();
