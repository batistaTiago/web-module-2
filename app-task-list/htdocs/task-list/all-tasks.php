<?php 

	$action = 'retrieve';
	require 'task-manager.php'; 

	// echo '<pre>';
	// print_r($queryResults);
	// echo '</pre>';

?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<script>
			
			function editButtonClick(index, description) {
				
				let form = document.createElement('form');
				form.action = "task-manager.php?action=update"
				form.method = "post"
				form.className = 'row d-flex justify-content-center'

				let descriptionTextField = document.createElement('input');
				descriptionTextField.type = 'text'
				descriptionTextField.name = 'task-description'
				descriptionTextField.className = 'form-control col-9'
				descriptionTextField.value = description

				// objeto escondido input para passar o id da tarefa para o backend 
				// pelo formulario... isto é, se passa através de input
				let hiddenObject = document.createElement('input');
				hiddenObject.value = index
				hiddenObject.name = 'id'
				hiddenObject.type = 'hidden'

				let submitButton = document.createElement('button');
				submitButton.type = 'submit'
				submitButton.className = 'btn btn-info col-3'
				submitButton.innerHTML = 'Atualizar'

				form.appendChild(descriptionTextField)
				form.appendChild(hiddenObject)
				form.appendChild(submitButton)
				
				let taskDiv = document.getElementById('task-' + index)
				taskDiv.innerHTML = ''
				taskDiv.insertBefore(form, taskDiv[0])
				
			}

		</script>
	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
			</div>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-sm-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="index.php">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="new-task.php">Nova tarefa</a></li>
						<li class="list-group-item active"><a href="#">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-sm-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Todas tarefas</h4>
								<hr />

								<!-- recuperar tasks dinamicamente -->

								<? foreach ($queryResults as $idx => $task) { ?>

									<div class="row mb-3 d-flex align-items-center tarefa">

										<div class="col-sm-9" id="task-<?= $task->id ?>">
											<?= $task->tarefa ?> (<?= $task->status ?>)
										</div>
										<div class="col-sm-3 mt-2 d-flex justify-content-between">
											<i class="fas fa-trash-alt fa-lg text-danger"></i>
											<i 
											class="fas fa-edit fa-lg text-info" 
											onclick="editButtonClick(
													 <?=$task->id?>, 
													 '<?=$task->tarefa?>'
													 )"></i>
											<i class="fas fa-check-square fa-lg text-success"></i>
										</div>
									</div>

								<? } ?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>