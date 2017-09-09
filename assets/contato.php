<?php

// VERIFICAÇÃO DE E-MAIL
function isEmail($email) {
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

if($_POST) {

    // Digite o e-mail onde você deseja receber a mensagem
    $emailTo = 'contato@siscomtech.com.br';

    $clientEmail = addslashes(trim($_POST['email']));
    $subject = addslashes(trim($_POST['subject']));
    $message = addslashes(trim($_POST['message']));

    $array = array('emailMessage' => '', 'subjectMessage' => '', 'messageMessage' => '');

    if(!isEmail($clientEmail)) {
        $array['emailMessage'] = 'E-mail inválido!';
    }
    if($subject == '') {
        $array['subjectMessage'] = 'Campo assunto vazio!';
    }
    if($message == '') {
        $array['messageMessage'] = 'Campo mensagem vazio!';
    }
    if(isEmail($clientEmail) && $subject != '' && $message != '') {
        // Enviar e-mail
		$headers = "From: " . $clientEmail . " <" . $clientEmail . ">" . "\r\n" . "Reply-To: " . $clientEmail;
		mail($emailTo, $subject . " (E-mail do site - Siscomtech)", $message, $headers);
    }

    echo json_encode($array);

}

?>
