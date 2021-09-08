<?php

    include 'phpmailer.php';
    include 'SMTP.php';
    include 'Exception.php';


    if( $_POST ) {
        $to = $_POST['email'];
        //TODO: validation

        $subject = "Subject of the mail";
        $message ="Message that you want to send with e-mail ";
        
       $mail = new PHPMailer(true);

       $host = "host";
       $from = "yourmail";
       $password = "password of your mail";

       try {
           //Server settings
           //$mail->SMTPDebug =  SMTP::DEBUG_SERVER;                      //Enable verbose debug output
           $mail->isSMTP();                                            //Send using SMTP
           $mail->Host       = $host;                     //Set the SMTP server to send through
           $mail->SMTPAuth   = true;                                  //Enable SMTP authentication
           $mail->Username   = $from;                     //SMTP username
           $mail->Password   = $password;                               //SMTP password
           $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
           $mail->Port       = 587;                                 //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
           $mail->CharSet = 'UTF-8';
       
           //Recipients
           $mail->setFrom('your mail', 'Mailer');
           $mail->addAddress($to);               //Name is optional
           $mail->addReplyTo('info@example.com', 'Information');
       
           //Attachments
           //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
           //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
       
           //Content
           $mail->isHTML(true);                                  //Set email format to HTML
           $mail->Subject = $subject;
           $mail->Body    = $message;
       
           $mail->send();
           echo 'Message has been sent';
           file_put_contents('./recordedmails/email_log'.date("Y-m-d").'.txt', $to.'/n',FILE_APPEND);

       } catch (Exception $e) {
           echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
       }

    }

header("Location: thank-you.html");