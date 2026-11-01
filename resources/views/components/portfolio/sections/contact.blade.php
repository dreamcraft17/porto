<section id="contact" class="block contact-section">
    <div class="contact-grid">
        <div>
            <p class="section-label">Contact</p>
            <h2 class="section-title">Have a workflow that is too important to keep patching?</h2>
            <p class="contact-note">
                Send the context, the people involved, and the part that keeps getting stuck. We can work out whether the right answer is a new system, a better flow, or a smaller fix.
            </p>
            <p class="contact-direct">
                Prefer email?
                <a href="mailto:{{ config('app.social.email') }}">{{ config('app.social.email') }}</a>
            </p>
        </div>

        <form class="contact-form" id="contactForm">
            @csrf
            <div class="form-status" id="formStatus" role="status" aria-live="polite"></div>
            <div class="form-row">
                <div>
                    <label for="name">Your name</label>
                    <input type="text" id="name" name="name" autocomplete="name" placeholder="How should I call you?" required>
                </div>
                <div>
                    <label for="email">Work email</label>
                    <input type="email" id="email" name="email" autocomplete="email" placeholder="you@company.com" required>
                </div>
            </div>
            <div>
                <label for="subject">What needs fixing?</label>
                <input type="text" id="subject" name="subject" autocomplete="off" placeholder="Payroll, reporting, mobile workflow..." required>
            </div>
            <div>
                <label for="message">A little context</label>
                <textarea id="message" name="message" autocomplete="off" placeholder="What happens today, and what should happen instead?" required></textarea>
            </div>
            <button class="btn btn-primary submit-btn" type="submit" data-default-text="Send the brief">Send the brief</button>
        </form>
    </div>
</section>
