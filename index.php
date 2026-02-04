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
		
		<!--WOW.JS (animações) -->
		<script src="js/wow.min.js"></script>
        <script>
            new WOW().init();
        </script>
	

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="style/style.css">
		<!--animte.css-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
	
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

<div class="wow animate__animated animate__fadeInUp" data-wow-delay="0.5s">
	<div class="container">
  		<div class="row"> <!-- centraliza verticalmente -->
    
<<<<<<< Updated upstream
    	<!-- Coluna da imagem -->
    		<div class="col-md-6 d-flex justify-content-center">
      		<img src="imagens/tags.png" class="img-responsive" alt="Arte minimalista">
=======
    	<!--Coluna da imagem -->
    		<div class="col-md-6">
				<br>
				<br>
				<div class="tags inline-block p-4" style="text-align: center; border-radius: 16px; border: 1px solid #8a8a8a; background-color: rgb(20, 20, 20);">
				<img src="imagens/tags.png" class="img-fluid rounded-circle" width="150" height="150" style="object-fit:cover;" alt="Imagem Responsiva">
				<h4>Tags#01</h4>
				<p>Não tem conta ainda? Relaxa eu te guio!</p>
					<button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#modalCadastro">
					Inscrever-se
					</button>
				</div>
>>>>>>> Stashed changes
    	</div>

    <!-- Coluna do texto -->
    	<div class="col-md-6">
      		<div class="jumbotron" style="font-family: monospace;">
        		<h1 class="animate__animated animate__bounce animate__faster">Tags!</h1>
				<div class="text"><span class="typing"></span></div>
        		<a class="btn btn-custom" href="inscrevase.php">Inscrever-se</a>
				<hr />
				<label>Entrar</label>
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
<<<<<<< Updated upstream


=======
>>>>>>> Stashed changes
	      <div class="clearfix"></div>
		</div>


	    </div>
</div>
<<<<<<< Updated upstream
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
=======

