<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: Arial, sans-serif; font-size: 12px; color: #333; background: #fff; }
    .page { width: 100%; min-height: 297mm; }
    table.items { width: 100%; border-collapse: collapse; margin-top: 10px; }
    table.items th { background-color: #1f3b73; color: #ffffff; font-size: 10px; text-transform: uppercase;
                     letter-spacing: 0.5px; padding: 8px 10px; text-align: left; }
    table.items th.num, table.items td.num { text-align: right; }
    table.items td { padding: 8px 10px; font-size: 11px; border-bottom: 1px solid #eee; }
    table.items tr:nth-child(even) td { background-color: #f8f9fa; }
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
                <img src="{{ public_path('images/logo-footer.png') }}" alt="Taxgen Consultants LLP" height="56" style="display:block;">
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
                Trio Complex, Off Exit 7, Thika Road, G-03, Nairobi
            </td>
            <td bgcolor="#e25822"
                style="background-color:#e25822; padding:7px 12px; font-family:Arial,sans-serif;
                       font-size:9px; color:#ffffff; vertical-align:middle; text-align:center;">
                (+254) 723-881-440
            </td>
            <td bgcolor="#e25822"
                style="background-color:#e25822; padding:7px 24px 7px 12px; font-family:Arial,sans-serif;
                       font-size:9px; color:#ffffff; vertical-align:middle; text-align:right;">
                info@taxgenconsulting.com
            </td>
        </tr>
    </table>

    {{-- accent divider --}}
    <div style="margin:10px 24px 0 24px; height:1.5px; background-color:#e25822;"></div>

    {{-- ── DOCUMENT META ── --}}
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:16px;">
        <tr>
            <td width="60%" style="padding:0 24px; vertical-align:top;">
                <div style="font-size:9.5px; color:#777; text-transform:uppercase; letter-spacing:0.5px;">Bill To</div>
                <div style="font-size:13px; font-weight:bold; color:#1f3b73; margin-top:3px;">{{ $invoice->client_name }}</div>
                @if($invoice->client_address)
                    <div style="font-size:11px; color:#555; margin-top:2px; white-space:pre-line;">{{ $invoice->client_address }}</div>
                @endif
                <div style="font-size:11px; color:#555; margin-top:2px;">{{ $invoice->client_email }}</div>
                @if($invoice->client_phone)
                    <div style="font-size:11px; color:#555;">{{ $invoice->client_phone }}</div>
                @endif
            </td>
            <td width="40%" style="padding:0 24px; vertical-align:top; text-align:right;">
                <div style="font-size:16px; font-weight:bold; color:#1f3b73; letter-spacing:0.5px;">INVOICE</div>
                <div style="font-size:11px; color:#777; margin-top:6px;">
                    Invoice #: <span style="color:#333; font-weight:bold;">{{ $invoice->invoice_number }}</span>
                </div>
                <div style="font-size:11px; color:#777; margin-top:2px;">
                    Date: <span style="color:#333;">{{ $invoice->issue_date->format('d F Y') }}</span>
                </div>
                @if($invoice->due_date)
                    <div style="font-size:11px; color:#777; margin-top:2px;">
                        Due: <span style="color:#333;">{{ $invoice->due_date->format('d F Y') }}</span>
                    </div>
                @endif
            </td>
        </tr>
    </table>

    {{-- ── ITEMS ── --}}
    <div style="padding:0 24px;">
        <table class="items">
            <thead>
                <tr>
                    <th style="width:50%;">Description</th>
                    <th class="num" style="width:12%;">Qty</th>
                    <th class="num" style="width:19%;">Unit Price</th>
                    <th class="num" style="width:19%;">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->items as $item)
                    <tr>
                        <td>{{ $item->description }}</td>
                        <td class="num">{{ rtrim(rtrim(number_format($item->quantity, 2), '0'), '.') }}</td>
                        <td class="num">{{ number_format($item->unit_price, 2) }}</td>
                        <td class="num">{{ number_format($item->amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Totals --}}
        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:14px;">
            <tr>
                <td width="60%"></td>
                <td width="40%">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="padding:5px 10px; font-size:11px; color:#555;">Subtotal</td>
                            <td style="padding:5px 10px; font-size:11px; color:#333; text-align:right;">
                                {{ $invoice->currency }} {{ number_format($invoice->subtotal, 2) }}
                            </td>
                        </tr>
                        @if($invoice->tax_rate)
                            <tr>
                                <td style="padding:5px 10px; font-size:11px; color:#555;">
                                    Tax ({{ rtrim(rtrim(number_format($invoice->tax_rate, 2), '0'), '.') }}%)
                                </td>
                                <td style="padding:5px 10px; font-size:11px; color:#333; text-align:right;">
                                    {{ $invoice->currency }} {{ number_format($invoice->tax_amount, 2) }}
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td style="padding:8px 10px; font-size:12.5px; font-weight:bold; color:#ffffff;
                                       background-color:#1f3b73;">Total</td>
                            <td style="padding:8px 10px; font-size:12.5px; font-weight:bold; color:#ffffff;
                                       background-color:#1f3b73; text-align:right;">
                                {{ $invoice->currency }} {{ number_format($invoice->total, 2) }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        @if($invoice->notes)
            <div style="margin-top:22px;">
                <div style="font-size:9.5px; color:#777; text-transform:uppercase; letter-spacing:0.5px;">Notes</div>
                <div style="font-size:11px; color:#555; margin-top:4px; line-height:1.6; white-space:pre-line;">{{ $invoice->notes }}</div>
            </div>
        @endif
    </div>

    {{-- ── FOOTER ── --}}
    <div style="margin:24px 24px 0 24px; height:1.5px; background-color:#e25822;"></div>
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
                Thank you for your business
            </td>
        </tr>
    </table>

</div>
</body>
</html>
