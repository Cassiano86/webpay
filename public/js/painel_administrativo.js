$(function(){
	const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

	$(document).on('click','.btn-danger',function(){
	/*Passando a action dinamicamente para o modal que irá excluir a URl*/
		$('#form_deletar_url').prop('action', $(this).data('href'));
		$('#modalDeletarUrl').modal('show');
	});

	setInterval(function(){
		refresh();
	},60000);

	function refresh(){
		$.ajax({
			url 	 : "/url/refresh",
			method 	 : 'POST' ,
			dataType : 'JSON',
			data 	 : { _token : CSRF_TOKEN },
			timeout  : 10000,
			success  : function(retorno){
				if(retorno.success == 1){
					for(let x = 0; x < parseInt(retorno.status_code.length); x++){
						let status = retorno.status_code[x].status;
						let insert = '';
						
						if(status >= 200 &&  status <= 226){
                            insert = "<span class='text-success font-weight-bold'>"+
                                "<i class='material-icons align-middle'>check</i>"+ status +
                            "</span>";
                        }else if(status >= 400 &&  status <= 451){
                            insert = "<span class='text-danger font-weight-bold'>"+
                                "<i class='material-icons align-middle'>warning</i>"+ status +
                            "</span>";
                        }else if(status >= 500 &&  status <= 511){
                            insert = "<span class='text-warning font-weight-bold'>"+
                                "<i class='material-icons align-middle'>warning</i>"+ status +
                            "</span>";
                        }else{
                        	insert = "<span class='text-warning font-weight-bold'>"+
                                "<i class='material-icons align-middle'>error_outline</i>"+ status +
                            "</span>";
                        }

                        $('#url_'+retorno.status_code[x].id).html(insert);
					}
				}else{
					console.log(JSON.stringify(retorno));
				}
			}
		});
	}
});