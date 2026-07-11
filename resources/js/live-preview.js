document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('configureForm');
    const iframe = document.getElementById('livePreviewFrame');
    const resetBtn = document.getElementById('resetSettingsBtn');

    if (!form || !iframe) {
        return;
    }

    const previewUrl = form.dataset.previewUrl;
    let debounceTimer = null;

    // Snapshot initial values so Reset can restore them without a page reload.
    const initialState = new FormData(form);

    function updatePreview() {
        const formData = new FormData(form);
        const params = new URLSearchParams();

        for (const [key, value] of formData.entries()) {
            // Skip file inputs and CSRF/method spoofing fields — the
            // preview endpoint only understands the visual settings fields.
            if (key === '_token' || key === '_method' || key === 'sponsor_logo') continue;
            params.set(key, value);
        }

        // Checkboxes that are unchecked don't appear in FormData at all,
        // so explicitly set them to "0" for fields the preview expects.
        ['show_logos', 'show_timer', 'show_score', 'show_period', 'show_sponsor', 'show_ticker'].forEach((field) => {
            if (!formData.has(field)) {
                params.set(field, '0');
            }
        });

        iframe.src = `${previewUrl}?${params.toString()}`;
    }

    form.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(updatePreview, 350);
    });

    form.addEventListener('change', () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(updatePreview, 100);
    });

    resetBtn?.addEventListener('click', () => {
        for (const [key, value] of initialState.entries()) {
            const field = form.elements.namedItem(key);
            if (!field) continue;

            if (field instanceof RadioNodeList) {
                field.forEach((el) => {
                    if (el.type === 'checkbox') el.checked = el.value === value;
                    if (el.type === 'radio') el.checked = el.value === value;
                });
            } else if (field.type === 'checkbox') {
                field.checked = true;
            } else if (field.type !== 'file') {
                field.value = value;
            }
        }

        document.querySelectorAll('.theme-option').forEach((opt) => opt.classList.remove('theme-option-active'));
        form.querySelector(`input[name="theme"][value="${initialState.get('theme')}"]`)
            ?.closest('.theme-option')
            ?.classList.add('theme-option-active');

        updatePreview();
    });
});