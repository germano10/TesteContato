<?php

require_once('config/config.php');
require_once('config/funcoes.php');

$objContato = new Contato();
$contato = $objContato->listarContatos($_REQUEST['busca']);

?>

<div class="container">

	<div class="page-header mt-5">
		<h3 class="page-title float-left">Contatos</h3>
		<button onclick="contatoAbrir(0)" type="button" class="btn btn-success btn-sm float-right">Novo Contato</button>
		<div class="clearfix"></div>
	</div>

	<table class="table table-hover">
		<thead>
			<tr>
				<th>Contato</th>
				<th width="100">Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($contato as $value){ ?>
				<tr>
					<td><?php echo $value['con_nome']?></td>
					<td>
						<button onclick="contatoAbrir(<?php echo $value['con_id']?>)" type="button" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Abrir">
						<i class="fa fa-pencil-square-o"></i>
						</button>
						<button onclick="apagarContato(<?php echo $value['con_id']?>)" type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Excluir">
						<i class="fa fa-trash-o"></i>
						</button>
					</td>
				</tr>
			<?php } ?>			
		</tbody>
	</table>
</div>