"use strict";

/*
  JS halaman ADMIN toko (login + kelola barang/informasi).
  Fitur: mode gelap/terang, validasi form, pencarian tabel.
  JANGAN dipasang di landing page pelanggan (style Organic tidak dirancang untuk mode gelap).
*/
(function () {
  var themeStorageKey = "toko.colorTheme";

  function onReady(callback) {
    if (document.readyState === "loading") {
      document.addEventListener("DOMContentLoaded", callback);
      return;
    }
    callback();
  }

  function canUseStorage() {
    try {
      var testKey = themeStorageKey + ".test";
      window.localStorage.setItem(testKey, "1");
      window.localStorage.removeItem(testKey);
      return true;
    } catch (error) {
      return false;
    }
  }

  function getPreferredTheme(storageAvailable) {
    var savedTheme = storageAvailable
      ? window.localStorage.getItem(themeStorageKey)
      : "";

    if (savedTheme === "dark" || savedTheme === "light") {
      return savedTheme;
    }

    if (
      window.matchMedia &&
      window.matchMedia("(prefers-color-scheme: dark)").matches
    ) {
      return "dark";
    }

    return "light";
  }

  onReady(function () {
    var themeToggles = document.querySelectorAll("[data-theme-toggle]");
    var themeIcons = document.querySelectorAll("[data-theme-icon]");
    var storageAvailable = canUseStorage();

    // Validasi form Bootstrap (class .needs-validation)
    function initValidation() {
      var forms = document.querySelectorAll(".needs-validation");

      Array.prototype.forEach.call(forms, function (form) {
        form.addEventListener("submit", function (event) {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }

          form.classList.add("was-validated");
        });
      });
    }

    // Pencarian tabel: <input data-table-search="id-tabel">
    function initTableSearch() {
      var searchInputs = document.querySelectorAll("[data-table-search]");

      Array.prototype.forEach.call(searchInputs, function (input) {
        var tableId = input.getAttribute("data-table-search");
        var table = document.getElementById(tableId);

        if (!table) {
          return;
        }

        input.addEventListener("input", function () {
          var query = input.value.trim().toLowerCase();
          var rows = table.querySelectorAll("tbody tr");

          Array.prototype.forEach.call(rows, function (row) {
            row.hidden =
              query !== "" &&
              row.textContent.toLowerCase().indexOf(query) === -1;
          });
        });
      });
    }

    function updateThemeControls(theme) {
      var nextTheme = theme === "dark" ? "terang" : "gelap";
      var label = "Ganti ke mode " + nextTheme;
      var iconClass = theme === "dark" ? "bi bi-sun" : "bi bi-moon-stars";

      Array.prototype.forEach.call(themeToggles, function (button) {
        button.setAttribute("aria-label", label);
        button.setAttribute("title", label);
      });

      Array.prototype.forEach.call(themeIcons, function (icon) {
        icon.className = iconClass;
      });
    }

    function applyTheme(theme) {
      document.documentElement.setAttribute("data-bs-theme", theme);

      if (storageAvailable) {
        window.localStorage.setItem(themeStorageKey, theme);
      }

      updateThemeControls(theme);
    }

    // Hanya aktif kalau halaman punya tombol [data-theme-toggle]
    function initThemeToggle() {
      if (themeToggles.length === 0) {
        return;
      }

      applyTheme(getPreferredTheme(storageAvailable));

      Array.prototype.forEach.call(themeToggles, function (button) {
        button.addEventListener("click", function () {
          var currentTheme =
            document.documentElement.getAttribute("data-bs-theme") === "dark"
              ? "dark"
              : "light";
          applyTheme(currentTheme === "dark" ? "light" : "dark");
        });
      });
    }

    initValidation();
    initTableSearch();
    initThemeToggle();
  });
})();
