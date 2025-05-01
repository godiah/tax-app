<?php

namespace App\Mail;

use App\Models\Post;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewsletterMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        protected Post $post,
        protected Subscriber $subscriber
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->post->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'Mails.newsletter',
            with: [
                'post' => $this->post,
                'subscriber' => $this->subscriber,
                'blogUrl' => route('blog.show', ['post' => $this->post->slug])
            ]
        );
    }
}
