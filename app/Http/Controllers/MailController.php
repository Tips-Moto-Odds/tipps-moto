<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Postmark\PostmarkClient;


class MailController extends Controller
{
    public function mail()
    {
        $client = new PostmarkClient('f982460f-3491-4a85-a4ce-6bf0e1fff230');
        $fromEmail = 'mwaurakimani@tipsmoto.co.ke';
        $toEmail = 'mwaurakimani@tipsmoto.co.ke';
        $subject = 'Hello from Postmark';
        $htmlBody = '<strong>Hello</strong> dear Postmark user.';
        $textBody = 'Hello dear Postmark user.';
        $tag = 'example-email-tag';
        $trackOpens = true;
        $trackLinks = 'None';
        $messageStream = 'verification';

        $sendResult = $client->sendEmail(
            $fromEmail,
            $toEmail,
            $subject,
            $htmlBody,
            $textBody,
            $tag,
            $trackOpens,
            NULL, // Reply To
            NULL, // CC
            NULL, // BCC
            NULL, // Header array
            NULL, // Attachment array
            $trackLinks,
            NULL, // Metadata array
            $messageStream
        );

        dd($sendResult);

    }
}

