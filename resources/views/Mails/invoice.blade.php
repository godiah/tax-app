<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $invoice->invoice_number }} - Taxgen Consultants</title>
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
                            Invoice {{ $invoice->invoice_number }}
                        </h2>

                        <p style="margin:0 0 16px 0;">Dear {{ $invoice->client_name }},</p>
                        <p style="margin:0 0 16px 0;">
                            Please find attached invoice <strong>{{ $invoice->invoice_number }}</strong>
                            from Taxgen Consultants LLP.
                        </p>

                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                               style="border-collapse:collapse; background-color:#f8f9fa;
                                      border-radius:4px; margin-bottom:24px;">
                            <tr>
                                <td style="padding:11px 16px; border-bottom:1px solid #eee;
                                           font-size:13px; width:40%;">
                                    <strong style="color:#1f3b73;">Invoice Date</strong>
                                </td>
                                <td style="padding:11px 16px; border-bottom:1px solid #eee; font-size:13px;">
                                    {{ $invoice->issue_date->format('d F Y') }}
                                </td>
                            </tr>
                            @if($invoice->due_date)
                                <tr>
                                    <td style="padding:11px 16px; border-bottom:1px solid #eee; font-size:13px;">
                                        <strong style="color:#1f3b73;">Due Date</strong>
                                    </td>
                                    <td style="padding:11px 16px; border-bottom:1px solid #eee; font-size:13px;">
                                        {{ $invoice->due_date->format('d F Y') }}
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td style="padding:11px 16px; font-size:13px;">
                                    <strong style="color:#1f3b73;">Amount Due</strong>
                                </td>
                                <td style="padding:11px 16px; font-size:13px; font-weight:bold; color:#e25822;">
                                    {{ $invoice->currency }} {{ number_format($invoice->total, 2) }}
                                </td>
                            </tr>
                        </table>

                        <p style="margin:0 0 8px 0;">
                            Should you have any questions regarding this invoice, please contact us at
                            (+254) 723-881-440 or info@taxgenconsulting.com.
                        </p>
                        <p style="margin:24px 0 0 0;">Thank you for your business.</p>

                    </td>
                </tr>

                <tr>
                    <td style="padding:0 32px 32px 32px; font-family:Arial,sans-serif;
                               font-size:11px; color:#999; text-align:center;">
                        This is an automated notification from Taxgen Consultants LLP.
                    </td>
                </tr>

                @include('Mails.partials.email-footer')

            </table>

        </td>
    </tr>
</table>

</body>
</html>
