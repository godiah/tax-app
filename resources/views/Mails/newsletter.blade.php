<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post['title'] }} - Taxgen Consultants</title>
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

                        <h2 style="margin:0 0 16px 0; font-size:19px; color:#1f3b73; line-height:1.3;">
                            {{ $post['title'] }}
                        </h2>

                        <p style="margin:0 0 24px 0; font-size:14px; color:#555;">
                            {{ $post['excerpt'] }}
                        </p>

                        <div style="text-align:center; margin:0 0 28px 0;">
                            <a href="{{ $blogUrl }}"
                               style="display:inline-block; background-color:#e25822; color:#ffffff;
                                      padding:13px 32px; text-decoration:none; font-size:13px;
                                      font-weight:bold; border-radius:3px;">
                                Read Full Article
                            </a>
                        </div>

                    </td>
                </tr>

                <tr>
                    <td style="padding:0 32px 32px 32px; font-family:Arial,sans-serif;
                               font-size:11px; color:#999; text-align:center;">
                        You received this because you subscribed to the Taxgen Consultants newsletter.
                    </td>
                </tr>

                @include('Mails.partials.email-footer')

            </table>

        </td>
    </tr>
</table>

</body>
</html>
