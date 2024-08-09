<?php
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require './lib/vendor/autoload.php';

// Função para enviar o e-mail com a senha temporária
function enviarEmail($email, $senha_aleatoria) {
    $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                           //Enable verbose debug output
    $mail->isSMTP();                                                //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                          //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                     //Enable SMTP authentication
    $mail->Username   = 'sistemasweb1.teste@gmail.com';          //SMTP username
    $mail->Password   = 'xpjqaaoavetkgvea';                     //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                                 //Enable implicit TLS encryption
    $mail->Port       = '587';                                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

       //Recipients
        $mail->setFrom('sistemasweb1.teste@gmail.com', 'Web1 Teste');
        $mail->addAddress($email);     //Add a recipient

        //Content
        $mail->isHTML(true);                                       //Set email format to HTML
        $mail->Subject = 'Cadastro realizado com sucesso';
        $mail->Body    = '<h1>Olá, aqui está o link e sua senha temporária para login!</h1>';
        $mail->Body   .= '<p>Sua senha temporária é: ' . $senha_aleatoria . '</p>';
        $mail->Body   .= '<p>Clique no link abaixo para fazer login:</p>';
        $mail->Body   .= '<a href="http://localhost/Sites/Sistema_de_Acesso_Privado/login.php">Fazer Login</a>';

        // Send the email
        $mail->send();
        echo 'E-mail de cadastro enviado com sucesso! Verifique seu e-mail para obter a senha temporária.';
    } catch (Exception $e) {
        echo "Erro ao enviar o e-mail: {$mail->ErrorInfo}";
    }
}
