(function () {
    'use strict';

    /* Dificulta cópia casual; não substitui a proteção de arquivos no servidor. */
    document.addEventListener('contextmenu', function (e) {
        e.preventDefault();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'F12' || (e.ctrlKey && e.shiftKey && ['I', 'J', 'C'].includes(e.key.toUpperCase())) || (e.ctrlKey && e.key.toUpperCase() === 'U')) {
            e.preventDefault();
        }
    });

    var toggle = document.querySelector('.isp-menu-toggle');
    var menu   = document.querySelector('.isp-menu');
    var header = document.querySelector('.isp-header');

    if (!toggle || !menu) return;

    function openMenu() {
        menu.classList.add('is-open');
        toggle.classList.add('is-active');
        toggle.setAttribute('aria-expanded', 'true');
        document.body.classList.add('isp-menu-aberto');
    }

    function closeMenu() {
        menu.classList.remove('is-open');
        toggle.classList.remove('is-active');
        toggle.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('isp-menu-aberto');
    }

    toggle.addEventListener('click', function () {
        menu.classList.contains('is-open') ? closeMenu() : openMenu();
    });

    /* Fecha ao clicar fora do header */
    document.addEventListener('click', function (e) {
        if (!header.contains(e.target)) closeMenu();
    });

    /* Fecha ao pressionar Escape */
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') { closeMenu(); toggle.focus(); }
    });

    /* Fecha ao clicar em links âncora (#) */
    menu.querySelectorAll('a[href*="#"]').forEach(function (link) {
        link.addEventListener('click', closeMenu);
    });

    /* Scroll shadow no header */
    window.addEventListener('scroll', function () {
        header.classList.toggle('isp-header--scrolled', window.scrollY > 8);
    }, { passive: true });
})();