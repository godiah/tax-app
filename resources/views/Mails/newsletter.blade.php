<!-- resources/views/Mails/contact-blade.php -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post['title'] }} - Taxgen Consultants</title>
</head>
<body style="font-family: 'Arial', sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background-color: #f4f4f4;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <!-- Header with Logo -->
        <div style="text-align: center; margin-bottom: 30px;">
            <img src="{{ config('app.url') . '/images/logo.png' }}" alt="Taxgen Consultants LLP" style="max-width: 200px;">
        </div>

        <!-- Main Content -->
        <div style="padding: 20px 0;">
            <h2 style="color: #2c3e50; margin-bottom: 20px; font-size: 24px;">
                {{ $post['title'] }}
            </h2>

            <p style="color: #555; font-size: 16px; margin-bottom: 20px;">
                {{ $post['excerpt'] }}
            </p>

            <!-- Call to Action Button -->
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ $blogUrl }}"
                   style="background-color: #3498db; color: #ffffff; padding: 12px 24px; text-decoration: none; border-radius: 4px; font-weight: bold; display: inline-block;">
                    Read Full Article
                </a>
            </div>

            <!-- Divider -->
            <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">

            <!-- Footer -->
            <div style="font-size: 13px; color: #666; text-align: center;">
                <p>You're receiving this email because you subscribed to Taxgen Consultants' newsletter.</p>
                {{-- <p>
                    <a href="{{ $unsubscribeUrl }}"
                       style="color: #3498db; text-decoration: underline;">
                        Unsubscribe from our newsletter
                    </a>
                </p> --}}
                <p style="margin-top: 20px;">
                    © {{ date('Y') }} Taxgen Consultants. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
