<?php

	require 'libs/phpmail/Exception.php';
	require 'libs/phpmail/OAuth.php';
	require 'libs/phpmail/PHPMailer.php';
	require 'libs/phpmail/POP3.php';
	require 'libs/phpmail/SMTP.php';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	class Message {

		private $targetEmailAddress = null;
		private $messageSubject = null;
		private $messageString = null;

		public function __get($attribute) {
			return $this->$attribute;
		}

		public function __set($attribute, $value) {
			$this->$attribute = $value;
		}

		public function isValid() {
			return (!empty($this->targetEmailAddress) AND 
				   !empty($this->targetEmailAddress) AND 
				   !empty($this->targetEmailAddress));
		}
	}

	$newMessage = new Message();
	$newMessage->__set('targetEmailAddress', $_POST['targetEmailAddress']);
	$newMessage->__set('messageSubject', $_POST['messageSubject']);
	$newMessage->__set('messageString', $_POST['messageString']);

	if (!$newMessage->isValid()) {
		echo "<script> alert('invalido') </script>";
		die();
	}

	$mail = new PHPMailer(true);
	try {
	    //Server settings
	    $mail->SMTPDebug = 2;
	    $mail->isSMTP();
	    $mail->Host = 'smtp.gmail.com';
	    $mail->SMTPAuth = true;
	    $mail->Username = 'python.email.smtp.modules@gmail.com';
	    $mail->Password = 'testingPythonModules!';
	    $mail->SMTPSecure = 'tls';
	    $mail->Port = 587;

	    //Recipients
	    $mail->setFrom('python.email.smtp.modules@gmail.com', 'WebMail PHP');
	    $mail->addAddress($newMessage->__get('targetEmailAddress'));
	    // $mail->addReplyTo('info@example.com', 'Information');
	    // $mail->addCC('cc@example.com');
	    // $mail->addBCC('bcc@example.com');

	    //Attachments
	    // $mail->addAttachment('/var/tmp/file.tar.gz');
	    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');

	    //Content
	    $mail->isHTML(true);
	    $mail->Subject = $newMessage->__get('messageSubject');
	    $mail->Body    = $newMessage->__get('messageString');
	    $mail->AltBody = 'Use um cliente com HTML habilitado para ver o conteúdo desta mensagem.';

	    $mail->send();
	    echo 'Message has been sent';
	} catch (Exception $e) {
    	echo 'O email não pôde ser enviado.';
    	echo 'Detalhes do erro: ' . $mail->ErrorInfo;
	}