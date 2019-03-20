<?php 

	require '../../task-list-private-files/task.service.php';
	require '../../task-list-private-files/task.model.php';
	require '../../task-list-private-files/dbconnection.php';

	$action = isset($_GET['action']) ? $_GET['action'] : $action;

	if ($action == 'insert') {

		$task = new BTTask();
		$task->__set('description', $_POST['task-description']);

		$connection = new BTDataBaseConnection();

		$service = new BTTaskService($connection, $task);
		$service->insert();

		header('Location: new-task.php?success=true');

	} else if ($action == 'retrieve') {

		$task = new BTTask();
		$connection = new BTDataBaseConnection();

		$service = new BTTaskService($connection, $task);
		$queryResults = $service->retrieve();
	} else if ($action == 'update') {
		// echo '<pre>';
		// print_r($_POST);
		// echo '</pre>';

		$task = new BTTask();
		$task->__set('id', $_POST['id']);
		$task->__set('description', $_POST['task-description']);

		$connection = new BTDataBaseConnection();

		$service = new BTTaskService($connection, $task);
		$updateWasSuccessful = $service->update();

		if ($updateWasSuccessful) {
			header('Location: all-tasks.php');
		}
	} else if ($action == 'remove') {
		
	}
?>