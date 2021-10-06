$(function(){
	const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

	$(document).on('click','.btn-danger',function(){
	/*Passando a action dinamicamente para o modal que irá excluir a URl*/
		$('#form_deletar_url').prop('action', $(this).data('href'));
		$('#modalDeletarUrl').modal('show');
	});

	setInterval(function(){
		$('#carregamento').removeClass('d-none');
		refresh();
	},30000);

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
                        /*Inserindo os novos dados de acesso e número de acessos dentro da tabela*/

                        /*Aplicando o status code dinamicamente*/
                        $('#url_'+retorno.status_code[x].id).html(retornarStatus(retorno.status_code[x].status));

                        /*Habilitando / inabilitando url de acordo com a resposta*/
						desabilitarURL(retorno.status_code[x].status, retorno.status_code[x].id);
					}

					$('#carregamento').addClass('d-none');
				}else{
					console.log(JSON.stringify(retorno));
				}
			}
		});
	}

	function retornarStatus(status){
		/*Personificando o modelo da resposta*/
		if(status >= 200 &&  status <= 226){
            return "<span class='text-success font-weight-bold'>"+
                		"<i class='material-icons align-middle'>check</i>"+ status +
            		 "</span>";
        }else if(status >= 300 &&  status <= 308){
        	return "<span class='text-info font-weight-bold'>"+
                		"<i class='material-icons align-middle'>warning</i>"+ status +
            		 "</span>";
        }else if(status >= 400 &&  status <= 451){
            return "<span class='text-danger font-weight-bold'>"+
                		"<i class='material-icons align-middle'>warning</i>"+ status +
            		 "</span>";
        }else if(status >= 500 &&  status <= 511){
            return "<span class='text-warning font-weight-bold'>"+
                		"<i class='material-icons align-middle'>warning</i>"+ status +
            		 "</span>";
        }else{
        	return "<span class='text-warning font-weight-bold'>"+
                		"<i class='material-icons align-middle'>watch_later</i> Sem resposta</span>";
        }
	}

	function desabilitarURL(status, id){
		if(status >= 200 &&  status <= 226){
            $('#link_'+id+' a').removeClass('desabilitado');
			$('#link_'+id+' span').hide();
        }else{
            $('#link_'+id+' a').addClass('desabilitado');
			$('#link_'+id+' span').show();
        }        
	}
});