<?php

require_once '../vendor/composer.json';

try {

// Create the Transport
    $transport = (new Swift_SmtpTransport('smtp.mail.ru', 465, 'ssl'))
        ->setUsername('creepy.creep@bk.ru')
        ->setPassword('2ead2c602c8b8480865a0d94d8718037')
    ;

// Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

// Create a message
    $message = (new Swift_Message('Wonderful Subject'))
        ->setFrom(['creepy.creep@bk.ru' => 'creepy.creep@bk.ru'])
        ->setTo(['force6@mail.ru'])
        ->setBody('Here is the message itself')
        ->attach(Swift_Attachment::fromPath('test.php'))
    ;

// Send the message
    $result = $mailer->send($message);
    var_dump(['res' => $result]);
} catch (Exception $e) {
    var_dump($e->getMessage());
    echo '<pre>' . print_r($e->getTrace(), 1);
}
