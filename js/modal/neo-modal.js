(function () { //invoke function declare for this modals behavior
    "use strict";

    // SVG icons untuk setiap status
    const icons = {
        success: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>`,
        error: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>`,
        warning: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>`,
        info: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>`
    };

    /**
     * Memastikan elemen modal ada di dalam DOM
     */
    function ensureModalDOM() {
        let overlay = document.getElementById("neo-modal-overlay");
        if (!overlay) {
            overlay = document.createElement("div");
            overlay.id = "neo-modal-overlay";
            overlay.className = "neo-modal-overlay";
            overlay.innerHTML = `
                <div class="neo-modal-card">
                    <div class="neo-modal-header">
                        <div id="neo-modal-icon-wrapper" class="neo-modal-icon info">
                            <span id="neo-modal-icon"></span>
                        </div>
                        <div>
                            <h2 id="neo-modal-title" class="neo-modal-title">Notifikasi</h2>
                            <p id="neo-modal-subtitle" class="neo-modal-subtitle">SIMS - SMK 1 NGAWI</p>
                        </div>
                    </div>
                    <div class="neo-modal-body">
                        <p id="neo-modal-message" class="neo-modal-message"></p>
                    </div>
                    <div class="neo-modal-footer">
                        <button id="neo-modal-ok" class="neo-modal-btn neo-modal-btn-primary">OK</button>
                    </div>
                </div>
            `;
            document.body.appendChild(overlay);
        }
        return overlay;
    }

    function showModal(data) {
        if (!data) return; //if invalid == die this

        const overlay = ensureModalDOM();
        const iconWrapper = document.getElementById("neo-modal-icon-wrapper");
        const iconSpan = document.getElementById("neo-modal-icon");
        const titleEl = document.getElementById("neo-modal-title");
        const subtitleEl = document.getElementById("neo-modal-subtitle");
        const messageEl = document.getElementById("neo-modal-message");
        const okBtn = document.getElementById("neo-modal-ok");

        const type = data.type || "info";
        const title = data.title || "Notifikasi";
        const subtitle = data.subtitle || "SIMS - SMK 1 NGAWI"; //work like null coalesce if 'right' has falsy
        const message = data.message || "";
        const redirect = data.redirect || null;

        // Update textContent berdasarkan kondisi
        if (titleEl) titleEl.textContent = title;
        if (subtitleEl) subtitleEl.textContent = subtitle;
        if (messageEl) messageEl.textContent = message;

        // Update icon & styling class
        if (iconSpan && icons[type]) {
            iconSpan.innerHTML = icons[type];
        }
        if (iconWrapper) {
            iconWrapper.className = `neo-modal-icon ${type}`;
        }

        // Tampilkan modal dengan transisi
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                overlay.classList.add("active");
            });
        });

        // Handler untuk menutup modal
        function closeModal() {
            overlay.classList.remove("active");
            if (redirect) {
                setTimeout(() => {
                    window.location.href = redirect;
                }, 300);
            }
        }

        // Bind event listeners
        if (okBtn) {
            okBtn.onclick = closeModal;
        }

        overlay.onclick = function (e) {
            if (e.target === overlay) {
                closeModal();
            }
        };

        const keyHandler = function (e) {
            if (e.key === "Escape") {
                closeModal();
                document.removeEventListener("keydown", keyHandler);
            }
        };
        document.addEventListener("keydown", keyHandler);
    }

    // Ekspor fungsi global
    window.showNeoModal = showModal;

    // Eksekusi otomatis jika data modal di-injeksi oleh PHP
    function init() {
        if (window.__neoModal) {
            showModal(window.__neoModal);
        }
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", init);
    } else {
        init();
    }
})();
