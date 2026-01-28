<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .email-body {
            padding: 30px 20px;
        }
        .info-row {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: 600;
            color: #3b82f6;
            margin-bottom: 5px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .info-content {
            color: #1f2937;
            font-size: 16px;
        }
        .message-box {
            background: #f9fafb;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #3b82f6;
            margin-top: 10px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .email-footer {
            background: #f9fafb;
            padding: 20px;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }
        .reply-button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>📬 New Contact Message</h1>
            <p style="margin: 5px 0 0 0; opacity: 0.9;">From Your Portfolio Website</p>
        </div>
        
        <div class="email-body">
            <div class="info-row">
                <div class="info-label">👤 From</div>
                <div class="info-content">{{ $contactName }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">📧 Email</div>
                <div class="info-content">
                    <a href="mailto:{{ $contactEmail }}" style="color: #3b82f6; text-decoration: none;">
                        {{ $contactEmail }}
                    </a>
                </div>
            </div>

            <div class="info-row">
                <div class="info-label">📝 Subject</div>
                <div class="info-content">{{ $contactSubject }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">💬 Message</div>
                <div class="message-box">{{ $contactMessage }}</div>
            </div>

            <div style="text-align: center;">
                <a href="mailto:{{ $contactEmail }}" class="reply-button">
                    Reply to {{ $contactName }}
                </a>
            </div>
        </div>

        <div class="email-footer">
            <p>This message was sent from your portfolio contact form</p>
            <p style="margin: 5px 0;">
                <strong>Dozer Napitupulu Portfolio</strong><br>
                Full Stack Developer
            </p>
            <p style="margin: 10px 0 0 0; font-size: 12px; color: #9ca3af;">
                dozernapitupulu.com
            </p>
        </div>
    </div>
</body>
</html>