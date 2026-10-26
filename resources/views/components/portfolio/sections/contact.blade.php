<section id="contact" class="block contact-section">
    <div class="block-head">
        <div class="section-kicker">Contact</div>
        <h2 class="section-title contact-title">Need a system, dashboard, mobile workflow, or integration built properly?</h2>
    </div>

    <div class="contact-grid">
        <div class="contact-card">
            <p class="contact-note">
                Share the business flow, the users, and the problem you want to solve. I can help turn it into a web or mobile application with a practical technical foundation.
            </p>
            <div class="contact-links">
                <a href="mailto:{{ config('app.social.email') }}"><i class="fas fa-envelope" aria-hidden="true"></i>{{ config('app.social.email') }}</a>
                <a href="{{ config('app.social.github') }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-github" aria-hidden="true"></i>GitHub</a>
                <a href="{{ config('app.social.linkedin') }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin" aria-hidden="true"></i>LinkedIn</a>
            </div>
        </div>

        <form class="contact-form" id="contactForm">
            @csrf
            <div class="form-status" id="formStatus" role="status" aria-live="polite"></div>
            <div class="form-row">
                <div>
                    <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" autocomplete="name" placeholder="Your name" required>
                </div>
                <div>
                    <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" autocomplete="email" placeholder="you@example.com" required>
                </div>
            </div>
            <div>
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" autocomplete="off" placeholder="Project discussion" required>
            </div>
            <div>
                <label for="message">Message</label>
                <textarea id="message" name="message" autocomplete="off" placeholder="Tell me about your project..." required></textarea>
            </div>
            <button class="submit-btn" type="submit" data-default-text="Send Message">Send Message</button>
        </form>
    </div>
</section>
