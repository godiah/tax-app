<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the Taxgen Consultants Newsletter</title>
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
                            Welcome to Our Newsletter!
                        </h2>

                        <p style="margin:0 0 16px 0; font-size:14px; color:#555;">
                            Dear Valued Subscriber,
                        </p>

                        <p style="margin:0 0 20px 0; font-size:14px; color:#555;">
                            Thank you for joining the Taxgen Consultants community. We look forward to
                            sharing expert tax insights, regulatory updates, and practical financial
                            guidance with you.
                        </p>

                        <div style="background-color:#f8f9fa; padding:20px; margin:0 0 24px 0;
                                    border-left:3px solid #e25822;">
                            <p style="margin:0 0 10px 0; font-size:13px; font-weight:bold; color:#1f3b73;">
                                What to expect:
                            </p>
                            <ul style="margin:0; padding-left:18px; color:#555; font-size:13px; line-height:1.9;">
                                <li>Expert tax insights and analysis</li>
                                <li>Latest updates on tax regulations</li>
                                <li>Practical tips for tax planning</li>
                                <li>Exclusive content and resources</li>
                            </ul>
                        </div>

                    </td>
                </tr>

                <tr>
                    <td style="padding:0 32px 32px 32px; font-family:Arial,sans-serif;
                               font-size:11px; color:#999; text-align:center;">
                        You received this email because you subscribed to the Taxgen Consultants newsletter.
                    </td>
                </tr>

                @include('Mails.partials.email-footer')

            </table>

        </td>
    </tr>
</table>

</body>
</html>
