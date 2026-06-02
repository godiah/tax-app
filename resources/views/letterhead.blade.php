<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Letterhead &mdash; Taxgen Consultants LLP</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background: #f0f0f0; }
        @media print {
            body { background: #fff; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body class="py-8">

    {{-- Print / Back controls --}}
    <div class="no-print flex justify-center gap-4 mb-6">
        <a href="{{ url()->previous() }}"
           class="px-4 py-2 text-sm bg-white border border-gray-300 rounded shadow-sm hover:bg-gray-50 transition-colors font-secondary text-gray-700">
            &larr; Back
        </a>
        <button onclick="window.print()"
                class="px-5 py-2 text-sm bg-primary text-white rounded shadow-sm hover:bg-primary-hover transition-colors font-secondary">
            Print / Save as PDF
        </button>
    </div>

    <x-letterhead title="Official Correspondence" :date="now()->format('d F Y')">

        {{-- Sample letter body — replace or make dynamic as needed --}}
        <p style="margin-bottom: 16px;">Dear Sir / Madam,</p>

        <p style="margin-bottom: 16px;">
            We write to you on behalf of <strong>Taxgen Consultants LLP</strong> regarding the above-referenced matter.
            Please find herein the details as discussed during our previous engagement.
        </p>

        <p style="margin-bottom: 16px;">
            Should you require any clarification or additional information, do not hesitate to contact our office
            at <strong>(+254) 723-881-440</strong> or via email at <strong>info@taxgenconsulting.com</strong>.
        </p>

        <p style="margin-bottom: 40px;">We look forward to your continued engagement.</p>

        <p>Yours faithfully,</p>
        <br>
        <p style="margin-top: 32px; border-top: 1px solid #ccc; padding-top: 8px; width: 200px;">
            <strong>Duncan Gateru</strong><br>
            <span style="color: #555; font-size: 11px;">Managing Partner, Taxgen Consultants LLP</span>
        </p>

    </x-letterhead>

</body>
</html>
