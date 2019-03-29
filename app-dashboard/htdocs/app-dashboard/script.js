$(document).ready(() => {
	

	$('#documentacao').on('click', () => {
		// $('#pagina').load('documentacao.html')

		$.get('documentacao.html', data => { 
			$('#pagina').html(data)
		})

		// $.post('documentacao.html', data => { 
		// 	$('#pagina').html(data)
		// })


	})


	$('#suporte').on('click', () => {
		// $('#pagina').load('suporte.html')

		$.get('suporte.html', data => { 
			$('#pagina').html(data)
		})

		// $.post('suporte.html', data => { 
		// 	$('#pagina').html(data)
		// })

	})



	//evento de seleção da competencia

	$('#competencia').on('change', e => {
		// método, url, dados, callback-sucesso, callback-erro

		let competencia = $(e.target).val()

		$.ajax({
			type: 'GET',
			url: 'teste1/teste/main2.php',
			data: 'competencia=' + competencia,
			dataType: 'json',
			success: response => {
				console.log(response)
				$('#numVendas').html(response.numVendas)
				$('#totalVendas').html(response.totalVendas)
				$('#totalDespesas').html(response.totalDespesas)
			},
			error: response => {
				console.log(response)
			}
		})
	})

})