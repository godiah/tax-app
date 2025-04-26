<?php

namespace App\Services;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\MarkdownConverter;

class MarkdownService
{
    protected MarkdownConverter $converter;

    public function __construct()
    {
        $environment = new Environment([
            'html_input'        => 'strip',
            'allow_unsafe_links' => false,
        ]);
        $environment->addExtension(new CommonMarkCoreExtension());
        $this->converter = new MarkdownConverter($environment);
    }

    /**
     * Convert raw Markdown to HTML.
     */
    public function toHtml(string $markdown): string
    {
        return (string) $this->converter->convert($markdown);
    }
}
