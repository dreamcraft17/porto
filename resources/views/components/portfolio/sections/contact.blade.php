<section id="contact" class="section-wrap contact-section">
    <div class="contact-head">
        <div class="section-kicker">Contact</div>
        <h2 class="section-title contact-title">Need a system, dashboard, mobile workflow, or integration built properly?</h2>
    </div>

    <div class="contact-grid">
        <div class="contact-card">
            <p class="contact-note">
                Share the business flow, the users, and the problem you want to solve. I can help turn it into a web or mobile application with a practical technical foundation.
            </p>
            <div class="contact-links">
                <a href="mailto:dozernapitupulu@gmail.com"><i class="fas fa-envelope me-2"></i>dozernapitupulu@gmail.com</a>
                <a href="https://github.com/dreamcraft17" target="_blank"><i class="fab fa-github me-2"></i>GitHub</a>
                <a href="https://www.linkedin.com/in/dozernapitupulu/" target="_blank"><i class="fab fa-linkedin me-2"></i>LinkedIn</a>
            </div>
        </div>

        <form class="contact-form" id="contactForm">
            @csrf
            <div class="form-status" id="formStatus" role="status" aria-live="polite"></div>
            <div class="form-row">
                <div>
                    <label for="name">Full Name</label>
                    <input type="text" id="name" placeholder="Your name" required>
                </div>
                <div>
                    <label for="email">Email Address</label>
                    <input type="email" id="email" placeholder="you@example.com" required>
                </div>
            </div>
            <div>
                <label for="subject">Subject</label>
                <input type="text" id="subject" placeholder="Project discussion" required>
            </div>
            <div>
                <label for="message">Message</label>
                <textarea id="message" placeholder="Tell me about your project..." required></textarea>
            </div>
            <button class="submit-btn" type="submit" data-default-text="Send Message">Send Message</button>
        </form>
    </div>
</section>
