<?php

	$erro = isset($_GET['erro']) ? $_GET['erro'] : 0; //caso não exista erro ele não vai retornar nada

?>
<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Tags!</title>

		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="style/style.css">
	
		<script>
			// código javascript
			$(document).ready( function(){
				//verificar se usuario e senha foi preenchido
				$('#btn_login').click(function(){

					var campo_vazio = false;

					if($('#campo_usuario').val() == ''){
						$('#campo_usuario').css({'border-color': '#A94442'});
						campo_vazio = true
					} else {
						$('#campo_usuario').css({'border-color': '#CCC'});
					}
				
					if($('#campo_senha').val() == ''){
						$('#campo_senha').css({'border-color': '#A94442'});
						campo_vazio = true
					} else {
						$('#campo_senha').css({'border-color': '#CCC'});
					}
					
					if(campo_vazio) return false;
				});
			});						
		</script>
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
	        </div>
	        
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	            <li><a href="inscrevase.php">Inscrever-se</a></li>
	            <li class="<?=$erro == 1 ? 'open' : '' ?>">
	            	<a id="entrar" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Entrar</a>
					<ul class="dropdown-menu" aria-labelledby="entrar">
						<div class="col-md-12">
				    		<p>Você possui uma conta?</h3>
				    		<br />
							<form method="post" action="validar_acesso.php" id="formLogin">
								<div class="form-group">
									<input type="text" class="form-control" id="campo_usuario" name="usuario" placeholder="Usuário" />
								</div>
								
								<div class="form-group">
									<input type="password" class="form-control red" id="campo_senha" name="senha" placeholder="Senha" />
								</div>
								
								<button type="buttom" class="btn btn-custom" id="btn_login">Entrar</button>

								<br /><br />
								
							</form>
							<?php
								if($erro == 1){
									echo '<font color="#FF0000">Usuario ou senha incorreto</font>';
								}
							?>
						</form>
				  	</ul>
	            </li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	<div class="container">
  		<div class="row"> <!-- centraliza verticalmente -->
    
    	<!-- Coluna da imagem -->
    		<div class="col-md-6 d-flex justify-content-center">
      		<img src="imagens/tags.png" class="img-responsive" alt="Arte minimalista">
    	</div>

    <!-- Coluna do texto -->
    	<div class="col-md-6">
      		<div class="jumbotron" style="font-family: monospace;">
        		<h1>Bem vindo ao Tags!</h1>
        		<p>Comece agora mesmo!</p>
        		<a class="btn btn-custom" href="inscrevase.php">Inscrever-se</a>
				<br><br><br><br>
				<form method="post" action="validar_acesso.php" id="formLogin">
								<div class="form-group">
									<input type="text" class="form-control" id="campo_usuario" name="usuario" placeholder="Usuário" />
								</div>
								
								<div class="form-group">
									<input type="password" class="form-control red" id="campo_senha" name="senha" placeholder="Senha" />
								</div>
								
								<button type="buttom" class="btn btn-custom" id="btn_login">Entrar</button>

								<br /><br />
								
							</form>
      		</div>
    	</div>

  	</div>
</div>


	      <div class="clearfix"></div>
		</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>