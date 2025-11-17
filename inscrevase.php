<?php


?>



<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Twitter clone</title>
		
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="style/style.css">
	
	</head>

	<body>

		<!-- Static navbar -->
	    <nav class="navbar navbar-default navbar-static-top" style='font-family: monospace;'>
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <img src="imagens/unodev.png" />
	        </div>
	        
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	            <li><a href="index.php">Voltar para Home</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container">
	    	
	    	<br /><br />

	    	<div class="col-md-6" style='font-family: monospace;'">
				<h2>Comece agora mesmo!<br> Crie sua conta<br> depois so fazer login <br> pronto!<br> Pode iniciar <br>suas<br> Tags!</h2>
			</div>
	    	<div class="col-md-6 jumbotron" style='font-family: monospace;'>
	    		<h3>Inscreva-se já.</h3>
	    		<br />
				<form method="post" action="registra_usuario.php" id="formCadastrarse" enctype="multipart/form-data">
					<div class="form-group">
						<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuário" required="requiored">
						<?php if(isset($_GET['erro_usuario'])): ?>
    					<p style="color: red;">Usuário já existe</p>
						<?php endif; ?>
					</div>

					<div class="form-group">
						<input type="text" class="form-control" id="username" name="username" placeholder="@username" required="requiored">
						<?php if(isset($_GET['erro_username'])): ?>
    					<p style="color: red;">Username já existe</p>
						<?php endif; ?>
					</div>

					<div class="form-group">
						<input type="email" class="form-control" id="email" name="email" placeholder="Email" required="requiored">
					</div>
					<?php if(isset($_GET['erro_email'])): ?>
    				<p style="color: red;">Email já cadastrado</p>
					<?php endif; ?>
					<div class="form-group">
						<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" required="requiored">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="endereco" name="endereco" placeholder="Cidade" required="requiored">
					</div>
					<div class="form-group">
						<input type="date" class="form-control" id="dt_nasc" name="dt_nasc" placeholder="" required="requiored">
					</div>
					<div class="form-group">
						<textarea class="form-control" id="bio" name="bio" placeholder="Escreva aqui sua biografia" required="requiored" maxlength="160"></textarea>
					</div>
					<div class="form-group">
						<input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required="requiored">
					</div>
					<label>Foto de perfil:</label>
    				<input type="file" name="foto" accept="image/*">
					<br>
					
					<button type="submit" class="btn btn-custom form-control">Inscreva-se</button>
				</form>
			</div>
			<div class="col-md-4"></div>

			<div class="clearfix"></div>
			<br />
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>

		</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>