<?php

use PHPMailer\PHPMailer\PHPMailer;

// MESSAGE & EMAIL CONFIGURATION FOR SCRIPT
class message{
    private $conn;
    public function send_mail($email, $message, $subject){

        $mail = new PHPMailer();
        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "mail.crestlinemb.com"; // Change Email Host
        $mail->SMTPAuth = true;
        $mail->Username = "contact@crestlinemb.com"; // Change Email Address
        $mail->Password = '@SECcrestlinemb1'; // Change Email Password
        $mail->Port = 587; //587
        $mail->SMTPSecure = "ssl"; //tls

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom('contact@crestlinemb.com','Crestline Monument Bank'); // Change
        $mail->addAddress($email);
        $mail->AddReplyTo("contact@crestlinemb.com", "Crestline Monument Bank"); // Change
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->Send();


    }

}


?>