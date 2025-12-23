export const validateForm = (form) => {
    const elements = Array.from(form.elements).filter(el => el.hasAttribute('name'));
    let isValid = true;

    elements.forEach(el => {
        if (el.type === 'email') {
            const isEdu = el.value.endsWith('.edu');
            if (!isEdu) {
                el.setCustomValidity('Use your college email');
            } else {
                el.setCustomValidity('');
            }
        }

        if (!el.checkValidity()) {
            isValid = false;
        }

        el.addEventListener('input', () => {
            el.setCustomValidity('');
            el.reportValidity();
        }, { once: true });
    });

    if (!isValid) {
        form.classList.add('was-validated');
    }

    return isValid;
};
