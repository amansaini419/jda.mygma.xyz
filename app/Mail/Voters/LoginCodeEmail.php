<?php

namespace App\Mail\Voters;

use App\Models\Voter;
use App\Models\Voting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoginCodeEmail extends Mailable
{
    use Queueable, SerializesModels;

    private Voting $voting;
    /**
     * Create a new message instance.
     */
    public function __construct(
        public Voter $voter,
        public string $loginCode,
    )
    {
        $this->voting = Voting::latest()
                                ->first();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Login Code Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.voters.login-code',
            with: [
				'senderName' => $this->voter->first_name,
				'loginCode' => $this->loginCode,
                'electionStartDate' => $this->voting->start_date,
                'electionEndDate' =>$this->voting->end_date,
			]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
