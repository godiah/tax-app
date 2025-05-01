<!-- resources/views/Mails/contact-blade.php -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission - Taxgen Consultants</title>
</head>
<body style="font-family: 'Arial', sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background-color: #f4f4f4;">
    <div style="max-width: 600px; margin: 20px auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <!-- Header with Logo -->
        <div style="text-align: center; margin-bottom: 30px;">
            <img src="{{ config('app.url') . '/images/logo.png' }}" alt="Taxgen Consultants LLP" style="max-width: 200px;">
        </div>

        <!-- Main Content -->
        <div style="padding: 20px 0;">
            <h2 style="color: #2c3e50; margin-bottom: 25px; font-size: 24px; text-align: center; border-bottom: 2px solid #eee; padding-bottom: 10px;">
                New Contact Form Submission
            </h2>

            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 6px; margin: 20px 0;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;">
                            <strong style="color: #2c3e50;">Name:</strong>
                        </td>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;">
                            {{ $details['name'] }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;">
                            <strong style="color: #2c3e50;">Email:</strong>
                        </td>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;">
                            <a href="mailto:{{ $details['email'] }}" style="color: #3498db; text-decoration: none;">
                                {{ $details['email'] }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;">
                            <strong style="color: #2c3e50;">Phone:</strong>
                        </td>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;">
                            {{ $details['phone'] ?? 'N/A' }}
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Message Section -->
            <div style="margin-top: 25px;">
                <h3 style="color: #2c3e50; margin-bottom: 15px;">Message:</h3>
                <div style="background-color: #f8f9fa; padding: 20px; border-radius: 6px; color: #555;">
                    {{ $details['message'] }}
                </div>
            </div>

            <!-- Quick Actions -->
            <div style="margin-top: 30px; text-align: center;">
                <a href="mailto:{{ $details['email'] }}"
                   style="display: inline-block; background-color: #3498db; color: #ffffff; padding: 12px 24px; text-decoration: none; border-radius: 4px; margin: 0 10px;">
                    Reply to Email
                </a>
            </div>

            <!-- Footer -->
            <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #eee; text-align: center; color: #666; font-size: 12px;">
                <p>This is an automated notification from Taxgen Consultants contact form.</p>
                <p>© {{ date('Y') }} Taxgen Consultants. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
