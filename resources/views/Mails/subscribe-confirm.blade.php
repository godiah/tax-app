<!-- resources/views/Mails/contact-blade.php -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Taxgen Consultants Newsletter!</title>
</head>
<body style="font-family: 'Arial', sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background-color: #f4f4f4;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <!-- Header with Logo -->
        <div style="text-align: center; margin-bottom: 30px;">
            <img src="{{ config('app.url') . '/images/logo.png' }}" alt="Taxgen Consultants LLP" style="max-width: 200px;">
        </div>

        <!-- Welcome Message -->
        <div style="padding: 20px 0;">
            <h1 style="color: #2c3e50; margin-bottom: 20px; font-size: 28px; text-align: center;">
                Welcome to Our Newsletter!
            </h1>

            <p style="color: #555; font-size: 16px; margin-bottom: 20px;">
                Dear Valued Subscriber,
            </p>

            <p style="color: #555; font-size: 16px; margin-bottom: 20px;">
                Thank you for joining the Taxgen Consultants community! We're excited to have you on board and look forward to sharing valuable tax insights, expert advice, and industry updates with you.
            </p>

            <!-- What to Expect Section -->
            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 6px; margin: 20px 0;">
                <h3 style="color: #2c3e50; margin-bottom: 15px;">What to Expect:</h3>
                <ul style="color: #555; padding-left: 20px;">
                    <li style="margin-bottom: 10px;">Expert tax insights and analysis</li>
                    <li style="margin-bottom: 10px;">Latest updates on tax regulations</li>
                    <li style="margin-bottom: 10px;">Practical tips for tax planning</li>
                    <li style="margin-bottom: 10px;">Exclusive content and resources</li>
                </ul>
            </div>

            <!-- Social Media Links -->
            {{-- <div style="text-align: center; margin: 30px 0;">
                <p style="color: #555; font-size: 16px; margin-bottom: 15px;">Follow us on social media:</p>
                <a href="#" style="text-decoration: none; margin: 0 10px;"><img src="{{ asset('images/social/linkedin.png') }}" alt="LinkedIn" style="width: 32px;"></a>
                <a href="#" style="text-decoration: none; margin: 0 10px;"><img src="{{ asset('images/social/twitter.png') }}" alt="Twitter" style="width: 32px;"></a>
                <a href="#" style="text-decoration: none; margin: 0 10px;"><img src="{{ asset('images/social/facebook.png') }}" alt="Facebook" style="width: 32px;"></a>
            </div> --}}

            <!-- Footer -->
            <div style="font-size: 13px; color: #666; text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
                <p>© {{ date('Y') }} Taxgen Consultants LLP. All rights reserved.</p>
                <p>
                    <a href="{{ route('home') }}" style="color: #3498db; text-decoration: none;">Visit Our Website</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
