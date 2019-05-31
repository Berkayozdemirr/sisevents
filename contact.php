<?php
function isValidEmail($eposta){ 
    return filter_var($eposta, FILTER_VALIDATE_EMAIL) !== false;
}

if ( $_POST ){

    $adsoyad = htmlspecialchars(trim($_POST['adsoyad']));
    $eposta = htmlspecialchars(trim($_POST['eposta']));
    $telefon = htmlspecialchars(trim($_POST['telefon']));
    $mesaj = htmlspecialchars(trim($_POST['mesaj']));

    $html = 'Ad Soyad: '.$adsoyad.'<br />';
    $html .= 'Email Adresi: '.$eposta.'<br />';
    $html .= 'Telefon: '.$telefon.'<br />';
    $html .= 'Mesaj: '.$mesaj.'<br />';

    if(!isValidEmail($eposta)) {
        echo '<div class="error">Lütfen geçerli bir eposta adresi girin!</div>';
        exit;
    }

    if(!preg_match("/^([a-zA-Z' ]+)$/",$adsoyad) || strlen($adsoyad)<3) {
        echo '<div class="error">Lütfen adınızı soyadınızı kontrol edin!</div>';
        exit;
    }

    if(strlen($mesaj)<10) {
        echo '<div class="error">Lütfen mesaj alanını en az 10 karakter olacak şekilde doldurun!</div>';
        exit;
    } 

    include 'class.phpmailer.php';
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = 'mail.shineflowergift.com';
    $mail->Port = 587;
    // $mail->SMTPSecure = 'tls';
    $mail->Username = 'noreply@shineflowergift.com';
    $mail->Password = 'MXtv42U8';
    $mail->SetFrom($mail->Username, 'Shine Flower Gift');
    $mail->AddAddress('info@shineflowergift.com', $adsoyad);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = 'Shine Flower - Sitenizden Mesaj Var!';
    $content = '<div style="background: #eee; padding: 10px; font-size: 14px">'.$html.'</div>';
    $mail->MsgHTML($content);
    if($mail->Send()) {
        // e-posta başarılı ile gönderildi
        echo 'true';
        exit;
    } else {
        // bir sorun var, sorunu ekrana bastıralım
        echo '<div class="error">'.$mail->ErrorInfo.'</div>';
        exit;
    }

}

?> 
