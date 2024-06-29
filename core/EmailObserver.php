<?php

namespace Core;

use MailerSend\MailerSend;
use MailerSend\Helpers\Builder\Recipient;
use MailerSend\Helpers\Builder\EmailParams;

class EmailObserver implements ObserverInterface
{
    public function update($message)
    {
        $mailersend = new MailerSend();

        $recipients = [
            new Recipient('your@client.com', 'Your Client'),
        ];

        $emailParams = (new EmailParams())
            ->setFrom('your@domain.com')
            ->setFromName('Your Name')
            ->setRecipients($recipients)
            ->setSubject('Subject')
            ->setHtml('This is the HTML content')
            ->setText('This is the text content')
            ->setReplyTo('reply to')
            ->setReplyToName('reply to name');

        $mailersend->email->send($emailParams);
    }
}
