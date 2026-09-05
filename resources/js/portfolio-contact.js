document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('contactForm');
    if (!form) {
        return;
    }

    form.addEventListener('submit', (event) => {
        event.preventDefault();

        const btn = form.querySelector('button[type="submit"]');
        const status = document.getElementById('formStatus');
        const originalText = btn.dataset.defaultText;
        const token = document.querySelector('input[name="_token"]').value;

        status.className = 'form-status';
        status.textContent = '';
        btn.textContent = 'Sending...';
        btn.disabled = true;

        const formData = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            subject: document.getElementById('subject').value,
            message: document.getElementById('message').value,
        };

        fetch('/contact', {
            method: 'POST',
            headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
            },
            body: JSON.stringify(formData),
        })
            .then(async (response) => {
                const data = await response.json().catch(() => ({}));

                if (response.ok && data.success) {
                    status.textContent = data.message || 'Message sent successfully. I will get back to you soon.';
                    status.className = 'form-status is-visible is-success';
                    form.reset();
                    return;
                }

                if (response.status === 422 && data.errors) {
                    const firstError = Object.values(data.errors).flat()[0];
                    status.textContent = firstError || 'Please check the form and try again.';
                } else if (response.status === 429) {
                    status.textContent = 'Too many messages. Please wait a minute and try again.';
                } else {
                    status.textContent = data.message || 'Sorry, there was an error sending your message. Please contact me directly via email.';
                }

                status.className = 'form-status is-visible is-error';
            })
            .catch(() => {
                status.textContent = 'Sorry, there was an error sending your message. Please try again or contact me directly via email.';
                status.className = 'form-status is-visible is-error';
            })
            .finally(() => {
                btn.textContent = originalText;
                btn.disabled = false;
            });
    });
});
