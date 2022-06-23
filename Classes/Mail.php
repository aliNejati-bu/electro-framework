<?php

namespace RemoteConfig\Classes;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mail
{

    private static ?Mail $mail = null;

    /**
     * @var array
     */
    private array $mailConfigs = [];

    /**
     * @param Config $config
     */
    public function __construct(public Config $config)
    {
        $this->mailConfigs = $this->config->getAllConfig("mail");
    }

    /**
     * @param array $to
     * @param string $subject
     * @param string $name
     * @param string $body
     * @param string $altBody
     * @param array $filesToSend
     * @return bool
     */
    public function send(array $to, string $subject, string $name, string $body, string $altBody, array $filesToSend = []): bool
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings                    //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = $this->mailConfigs["SMTPHost"];                     //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = $this->mailConfigs["SMTPUserName"];                     //SMTP username
            $mail->Password = $this->mailConfigs["SMTPPassword"];                               //SMTP password
            $mail->SMTPSecure = $this->mailConfigs["SMTPSecure"];            //Enable implicit TLS encryption
            $mail->Port = $this->mailConfigs["SMTPPort"];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            //Recipients
            $mail->setFrom($this->mailConfigs["SMTPUserName"], $name);
            foreach ($to as $email) {
                $mail->addAddress($email);
            }   //Add a recipient
            $mail->addReplyTo($this->mailConfigs["SMTPUserName"], $name);


            //Attachments
            foreach ($filesToSend as $file) {
                $mail->addAttachment($file);
            }

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = $altBody;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @return Mail|null
     */
    public static function getInstance(): ?Mail
    {
        if (is_null(self::$mail)) {
            self::$mail = new self(Config::getInstance());
        }
        return self::$mail;
    }

}