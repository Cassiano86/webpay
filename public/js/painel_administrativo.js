$(function(){
	const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

	$(document).on('click','.btn-danger',function(){
	/*Passando a action dinamicamente para o modal que irá excluir a URl*/
		$('#form_deletar_url').prop('action', $(this).data('href'));
		$('#modalDeletarUrl').modal('show');
	});

	/*setInterval(function(){
		alert('Funçaõ sendo chamada')
	},60000);*/

	function refresh(){
		$.ajax({
			url 	 : "/url/refresh",
			method 	 : 'POST' ,
			dataType : 'JSON',
			data 	 : { _token : CSRF_TOKEN },
			timeout  : 10000,
			success  : function(retorno){
				if(retorno.success == 1){
					refresh_table(retorno.status_code, retorno.status_code.length)
				}else{
					console.log(JSON.stringify(retorno));
				}
			}
		});
	}

	function refresh_table(status_code, indice){
		alert(status_code + ' ----- ' + indice);
	}
});