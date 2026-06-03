<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission - Taxgen Consultants</title>
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

                        <h2 style="margin:0 0 20px 0; font-size:18px; color:#1f3b73;
                                   border-bottom:2px solid #e25822; padding-bottom:10px;">
                            New Contact Form Submission
                        </h2>

                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                               style="border-collapse:collapse; background-color:#f8f9fa;
                                      border-radius:4px; margin-bottom:24px;">
                            <tr>
                                <td style="padding:11px 16px; border-bottom:1px solid #eee;
                                           font-size:13px; width:30%;">
                                    <strong style="color:#1f3b73;">Name</strong>
                                </td>
                                <td style="padding:11px 16px; border-bottom:1px solid #eee; font-size:13px;">
                                    {{ $details['name'] }}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:11px 16px; border-bottom:1px solid #eee; font-size:13px;">
                                    <strong style="color:#1f3b73;">Email</strong>
                                </td>
                                <td style="padding:11px 16px; border-bottom:1px solid #eee; font-size:13px;">
                                    <a href="mailto:{{ $details['email'] }}"
                                       style="color:#e25822; text-decoration:none;">
                                        {{ $details['email'] }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:11px 16px; font-size:13px;">
                                    <strong style="color:#1f3b73;">Phone</strong>
                                </td>
                                <td style="padding:11px 16px; font-size:13px;">
                                    {{ $details['phone'] ?? 'N/A' }}
                                </td>
                            </tr>
                        </table>

                        <p style="margin:0 0 8px 0; font-size:13px; font-weight:bold; color:#1f3b73;">
                            Message:
                        </p>
                        <div style="background-color:#f8f9fa; padding:16px; font-size:13px;
                                    color:#555; line-height:1.7; border-left:3px solid #e25822;">
                            {{ $details['message'] }}
                        </div>

                        <div style="margin-top:28px; text-align:center;">
                            <a href="mailto:{{ $details['email'] }}"
                               style="display:inline-block; background-color:#e25822; color:#ffffff;
                                      padding:12px 28px; text-decoration:none; font-size:13px;
                                      font-weight:bold; border-radius:3px;">
                                Reply to {{ $details['name'] }}
                            </a>
                        </div>

                    </td>
                </tr>

                <tr>
                    <td style="padding:0 32px 32px 32px; font-family:Arial,sans-serif;
                               font-size:11px; color:#999; text-align:center;">
                        This is an automated notification from the Taxgen Consultants contact form.
                    </td>
                </tr>

                @include('Mails.partials.email-footer')

            </table>

        </td>
    </tr>
</table>

</body>
</html>
