<!-- resources/views/Mails/contact-blade.php -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Contacting Taxgen Consultants</title>
</head>
<body style="font-family: 'Arial', sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background-color: #f4f4f4;">
    <div style="max-width: 600px; margin: 20px auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <!-- Header with Logo -->
        <div style="text-align: center; margin-bottom: 30px;">
            <img src="{{ config('app.url') . '/images/logo.png' }}" alt="Taxgen Consultants LLP" style="max-width: 200px;">
        </div>

        <!-- Main Content -->
        <div style="padding: 20px 0;">
            <h1 style="color: #2c3e50; margin-bottom: 20px; font-size: 28px; text-align: center;">
                Thank You for Reaching Out!
            </h1>

            <p style="color: #555; font-size: 16px; margin-bottom: 20px;">
                We've received your inquiry and appreciate you taking the time to contact us. Our team will review your message and get back to you as soon as possible.
            </p>

            <!-- What to Expect -->
            <div style="margin-top: 30px;">
                <h3 style="color: #2c3e50; margin-bottom: 15px;">What's Next?</h3>
                <ul style="color: #555; padding-left: 20px;">
                    <li style="margin-bottom: 10px;">Our team will carefully review your inquiry</li>
                    <li style="margin-bottom: 10px;">We'll prepare a detailed response to your questions</li>
                    <li style="margin-bottom: 10px;">You'll receive a follow-up email from our expert team</li>
                </ul>
            </div>

            <!-- Footer -->
            <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #eee; text-align: center; color: #666; font-size: 12px;">
                <p>© {{ date('Y') }} Taxgen Consultants. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
