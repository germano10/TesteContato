jQuery(document).ready(function($) {
	
  $('[data-toggle="tooltip"]').tooltip();

  $('#lista-contatos').load('lista-contatos.php'); 

});

function contatoAbrir(con_id){
	var url = "modal-contato.php?con_id="+con_id;
	$(".modal-lg").load(url, function(){
   	    $("#Mcontato").modal({
   	        "show": true
   	    });
   	});
}

function apagarContato(con_id){
	$.ajax({
		url: 'action/action.Contato.php',
		type: 'POST',
		data: {contato: con_id, acao: 'apagarContato'},
		success: function(e){
			location.reload();
		}
	});	
}

function buscaContato(){
	var busca = $("#buscar").val();
	$('#lista-contatos').load('lista-contatos.php',{busca: busca});
}