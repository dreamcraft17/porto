<?php

namespace Tests\Feature;

use App\Mail\ContactFormMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    private function validPayload(): array
    {
        return [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'subject' => 'Project inquiry',
            'message' => 'Hello, I would like to discuss a project.',
        ];
    }

    public function test_contact_form_sends_mail_to_configured_recipient(): void
    {
        Mail::fake();

        $response = $this->postJson('/contact', $this->validPayload());

        $response->assertOk()
            ->assertJson(['success' => true]);

        Mail::assertSent(ContactFormMail::class, function (ContactFormMail $mail) {
            return true;
        });
    }

    public function test_contact_email_uses_app_sender_and_visitor_reply_to(): void
    {
        Mail::fake();

        $this->postJson('/contact', $this->validPayload());

        Mail::assertSent(ContactFormMail::class, function (ContactFormMail $mail) {
            $envelope = $mail->envelope();

            return $envelope->from->address === config('mail.from.address')
                && $envelope->replyTo[0]->address === 'john@example.com';
        });
    }

    public function test_contact_form_validates_required_fields(): void
    {
        $response = $this->postJson('/contact', []);

        $response->assertStatus(422);
    }

    public function test_contact_form_is_throttled_after_five_submissions(): void
    {
        Mail::fake();

        for ($i = 0; $i < 5; $i++) {
            $response = $this->postJson('/contact', $this->validPayload());
            $response->assertOk();
        }

        $response = $this->postJson('/contact', $this->validPayload());
        $response->assertStatus(429);
    }
}
