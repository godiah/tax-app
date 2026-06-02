@props(['title' => 'Official Correspondence', 'date' => null, 'reference' => null])

<style>
    @media print {
        .no-print { display: none !important; }
        body { margin: 0; padding: 0; }
        .letterhead-page { box-shadow: none !important; border: none !important; }
        @page { size: A4; margin: 0; }
    }
</style>

<div class="letterhead-page bg-white mx-auto shadow-lg"
     style="width: 210mm; min-height: 297mm; padding: 0; font-family: 'Georgia', serif; color: #333;">

    {{-- ===== HEADER ===== --}}
    <div style="background-color: #1f3b73; padding: 24px 32px 0 32px;">
        <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 20px;">

            {{-- Logo --}}
            <div>
                <img src="{{ asset('images/logo-footer.png') }}" alt="Taxgen Consultants LLP"
                     style="height: 72px; width: auto; display: block;">
            </div>

            {{-- Company Name & Tagline --}}
            <div style="text-align: right;">
                <div style="color: #ffffff; font-size: 22px; font-weight: 700; letter-spacing: 0.5px; font-family: 'Georgia', serif;">
                    Taxgen Consultants LLP
                </div>
                <div style="color: #e25822; font-size: 11px; letter-spacing: 2px; text-transform: uppercase; margin-top: 4px; font-family: Arial, sans-serif;">
                    Tax &bull; Accounting &bull; Financial Advisory
                </div>
            </div>
        </div>

        {{-- Contact strip --}}
        <div style="background-color: #e25822; margin: 0 -32px; padding: 8px 32px;
                    display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 4px;">
            <span style="color: #fff; font-size: 10.5px; font-family: Arial, sans-serif;">
                &#9679; Trio Complex, Ground Floor, Garden Estate, Nairobi
            </span>
            <span style="color: #fff; font-size: 10.5px; font-family: Arial, sans-serif;">
                &#128222; (+254) 723-881-440
            </span>
            <span style="color: #fff; font-size: 10.5px; font-family: Arial, sans-serif;">
                &#9993; info@taxgenconsulting.com
            </span>
        </div>
    </div>

    {{-- ===== DOCUMENT META ===== --}}
    <div style="padding: 20px 32px 0 32px; display: flex; justify-content: space-between; align-items: flex-start; font-family: Arial, sans-serif; font-size: 11.5px; color: #555;">
        <div>
            @if($title)
                <div style="font-size: 13px; font-weight: 700; color: #1f3b73; text-transform: uppercase; letter-spacing: 0.5px;">
                    {{ $title }}
                </div>
            @endif
            @if($reference)
                <div style="margin-top: 2px; color: #777;">Ref: {{ $reference }}</div>
            @endif
        </div>
        <div style="text-align: right;">
            <div style="color: #777;">Date:</div>
            <div style="font-weight: 600; color: #333;">{{ $date ?? \Carbon\Carbon::now()->format('d F Y') }}</div>
        </div>
    </div>

    {{-- Thin accent divider --}}
    <div style="margin: 12px 32px 0 32px; height: 2px; background: linear-gradient(to right, #1f3b73, #e25822);"></div>

    {{-- ===== BODY / SLOT ===== --}}
    <div style="padding: 24px 32px; min-height: 180mm; font-family: Arial, sans-serif; font-size: 12px; line-height: 1.8; color: #333;">
        {{ $slot }}
    </div>

    {{-- ===== FOOTER ===== --}}
    <div style="margin-top: auto;">
        <div style="margin: 0 32px; height: 2px; background: linear-gradient(to right, #e25822, #1f3b73);"></div>
        <div style="background-color: #1f3b73; padding: 14px 32px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 6px;">
            <div style="color: #fff; font-size: 9.5px; font-family: Arial, sans-serif;">
                P.O. Box 78930-00620, Mobile Plaza, Nairobi, Kenya
            </div>
            <div style="color: #e25822; font-size: 9.5px; font-family: Arial, sans-serif; font-weight: 600;">
                Taxgen Consultants LLP
            </div>
            <div style="color: #fff; font-size: 9.5px; font-family: Arial, sans-serif; opacity: 0.75;">
                Confidential &mdash; For addressee only
            </div>
        </div>
    </div>
</div>
