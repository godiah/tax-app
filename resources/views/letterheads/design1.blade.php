<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: Arial, sans-serif; font-size: 12px; color: #333; background: #fff; }
    .page { width: 100%; min-height: 297mm; }
</style>
</head>
<body>
<div class="page">

    {{-- ── HEADER: navy bar ── --}}
    <table width="100%" border="0" cellpadding="0" cellspacing="0"
           style="border-collapse:collapse; background-color:#1f3b73;">
        <tr>
            <td width="36%" bgcolor="#1f3b73"
                style="background-color:#1f3b73; padding:20px 24px 16px 24px; vertical-align:middle;">
                <img src="{{ $logo }}" alt="Taxgen Consultants LLP" height="56" style="display:block;">
            </td>
            <td bgcolor="#1f3b73"
                style="background-color:#1f3b73; padding:20px 24px 16px 0; vertical-align:middle; text-align:right;">
                <div style="font-family:Georgia,serif; font-size:19px; font-weight:bold; color:#ffffff; letter-spacing:0.3px;">
                    Taxgen Consultants LLP
                </div>
                <div style="font-family:Arial,sans-serif; font-size:8px; color:#e25822; letter-spacing:2.5px;
                            text-transform:uppercase; margin-top:5px;">
                    Tax &nbsp;&bull;&nbsp; Accounting &nbsp;&bull;&nbsp; Financial Advisory
                </div>
            </td>
        </tr>
    </table>

    {{-- contact strip (orange) --}}
    <table width="100%" border="0" cellpadding="0" cellspacing="0"
           style="border-collapse:collapse; background-color:#e25822;">
        <tr>
            <td bgcolor="#e25822"
                style="background-color:#e25822; padding:7px 24px; font-family:Arial,sans-serif;
                       font-size:9px; color:#ffffff; vertical-align:middle;">
                &#9679; Trio Complex, Ground Floor, Garden Estate, Nairobi
            </td>
            <td bgcolor="#e25822"
                style="background-color:#e25822; padding:7px 12px; font-family:Arial,sans-serif;
                       font-size:9px; color:#ffffff; vertical-align:middle; text-align:center;">
                &#128222; (+254) 723-881-440
            </td>
            <td bgcolor="#e25822"
                style="background-color:#e25822; padding:7px 24px 7px 12px; font-family:Arial,sans-serif;
                       font-size:9px; color:#ffffff; vertical-align:middle; text-align:right;">
                &#9993; info@taxgenconsulting.com
            </td>
        </tr>
    </table>

    {{-- accent divider --}}
    <div style="margin:10px 24px 0 24px; height:1.5px; background-color:#e25822;"></div>

    {{-- ── BODY ── --}}
    <div style="padding:22px 24px; min-height:175mm; font-family:Arial,sans-serif;
                font-size:11.5px; line-height:1.85; color:#333;">
        {!! $body ?? '
            <p>Dear Sir / Madam,</p><br>
            <p>We write to you on behalf of Taxgen Consultants LLP regarding the above-referenced matter.
            Please find herein the details as discussed during our previous engagement.</p><br>
            <p>Should you require any clarification, contact us at (+254) 723-881-440 or
            info@taxgenconsulting.com.</p><br>
            <p>We look forward to your continued engagement.</p>
        ' !!}
    </div>

    {{-- ── FOOTER ── --}}
    <div style="margin:0 24px; height:1.5px; background-color:#e25822;"></div>
    <table width="100%" border="0" cellpadding="0" cellspacing="0"
           style="border-collapse:collapse; background-color:#1f3b73; margin-top:0;">
        <tr>
            <td bgcolor="#1f3b73"
                style="background-color:#1f3b73; padding:11px 24px; font-family:Arial,sans-serif;
                       font-size:9px; color:#ffffff; vertical-align:middle;">
                P.O. Box 78930-00620, Mobile Plaza, Nairobi, Kenya
            </td>
            <td bgcolor="#1f3b73"
                style="background-color:#1f3b73; padding:11px 12px; font-family:Arial,sans-serif;
                       font-size:10px; font-weight:bold; color:#e25822; vertical-align:middle; text-align:center;">
                Taxgen Consultants LLP
            </td>
            <td bgcolor="#1f3b73"
                style="background-color:#1f3b73; padding:11px 24px 11px 12px; font-family:Arial,sans-serif;
                       font-size:9px; color:rgba(255,255,255,0.65); vertical-align:middle; text-align:right;">
                Confidential &mdash; For addressee only
            </td>
        </tr>
    </table>

</div>
</body>
</html>
