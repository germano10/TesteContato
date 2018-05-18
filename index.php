<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Lista de Contatos de Felipe Rocha Germano">
    <meta name="author" content="Felipe Rocha Germano">
    <title>Lista de Contatos - Felipe Rocha Germano</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/script.js"></script>
  </head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="#">Contatos</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarsExample07">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="#">Inicio</a>
					</li>
				</ul>
				<form onsubmit="buscaContato(); return false;" class="form-inline mt-2 mt-md-0" method="POST" autocomplete="off">
					<input id="buscar" class="form-control mr-sm-2" type="text" placeholder="Buscar" aria-label="Buscar">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
				</form>
			</div>
		</div>
	</nav>
	<div id="lista-contatos"></div>


<div id="Mcontato" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		
	</div>
</div>

</body>
</html>