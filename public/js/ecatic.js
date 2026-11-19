/* ECATIC — interactions du site public */
(function () {
    'use strict';

    /* Ombre de la barre de navigation au défilement */
    var nav = document.querySelector('.ec-navbar');
    function onScroll() { if (nav) nav.classList.toggle('scrolled', window.scrollY > 10); }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    /* Animations d'apparition au défilement */
    var items = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
            });
        }, { threshold: 0.12 });
        items.forEach(function (el) { io.observe(el); });
    } else {
        items.forEach(function (el) { el.classList.add('visible'); });
    }

    /* Notifications (toasts) */
    var wrap = document.getElementById('toastWrap');
    function toast(message, type) {
        if (!wrap) return;
        var el = document.createElement('div');
        el.className = 'ec-toast ec-toast-' + (type || 'success');
        var icon = document.createElement('i');
        icon.className = 'fa-solid ' + (type === 'error' ? 'fa-circle-exclamation' : 'fa-circle-check') + ' me-2';
        el.appendChild(icon);
        el.appendChild(document.createTextNode(message));
        wrap.appendChild(el);
        requestAnimationFrame(function () { el.classList.add('show'); });
        setTimeout(function () { hide(el); }, 6000);
    }
    function hide(el) { el.classList.remove('show'); setTimeout(function () { el.remove(); }, 400); }
    document.querySelectorAll('.ec-toast[data-autohide]').forEach(function (el) { setTimeout(function () { hide(el); }, 6000); });

    /* Envoi des formulaires en AJAX (Fetch API) — fonctionne aussi sans JavaScript */
    var csrf = document.querySelector('meta[name="csrf-token"]');
    document.querySelectorAll('form[data-ajax]').forEach(function (form) {
        form.addEventListener('submit', function (ev) {
            ev.preventDefault();
            var btn = form.querySelector('[type="submit"]');
            var label = btn ? btn.innerHTML : '';
            form.querySelectorAll('.is-invalid').forEach(function (f) { f.classList.remove('is-invalid'); });
            if (btn) { btn.disabled = true; btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Envoi…'; }

            fetch(form.action, {
                method: 'POST',
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf ? csrf.content : '', 'X-Requested-With': 'XMLHttpRequest' },
                body: new FormData(form),
                credentials: 'same-origin'
            }).then(function (res) {
                return res.json().catch(function () { return {}; }).then(function (data) { return { status: res.status, data: data }; });
            }).then(function (r) {
                if (r.status >= 200 && r.status < 300) {
                    form.reset();
                    var modal = form.closest('.modal');
                    if (modal && window.bootstrap) { var inst = bootstrap.Modal.getInstance(modal); if (inst) inst.hide(); }
                    toast(r.data.message || 'Envoyé avec succès.', 'success');
                } else if (r.status === 422 && r.data.errors) {
                    Object.keys(r.data.errors).forEach(function (name) {
                        var field = form.querySelector('[name="' + name + '"]');
                        if (field) {
                            field.classList.add('is-invalid');
                            var fb = field.parentElement.querySelector('.invalid-feedback');
                            if (fb) fb.textContent = r.data.errors[name][0];
                        }
                    });
                    toast('Veuillez corriger les champs signalés.', 'error');
                } else if (r.status === 429) {
                    toast('Trop de tentatives. Merci de patienter une minute.', 'error');
                } else {
                    toast('Une erreur est survenue. Merci de réessayer.', 'error');
                }
            }).catch(function () {
                toast('Connexion impossible. Vérifiez votre réseau et réessayez.', 'error');
            }).finally(function () {
                if (btn) { btn.disabled = false; btn.innerHTML = label; }
            });
        });
    });

    /* Modale de devis : présélection du service cliqué */
    var quoteModal = document.getElementById('quoteModal');
    if (quoteModal) {
        quoteModal.addEventListener('show.bs.modal', function (ev) {
            var trigger = ev.relatedTarget;
            var select = document.getElementById('q_service_id');
            if (select && trigger) select.value = trigger.getAttribute('data-service-id') || '';
        });
    }
})();
