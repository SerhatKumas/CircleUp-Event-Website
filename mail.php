<?php

    include 'phpmailer.php';
    include 'SMTP.php';
    include 'Exception.php';


    if( $_POST ) {
        $to = $_POST['email'];
        //TODO: validation

        $subject = "Rahat Kaçıran Gün";
        $message ="Merhaba, <br>
        <br>
        Bu maili aldıysan rahatın kaçmış demektir :) Aramıza hoşgeldin kahraman, bizler de seni bekliyorduk :) 🦸‍♀‍🦸‍♂‍<br>
        <br>
        Eğer sen de kalplere iyilik tohumunu ekmeye, çevrende farkındalık yaratarak gününün kahramanı olmaya hazırsan 7 Haziran’da bizimle beraber uçuşa geç!<br>
        <br>
        1 gün boyunca dünya ve kendin adına yaptığın kahramanlık hareketlerini sosyal medya üzerinden paylaş; arkadaşlarına, ailene meydan oku! Bizi (@circleup21) ve onları etiketle, hashtagler at.<br>
        <br>
        Kendi farkındalığının başkalarına ilham olmasına katkı sağla! Aklına neler yapabileceğin gelmiyorsa endişelenme. Aşağıya senin gibi Rahatı Kaçanlar için neler yapabileceğini bıraktık:<br>
        ● Takvimine 7 Haziran 2021 tarihini şimdiden not edebilirsin!
        ● Kendine dünyayı kurtarmak için gerçekleştirebileceğin bir eylem seçebilirsin. Örneğin; 1 gün boyunca tek kullanımlık plastik ürünleri kullanmaktan kaçınabilirsin ya da 1 gün boyunca et tüketmemeyi seçebilirsin.<br>
        ● Ne yapacağını bilmiyorsan ‘’Dünyayı Ben Mi Kurtaracağım-Sosyal Etki Pusulası’’ kitabını alarak kendine bir konu seçebilir veya @circleup21 hesaplarından neler yapabileceğin hakkında fikir edinebilirsin.<br>
        ● Senin için hazırladığımız “Rahatı Kaçanlar-Hazırlık Kitapçığı”nı okumayı unutma.
        ● Senin için resimler, görseller, postlar hazırladık. Tüm dokümanlara bu linkten erişebilir, sosyal medya ve çevrende paylaşabilirsin: https://drive.google.com/drive/folders/1T0RuW3h4xviHXcvObEKvwxjQW9-YIohy?usp=sharing<br> 
        ● Çevre farkındalığını arttırmak, dünyamızı kurtarmak ve iyiliği yaymak isteyen herkesi maceraya davet ederek sesimizin duyulmasına katkıda bulunabilirsin.<br>
        <br>
        Soruların olursa bizlere her zaman tüm sosyal medya platformlarımızdan ulaşabilirsin. Şimdiden paylaşımlarını görmeye sabırsızlanıyoruz !<br>      
        <br>
        Unutma, her şey rahatın kaçınca mümkün!<br>
        #DünyayıBenmiKurtaracağım #RahatıKaçanlarGünü #Herşeyrahatınkaçıncamümkün<br>
        <br>
        Circle Up Ailesi<br>";
        
       $mail = new PHPMailer(true);

       $host = "cmail16.webkontrol.doruk.net.tr";
       $from = "info@circleup21.org";
       $password = "zaiakhkx";

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
           $mail->setFrom('info@circleup21.org', 'Mailer');
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