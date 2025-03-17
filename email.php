<?php
include_once 'data.php';

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'PHPMailer-master/src/Exception.php';
require_once 'PHPMailer-master/src/PHPMailer.php';
require_once 'PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    function gerarCodigoAleatorio() {
        return str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    $codigo = gerarCodigoAleatorio();

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'stocktrack718@gmail.com';
    $mail->Password = 'etbk bmop ipdi kkfw';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';

    $mail->setFrom('stocktrack718@gmail.com', 'Stock Track');
    $mail->addAddress($_SESSION["usuariol"], 'Usuário que quer fazer o login');

    $mail->isHTML(true);
    $mail->Subject = 'Código de 6 dígitos';
    $mail->Body    = 'Esse é o código da verificação de 2 fatores: <b>' . $codigo . '</b>';
    $_SESSION["codigo"] = $codigo;

    $mail->send();
} catch (Exception $e) {
    echo "<script>window.alert(Erro ao enviar e-mail: {$mail->ErrorInfo})</script>";
}
echo "<script>window.location.href = 'tela-verificacao.php'</script>";
?>