<!-- Modal -->
<div class="modal fade" id="modalCadastro" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content tags">

      <div class="modal-header">
        <h4 class="modal-title">Criação de conta</h4>
      </div>

	  
	  <form method="post" action="registra_usuario.php" id="formCadastrarse" enctype="multipart/form-data">
        <div class="modal-body">

          <!-- STEP 1 -->
          <div class="step d-none">
			<h2>Vamos começar com seu nome</h2>
			<p>Seu nome é o que todos vão ver, ele vai ser usado para identificá-lo em todas as suas interações.</p>
            <input type="text" id="usuario" class="tags" name="usuario" placeholder="Usuário" maxlength="15" required>
            <?php if(isset($_GET['erro_usuario'])): ?>
              <p class="text-danger">Usuário já existe</p>
            <?php endif; ?>
          </div>

          <!-- STEP 2 -->
          <div class="step d-none">
			<h2>Agora seu username, cuidado ele é diferente do seu nome</h2>
				<p>é um @ unico que poderemos identificar você em nosso banco de dados!</p>
            <input type="text" class="tags" id="username" name="username" placeholder="@username" maxlength="10" required>
            <?php if(isset($_GET['erro_username'])): ?>
              <p class="text-danger">Username já existe</p>
            <?php endif; ?>
          </div>

          <!-- STEP 3 -->
          <div class="step d-none">
			<h2>Vamos colocar seu email</h2>
			<p>Qualquer coisa que precisarmos contatar você, usaremos esse email! Não usamos telefone nem pedimos informações pessoais :)</p>
            <input type="email" class="tags" id="email" name="email" placeholder="Email" required>
            <?php if(isset($_GET['erro_email'])): ?>
              <p class="text-danger">Email já cadastrado</p>
            <?php endif; ?>
          </div>

          <!-- STEP 4 -->
          <div class="step d-none">
			<h2>Quase lá... Precisamos do seu telefone</h2>
			<p>Futuramente usaremos seu telefone para conectar você a outras pessoas, para que você possa mandar mensagens gratuitamente XD</p>
            <input type="text" class="tags" id="telefone" name="telefone" placeholder="Telefone" required>
          </div>

          <!-- STEP 5 -->
          <div class="step d-none">
			<h2>Onde você mora?</h2>
			<p>Não coloque o endereço completo, apenas cidade-estado :D</p>
            <input type="text" class="tags" id="endereco" name="endereco" placeholder="Cidade" required>
          </div>

          <!-- STEP 6 -->
          <div class="step d-none">
			<h2>Precisamos saber se você pode usar nosso sistema!</h2>
			<p>Se você for menor de idade, você não poderá usar nosso sistema :(</p>
            <label>Data de nascimento</label>
            <input type="date" class="tags" id="dt_nasc" name="dt_nasc" required>
			<?php if(isset($_GET['erro_idade'])): ?>
			<div class="alert alert-danger text-center">
				Você precisa ter 18 anos ou mais para criar uma conta.
			</div>
			<?php endif; ?>

          </div>

          <!-- STEP 7 -->
          <div class="step d-none">
			<h2>Quase lá! Agora uma breve biografia</h2>
            <textarea class="form-control" id="bio" name="bio" placeholder="Sua biografia" maxlength="160"></textarea>
          </div>

          <!-- STEP 8 -->
          <div class="step d-none">
			<h2>Senha</h2>
            <input type="password" class="tags" id="senha" name="senha" placeholder="Senha" required>
          </div>

          <!-- STEP 9 -->
          <div class="step d-none">
            <label>Foto de perfil</label>
            <input type="file" name="foto_perfil" accept="image/*" class="tags">
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="btnContinuar">
            Continuar
          </button>

          <button type="submit" class="btn btn-success hidden" id="btnEnviar">
            Finalizar cadastro
          </button>
        </div>

      </form>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
>>>>>>> Stashed changes
<script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>


<script>
	var typing = new Typed (".typing", {
		strings : ["Comece agora", "Faça amigos", "Inicie suas Tags!",],
		typedSpeed: 60,
		backSpeed: 60,
		loop: true
	});




const modal = document.getElementById('modalCadastro');
const steps = modal.querySelectorAll('.step');
const btnContinuar = modal.querySelector('#btnContinuar');
const btnEnviar = modal.querySelector('#btnEnviar');

let stepAtual = 0;

function mostrarStep(index) {
  steps.forEach((step, i) => {
    step.classList.toggle('d-none', i !== index);
  });
}


modal.addEventListener('shown.bs.modal', () => {
  stepAtual = 0;
  mostrarStep(stepAtual);
  btnContinuar.classList.remove('d-none');
  btnEnviar.classList.add('d-none');
});

btnContinuar.addEventListener('click', () => {
  const inputs = steps[stepAtual].querySelectorAll('input, textarea');
  for (let input of inputs) {
    if (!input.checkValidity()) {
      input.reportValidity();
      return;
    }
  }

  stepAtual++;

  if (stepAtual < steps.length) {
    mostrarStep(stepAtual);
  }

  if (stepAtual === steps.length - 1) {
    btnContinuar.classList.add('d-none');
    btnEnviar.classList.remove('d-none');
  }
  function tem18Anos(data) {
	const hoje = new Date();
	const nascimento = new Date(data);
  
	let idade = hoje.getFullYear() - nascimento.getFullYear();
	const m = hoje.getMonth() - nascimento.getMonth();
  
	if (m < 0 || (m === 0 && hoje.getDate() < nascimento.getDate())) {
	  idade--;
	}
  
	return idade >= 18;
  }

  if (inputs[0].name === 'dt_nasc') {
  if (!tem18Anos(inputs[0].value)) {
    inputs[0].classList.add('is-invalid');
    return;
  } else {
    inputs[0].classList.remove('is-invalid');
  }
}


});






</script>


	</body>
</html>