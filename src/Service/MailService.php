<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailService{

    
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMail(string $from,string $message,string $subject){
        
        $email = (new Email())
        ->from($from)
        ->to("vincentremy222@gmail.com")
        ->subject($subject)
        ->text($message);
        
        $this->mailer->send($email);
    }
}