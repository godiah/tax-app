{{-- ── EMAIL LETTERHEAD FOOTER ── --}}
{{-- Include at bottom of every email template, inside the 600px wrapper table --}}

{{-- Thin orange line above footer --}}
<tr>
    <td bgcolor="#e25822" style="background-color:#e25822; height:2px; font-size:1px; line-height:1px;">
        &nbsp;
    </td>
</tr>

{{-- Navy footer bar --}}
<tr>
    <td bgcolor="#1f3b73" style="background-color:#1f3b73; padding:0;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
            <tr>
                <td style="padding:14px 24px; vertical-align:middle;
                           font-family:Arial,sans-serif; font-size:9px; color:rgba(255,255,255,0.75);">
                    P.O. Box 78930-00620, Mobile Plaza, Nairobi, Kenya<br>
                    <span style="color:rgba(255,255,255,0.5);">
                        &copy; {{ date('Y') }} Taxgen Consultants LLP. All rights reserved.
                    </span>
                </td>
                <td style="padding:14px 24px 14px 0; vertical-align:middle; text-align:right;">
                    <a href="{{ url('/') }}"
                       style="font-family:Arial,sans-serif; font-size:9px;
                              color:#e25822; text-decoration:none;">
                        Visit Our Website
                    </a>
                </td>
            </tr>
        </table>
    </td>
</tr>
