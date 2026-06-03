@extends('layouts.app')

@section('title', 'Email Signature Image — Taxgen Consultants LLP')

@section('content')
<div class="max-w-3xl mx-auto">

    <div class="mb-6">
        <h1 class="font-heading text-2xl font-bold text-primary mb-1">Email Signature Image</h1>
        <p class="font-secondary text-sm text-gray-500">
            Download the letterhead header as a PNG image to use in Gmail, Outlook, or any email client signature.
        </p>
    </div>

    {{-- Instructions --}}
    <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 mb-6 font-secondary text-sm text-blue-800 leading-relaxed">
        <strong>How to use:</strong> Click <em>Download Image</em> below to save the PNG, then go to your email
        client settings &rarr; Signature &rarr; insert the image. It will appear at the top of every email you send.
    </div>

    {{-- Rendered header for capture --}}
    <div class="mb-4">
        <p class="font-secondary text-xs text-gray-400 mb-2 uppercase tracking-wide">Preview</p>

        <div id="signature-capture" style="width:600px; display:inline-block; overflow:hidden; border-radius:0;">

            {{-- Navy bar --}}
            <table width="600" border="0" cellpadding="0" cellspacing="0"
                   style="border-collapse:collapse; background-color:#1f3b73; width:600px;">
                <tr>
                    <td style="padding:18px 24px; vertical-align:middle; width:42%;">
                        <img src="{{ asset('images/logo-footer.png') }}"
                             alt="Taxgen Consultants LLP"
                             height="52"
                             style="display:block; border:0; height:52px;">
                    </td>
                    <td style="padding:18px 24px 18px 0; vertical-align:middle; text-align:right;">
                        <div style="font-family:Georgia,serif; font-size:17px; font-weight:bold;
                                    color:#ffffff; line-height:1.2;">
                            Taxgen Consultants LLP
                        </div>
                        <div style="font-family:Arial,sans-serif; font-size:8px; color:#e25822;
                                    letter-spacing:2px; text-transform:uppercase; margin-top:5px;">
                            Tax &nbsp;&bull;&nbsp; Accounting &nbsp;&bull;&nbsp; Financial Advisory
                        </div>
                    </td>
                </tr>
            </table>

            {{-- Orange contact strip --}}
            <table width="600" border="0" cellpadding="0" cellspacing="0"
                   style="border-collapse:collapse; background-color:#e25822; width:600px;">
                <tr>
                    <td style="padding:7px 24px; font-family:Arial,sans-serif;
                               font-size:9px; color:#ffffff; white-space:nowrap;">
                        Trio Complex, Ground Floor, Garden Estate, Nairobi
                    </td>
                    <td style="padding:7px 12px; font-family:Arial,sans-serif;
                               font-size:9px; color:#ffffff; text-align:center; white-space:nowrap;">
                        (+254) 723-881-440
                    </td>
                    <td style="padding:7px 24px 7px 12px; font-family:Arial,sans-serif;
                               font-size:9px; color:#ffffff; text-align:right; white-space:nowrap;">
                        info@taxgenconsulting.com
                    </td>
                </tr>
            </table>

            {{-- Thin navy bottom line --}}
            <div style="height:3px; background-color:#1f3b73; width:600px;"></div>

        </div>
    </div>

    {{-- Download button --}}
    <div class="flex gap-3 mt-4">
        <button id="btn-download"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white text-sm
                       font-secondary font-medium rounded shadow-sm hover:opacity-90 transition-opacity cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Download PNG
        </button>
        <a href="{{ route('letterheads.preview') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 border border-gray-300 text-gray-600
                  text-sm font-secondary font-medium rounded hover:bg-gray-50 transition-colors">
            &larr; Back to designs
        </a>
    </div>

    {{-- How to install in email clients --}}
    <div class="mt-10 grid md:grid-cols-2 gap-4">

        <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm">
            <h3 class="font-heading text-sm font-semibold text-primary mb-3">Gmail</h3>
            <ol class="font-secondary text-xs text-gray-600 space-y-1.5 list-decimal list-inside leading-relaxed">
                <li>Open Gmail &rarr; Settings (gear icon) &rarr; <em>See all settings</em></li>
                <li>Scroll to <strong>Signature</strong> &rarr; Create or edit a signature</li>
                <li>Click the <strong>Insert image</strong> icon in the toolbar</li>
                <li>Choose <em>Upload</em> and select the PNG you downloaded</li>
                <li>Save changes</li>
            </ol>
        </div>

        <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm">
            <h3 class="font-heading text-sm font-semibold text-primary mb-3">Outlook</h3>
            <ol class="font-secondary text-xs text-gray-600 space-y-1.5 list-decimal list-inside leading-relaxed">
                <li>Go to <strong>File</strong> &rarr; Options &rarr; Mail &rarr; <strong>Signatures</strong></li>
                <li>Create or select a signature</li>
                <li>Click the <strong>Insert Picture</strong> icon</li>
                <li>Browse to the downloaded PNG and insert it</li>
                <li>Click OK and Save</li>
            </ol>
        </div>

    </div>

</div>

{{-- html2canvas from CDN --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
document.getElementById('btn-download').addEventListener('click', function () {
    const btn = this;
    btn.disabled = true;
    btn.textContent = 'Generating…';

    const target = document.getElementById('signature-capture');

    html2canvas(target, {
        scale: 2,           // 2x for retina-quality output
        useCORS: true,
        backgroundColor: null,
        logging: false,
    }).then(function (canvas) {
        const link = document.createElement('a');
        link.download = 'taxgen-email-signature.png';
        link.href = canvas.toDataURL('image/png');
        link.click();

        btn.disabled = false;
        btn.innerHTML = `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
        </svg> Download PNG`;
    });
});
</script>
@endsection
