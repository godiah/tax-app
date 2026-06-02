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

    {{-- ── TOP ACCENT BAR (orange) ── --}}
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
        <tr>
            <td bgcolor="#e25822"
                style="background-color:#e25822; height:7px; font-size:1px; line-height:1px;">
                &nbsp;
            </td>
        </tr>
    </table>

    {{-- ── SPLIT HEADER: dark navy sidebar | light panel ── --}}
    <table width="100%" border="0" cellpadding="0" cellspacing="0"
           style="border-collapse:collapse;">
        <tr>
            {{-- Dark navy logo panel --}}
            <td width="30%" bgcolor="#1a3060"
                style="background-color:#1a3060; padding:26px 18px; vertical-align:middle; text-align:center;">
                <img src="{{ $logo }}" alt="Taxgen Consultants LLP" height="60" style="display:block; margin:0 auto;">
            </td>
            {{-- Company details panel --}}
            <td bgcolor="#f7f8fc"
                style="background-color:#f7f8fc; padding:22px 24px;
                       vertical-align:middle; border-bottom:3px solid #1f3b73;">
                <div style="font-family:Georgia,serif; font-size:20px; font-weight:bold;
                            color:#1a3060; line-height:1.2;">
                    Taxgen Consultants LLP
                </div>
                <div style="font-family:Arial,sans-serif; font-size:7.5px; color:#e25822;
                            letter-spacing:2.5px; text-transform:uppercase; font-weight:bold;
                            margin-top:6px; margin-bottom:12px;">
                    Tax &nbsp;&bull;&nbsp; Accounting &nbsp;&bull;&nbsp; Financial Advisory
                </div>
                <div style="font-family:Arial,sans-serif; font-size:9.5px; color:#555; line-height:1.85;">
                    <span style="color:#1a3060; font-weight:bold;">Tel:</span> (+254) 723-881-440 &nbsp;&nbsp;
                    <span style="color:#1a3060; font-weight:bold;">Email:</span> info@taxgenconsulting.com
                </div>
                <div style="font-family:Arial,sans-serif; font-size:9.5px; color:#555; margin-top:3px;">
                    <span style="color:#1a3060; font-weight:bold;">Office:</span>
                    Trio Complex, Ground Floor, Garden Estate, Nairobi &nbsp;&mdash;&nbsp;
                    <span style="color:#1a3060; font-weight:bold;">P.O. Box:</span> 78930-00620
                </div>
            </td>
        </tr>
    </table>

    {{-- accent divider --}}
    <div style="margin:12px 24px 0 24px; height:1.5px; background-color:#e25822;"></div>

    {{-- ── BODY ── --}}
    <div style="padding:22px 24px; min-height:170mm; font-family:Arial,sans-serif;
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
    <table width="100%" border="0" cellpadding="0" cellspacing="0"
           style="border-collapse:collapse; margin-top:0;">
        <tr>
            <td bgcolor="#1a3060"
                style="background-color:#1a3060; padding:11px 24px; font-family:Arial,sans-serif;
                       font-size:9px; color:#ffffff; vertical-align:middle;">
                P.O. Box 78930-00620, Mobile Plaza, Nairobi, Kenya
            </td>
            <td bgcolor="#1a3060"
                style="background-color:#1a3060; padding:11px 12px; font-family:Arial,sans-serif;
                       font-size:10px; font-weight:bold; color:#ffffff; vertical-align:middle; text-align:center;">
                Taxgen Consultants LLP
            </td>
            <td bgcolor="#1a3060"
                style="background-color:#1a3060; padding:11px 24px 11px 12px; font-family:Arial,sans-serif;
                       font-size:9px; color:rgba(255,255,255,0.65); vertical-align:middle; text-align:right;">
                Confidential &mdash; For addressee only
            </td>
        </tr>
    </table>

    {{-- orange bottom bar --}}
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
        <tr>
            <td bgcolor="#e25822"
                style="background-color:#e25822; height:5px; font-size:1px; line-height:1px;">
                &nbsp;
            </td>
        </tr>
    </table>

</div>
</body>
</html>
