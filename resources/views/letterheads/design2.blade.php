<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: Arial, sans-serif; font-size: 12px; color: #424242; background: #fff; }
    .page { width: 100%; min-height: 297mm; }
</style>
</head>
<body>
<div class="page">

    {{-- ── HEADER: orange top bar ── --}}
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
        <tr>
            <td bgcolor="#e25822"
                style="background-color:#e25822; height:5px; font-size:1px; line-height:1px;">
                &nbsp;
            </td>
        </tr>
    </table>

    {{-- logo | brand | contacts --}}
    <table width="100%" border="0" cellpadding="0" cellspacing="0"
           style="border-collapse:collapse; padding:0 28px;">
        <tr>
            <td width="110" style="padding:18px 16px 14px 28px; vertical-align:middle;">
                <img src="{{ $logo }}" alt="Taxgen Consultants LLP" height="52" style="display:block;">
            </td>
            <td style="padding:18px 20px 14px 16px; vertical-align:middle;
                       border-left:2px solid #e5e5e5;">
                <div style="font-family:Georgia,serif; font-size:17px; font-weight:bold; color:#1f3b73;">
                    Taxgen Consultants LLP
                </div>
                <div style="font-size:7.5px; color:#e25822; letter-spacing:2.5px;
                            text-transform:uppercase; margin-top:4px; font-family:Arial,sans-serif;">
                    Tax &nbsp;&bull;&nbsp; Accounting &nbsp;&bull;&nbsp; Financial Advisory
                </div>
            </td>
            <td style="padding:18px 28px 14px 12px; vertical-align:middle; text-align:right;">
                <div style="font-family:Arial,sans-serif; font-size:9px; color:#666; line-height:1.9;">
                    <strong style="color:#1f3b73;">Phone:</strong> (+254) 723-881-440
                </div>
                <div style="font-family:Arial,sans-serif; font-size:9px; color:#666; line-height:1.9;">
                    <strong style="color:#1f3b73;">Email:</strong> info@taxgenconsulting.com
                </div>
                <div style="font-family:Arial,sans-serif; font-size:9px; color:#666; line-height:1.9;">
                    <strong style="color:#1f3b73;">Office:</strong> Trio Complex, G-03, Thika Road
                </div>
            </td>
        </tr>
    </table>

    {{-- navy divider --}}
    <div style="margin:0 28px; height:1.5px; background-color:#1f3b73;"></div>

    {{-- accent divider --}}
    <div style="margin:10px 28px 0 28px; height:1px; background-color:#e25822;"></div>

    {{-- ── BODY ── --}}
    <div style="padding:22px 28px; min-height:175mm; font-family:Arial,sans-serif;
                font-size:11.5px; line-height:1.9; color:#333;">
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
    <div style="margin:0 28px; height:1px; background-color:#e0e0e0;"></div>
    <table width="100%" border="0" cellpadding="0" cellspacing="0"
           style="border-collapse:collapse; margin-top:0;">
        <tr>
            <td style="padding:10px 28px; font-family:Arial,sans-serif; font-size:9px; color:#aaa; vertical-align:middle;">
                P.O. Box 78930-00620, Mobile Plaza, Nairobi
            </td>
            <td style="padding:10px 12px; font-family:Arial,sans-serif; font-size:10px;
                       font-weight:bold; color:#1f3b73; vertical-align:middle; text-align:center;">
                Taxgen Consultants LLP
            </td>
            <td style="padding:10px 28px 10px 12px; font-family:Arial,sans-serif; font-size:9px;
                       color:#aaa; vertical-align:middle; text-align:right;">
                www.taxgenconsulting.com
            </td>
        </tr>
    </table>

    {{-- navy bottom bar --}}
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
        <tr>
            <td bgcolor="#1f3b73"
                style="background-color:#1f3b73; height:5px; font-size:1px; line-height:1px;">
                &nbsp;
            </td>
        </tr>
    </table>

</div>
</body>
</html>
