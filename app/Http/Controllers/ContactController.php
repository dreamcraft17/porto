<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactController extends Controller
{
    public function send(Request $request): JsonResponse
    {
        $request->headers->set('Accept', 'application/json');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        $recipient = config('mail.contact.to');

        if (! filled($recipient)) {
            Log::error('Contact form aborted: CONTACT_MAIL_TO is empty.');

            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an error sending your message. Please try again.',
            ], 500);
        }

        try {
            Mail::to($recipient, config('mail.contact.to_name'))->send(new ContactFormMail($validated));

            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your message has been sent successfully.',
            ]);
        } catch (Throwable $e) {
            Log::error('Contact form mail failed.', [
                'exception' => $e::class,
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an error sending your message. Please try again.',
            ], 500);
        }
    }
}
