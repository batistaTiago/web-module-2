<?php

	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
	
	$stringDivider = '##';

	$issueTitle = str_replace($stringDivider, '-', $_POST['issueTitle']);
	$issueCategory = str_replace($stringDivider, '-', $_POST['issueCategory']);
	$issueDescription = str_replace($stringDivider, '-', $_POST['issueDescription']);

	$issueData = $issueTitle . $stringDivider . 
				 $issueCategory . $stringDivider . $_issueDescription . PHP_EOL; 

	// abrir arquivo com parametro a (escrita e cursor no fim)
	// retorna a referencia de arquivo aberto
	// ver docs em www.php.net
	$fileReference = fopen('file.hdesk', 'a');

	// escreve os dados
	fwrite($fileReference, $issueData);

	// fecha o arquivo
	fclose($fileReference);

	// redireciona para a tela de abrir chamado
	header('Location: abrir-chamado.php');

?>