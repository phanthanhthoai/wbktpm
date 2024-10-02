<?php 
require "../vendor/phpmailer/phpmailer/src/PHPMailer.php";
require "../vendor/phpmailer/phpmailer/src/SMTP.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class MailService {
    function send($to, $subject, $content) {

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';//fix tiếng việt
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'huynhngoctuan48@gmail.com';                      //SMTP username
            $mail->Password   = 'reud gtly tfam smvc';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('admin@gmail.com','Admin');
            $mail->addAddress($to);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $content;

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    function recipient($Emailfrom,$NameForm, $subject, $content) {

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';//fix tiếng việt
        try {
            //Server settings
            $mail->SMTPDebug = 0;                    
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'huynhngoctuan48@gmail.com';                    
            $mail->Password   = 'reud gtly tfam smvc';                               
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
            $mail->Port       = 465;                                   

            //Recipients
            $mail->setFrom($Emailfrom,$NameForm);
            $mail->addAddress('huynhngoctuan48@gmail.com');    

            //Content
            $mail->isHTML(true);                               
            $mail->Subject = $subject;
            $mail->Body    = $content;

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>