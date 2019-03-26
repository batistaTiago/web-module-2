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