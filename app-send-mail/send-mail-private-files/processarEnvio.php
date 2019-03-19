<?php

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	class Message {

		private $targetEmailAddress = null;
		private $messageSubject = null;
		private $messageString = null;
		public $status = ['statusCode' => null, 'statusDescription' => ''];

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
		header('Location: index.php');
	}

	$mail = new PHPMailer(true);
	try {
	    //Server settings
	    $mail->SMTPDebug = false; // desabilita a impressão do log de comunicação com o server
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
	    $newMessage->status['statusCode'] = '1';
	    $newMessage->status['statusDescription'] = 'Sua mensagem foi enviada com sucesso.';
	} catch (Exception $e) {
		$newMessage->status['statusCode'] = '2';
	    $newMessage->status['statusDescription'] = 'Não foi possível enviar sua mensagem. Tente novamente mais tarde.';
	}
?>

<html>
	<head>
		<meta charset="utf-8" />
    	<title>App Mail Send</title>

    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	</head>

	<body>
		<div class="container">
			<div class="py-3 text-center">
				<img class="d-block mx-auto mb-2" src="logo.png" alt="" width="72" height="72">
				<h2>Send Mail</h2>
				<p class="lead">Seu app de envio de e-mails particular!</p>
			</div>

			<div class="row">
				<div class="col-md-12">


					<? if ($newMessage->status['statusCode'] == 1) { ?>

						<div class="container">
							<h1 class="display-4 text-success">Sucesso</h1>
							<p><?= $newMessage->status['statusDescription'] ?></p>
							<a href="index.php" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>
						</div>

					<? } ?>

					<? if ($newMessage->status['statusCode'] == 2) { ?>

						<div class="container">
							<h1 class="display-4 text-danger">Erro</h1>
							<p><?= $newMessage->status['statusDescription'] ?></p>
							<a href="index.php" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>
						</div>

					<? } ?>


				</div>
			</div>
		</div>
	</body>
</html>