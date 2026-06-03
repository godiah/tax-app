<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Contacting Taxgen Consultants</title>
</head>
<body style="margin:0; padding:0; background-color:#f0f0f0; font-family:Arial,sans-serif;">

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color:#f0f0f0;">
    <tr>
        <td align="center" style="padding:24px 0;">

            <table width="600" border="0" cellpadding="0" cellspacing="0"
                   style="background-color:#ffffff; border-collapse:collapse;">

                @include('Mails.partials.email-header')

                {{-- Content --}}
                <tr>
                    <td style="padding:32px 32px 8px 32px; font-family:Arial,sans-serif;
                               font-size:14px; color:#333; line-height:1.7;">

                        <h2 style="margin:0 0 16px 0; font-size:20px; color:#1f3b73; text-align:center;">
                            Thank You for Reaching Out!
                        </h2>

                        <p style="margin:0 0 16px 0; font-size:14px; color:#555; text-align:center;">
                            We've received your inquiry and will get back to you shortly.
                        </p>

                        <div style="background-color:#f8f9fa; padding:20px; margin:24px 0;
                                    border-left:3px solid #e25822;">
                            <p style="margin:0 0 10px 0; font-size:13px; font-weight:bold; color:#1f3b73;">
                                What happens next?
                            </p>
                            <ul style="margin:0; padding-left:18px; color:#555; font-size:13px; line-height:1.9;">
                                <li>Our team will carefully review your enquiry</li>
                                <li>We'll prepare a detailed response to your questions</li>
                                <li>You'll receive a follow-up from our expert team within 24&ndash;48 hours</li>
                            </ul>
                        </div>

                        <p style="margin:0 0 24px 0; font-size:13px; color:#777; text-align:center;">
                            In the meantime, feel free to call us directly on
                            <a href="tel:+254723881440"
                               style="color:#e25822; text-decoration:none; font-weight:bold;">
                                (+254) 723-881-440
                            </a>
                        </p>

                    </td>
                </tr>

                <tr>
                    <td style="padding:0 32px 32px 32px; font-family:Arial,sans-serif;
                               font-size:11px; color:#999; text-align:center;">
                        This is an automated confirmation. Please do not reply to this email.
                    </td>
                </tr>

                @include('Mails.partials.email-footer')

            </table>

        </td>
    </tr>
</table>

</body>
</html>
