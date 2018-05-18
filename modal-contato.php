<?php
require_once('config/config.php');
require_once("config/funcoes.php");

if($_REQUEST['con_id'] > 0){
	$objContato = new Contato();
	$objContato->set("con_id",$_REQUEST['con_id']);
	$contato = $objContato->carregarContatos();
	$telefones = $objContato->carregarTelefones();
	$titulo = 'Editar';
}else{
	$titulo = 'Novo Contato';
}

?>


<div class="modal-content">
	<div class="modal-header">
		<h4 class="modal-title" id="myLargeModalLabel"><?php echo $titulo?></h4>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">×</span>
		</button>
	</div>
	<div class="modal-body">
		<form action="action/action.Contato.php" method="POST" accept-charset="utf-8" autocomplete="off">
			<input type="hidden" name="con_id" value="<?php echo $_REQUEST['con_id'] ?>" hidden>
			<div class="form-group">
				<label for="nome">Nome</label>
				<input type="text" name="nome" class="form-control" value="<?php echo $contato['con_nome']?>" placeholder="Nome do contato" required>
			</div>

			<div class="form-group" id="numeros">
				<label for="telefone">Telefone - <button id="novoNumero" type="button" class="btn btn-sm btn-info"  data-toggle="tooltip" data-placement="top" title="Novo Numero"><i class="fa fa-plus"></i></button></label>
				<?php if($_REQUEST['con_id'] > 0){ ?>
					<?php foreach ($telefones as $value){ ?>
						<div class="input-group mb-3" id="num-<?php echo $value['tel_id'] ?>">
							<input type="text" name="telefones[]" value="<?php echo $value['tel_telefone']?>" class="form-control" placeholder="Telefone do contato" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
						  <div class="input-group-append">
						    <button onclick="apagarNumero(<?php echo $value['tel_id']?>)" class="btn btn-outline-danger" type="button">Apagar</button>
						  </div>
						</div>
					<?php } ?>
				<?php }else{ ?>
					<input type="text" name="telefones[]" class="form-control" placeholder="Telefone do contato" required>
				<?php } ?>
			</div>

			<div class="modal-footer">
				<button data-dismiss="modal" aria-label="Close" type="button" class="btn btn-default">Fechar</button>
				<button name="btnSalvarContato" type="submit" class="btn btn-success">Salvar</button>
			</div>

		</form>
	</div>
</div>

<script>
	$('#novoNumero').click(function(event) {
  		$("#numeros").append('<input type="text" name="telefones[]" class="form-control mt-2" placeholder="Telefone do contato" required>');
  	});

  	function apagarNumero(tel_id){
		$.ajax({
			url: 'action/action.Contato.php',
			type: 'POST',
			data: {numero: tel_id, acao: 'apagarNumero'},
			success: function(){
				$("#num-"+tel_id).remove();
			}
		});  		
	}
</script>