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

        status.className = 'form-status';
        status.textContent = '';
        btn.textContent = 'Sending...';
        btn.disabled = true;

        const formData = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            subject: document.getElementById('subject').value,
            message: document.getElementById('message').value,
            _token: document.querySelector('input[name="_token"]').value,
        };

        fetch('/contact', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': formData._token,
            },
            body: JSON.stringify(formData),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    status.textContent = 'Message sent successfully. I will get back to you soon.';
                    status.className = 'form-status is-visible is-success';
                    form.reset();
                } else {
                    status.textContent = 'Sorry, there was an error sending your message. Please contact me directly via email.';
                    status.className = 'form-status is-visible is-error';
                }
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
