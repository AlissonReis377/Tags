<?php

    session_start();
//validação sessao suussususuusa  usuaraio to com sono
    if(!isset($_SESSION['usuario'])){
        header('location: index.php?erro=1');
    }

	//puxa tudo logo nessa budega
	require_once('db.class.php');
	require_once('Usuario.class.php');
	require_once('consulta.class.php');
	
	$objDb = new Db();
	$link = $objDb->conecta_mysql();
	
	
	//$id_usuario = $_SESSION['id_usuario']; -> ta errado é pra usar id somente
	$id_usuario = $_SESSION['id']; //DESSE JEITO 
	//quantidade de tags aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
	$sql= "SELECT COUNT(*) AS qtd_tags FROM tag WHERE id_usuario = $id_usuario";

	$resultado_id = mysqli_query($link, $sql);

		if($resultado_id){
			$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
			
			$qtd_tags = $registro['qtd_tags'];
		}else{
			echo'Houve um erro';
	}

	$sql= "SELECT COUNT(*) AS qtd_seguidores FROM usuarios_seguidores WHERE id_usuario = $id_usuario";
	
	$resultado_id = mysqli_query($link, $sql);

	if($resultado_id){
		$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		$qtd_seguidores = $registro['qtd_seguidores'];
	}else{
		echo'houve um erro';
	}


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
	

		<style>
        	.mensagem-sucesso {
                color: green;
                font-weight: bold;
                margin-top: 10px;
            }
        </style>



		<script type="text/javascript">

		$(document).ready( function(){

			$(document).on('click', '.btn-deletar-tag', function(){
    			var id_tag = $(this).data('id');
    
    			if(confirm("Deseja mesmo apagar esta tag?")) {
        			$.ajax({
            		url: 'apaga_tag.php',
            		method: 'POST',
            		data: { id_tag: id_tag },
            		success: function(data) {
                	alert(data);
                	$('#tag_' + id_tag).fadeOut();
            }
        });
    }
});


			$('#btn_tag').click( function(){

				if($('#texto_tag').val().length > 0){
					$.ajax({
						url: 'inclui_tag.php',
						method: 'post',
						data: $('#form_tag').serialize(),
						success: function(data){
							$('#texto_tag').val('');
							$('#mensagem_sucesso').text('Tag iniciada com sucesso!').show(); //exibe o tag iniciada com sucesso a baixo do form de envio da tag
							setTimeout(function(){
                            $('#mensagem_sucesso').fadeOut('slow')
                            }, 3000); // escode a mensagem dps de 3 segundos O_O
							atualizaTag();
						}
					});
				}
		
			});
		
			function atualizaTag(){
				//carregar as tags

				$.ajax({
					url: 'get_tag.php',
					success: function(data){
						$('#tags').html(data);
					}
				})
			}
				
		
			atualizaTag();
			// EVENTO DE DELETAR TAG
		
			$('#btn_procurar_pessoa').click( function(){

				if($('#nome_pessoa').val().length > 0){
					$.ajax({
						url: 'get_pessoas.php',
						method: 'post',
						data: $('#form_procurar_pessoas').serialize(),
						success: function(data){
							$('#pessoas').html(data);
							
							$('.btn_seguir').click(function(){
								var id_usuario = $(this).data('id_usuario');
								

								$('#btn_seguir_'+id_usuario).hide();
								$('#btn_deixar_seguir_'+id_usuario).show();


								$.ajax({
									url: 'seguir.php',
									method: 'post',
									data: { seguir_id_usuario: id_usuario },
									success: function(data){
										
									}
								});
							});
						
						
							$('.btn_deixar_seguir').click(function(){
								var id_usuario = $(this).data('id_usuario');

								$('#btn_seguir_'+id_usuario).show();
								$('#btn_deixar_seguir_'+id_usuario).hide();

								$.ajax({
									url: 'deixar_seguir.php',
									method: 'post',
									data: {deixar_seguir_id_usuario: id_usuario },
									success: function(data){
									}
								})
							})
						
						
						
						
						
						}
							
							
					});
				}
		
			});
		
		
		});


		</script>




	</head>

	<body>

		<!-- Static navbar -->
	    <nav class="navbar navbar-default navbar-static-top" style="font-family: monospace;">
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
	            <li><a href="sair.php">Sair</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container" style="font-family: monospace;">
	    	
	    	<br /><br />
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
						 <h4><?= $_SESSION['usuario'] ?><small>#<?=$_SESSION['id']?></small></h4>
						<hr />
						<div class="col-md-6" id="seguidores">
							Seguindo <br> <?=$qtd_seguidores?>
						</div>
						<div class="col-md-6 " id="qtdtags">
							Tags <br> <?=$qtd_tags?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-body">
							<form id="form_tag" class="input-group">
								<input type="text" id="texto_tag" name="texto_tag" class="form-control" placeholder="Comece suas Tags!" maxlength="200" />
								<span class="input-group-btn">
								<button class="btn btn-default" id="btn_tag" type="button">Iniciar Tag</button>
								</span>
							</form>
							<div id="mensagem_sucesso" class="mensagem-sucesso" style="display: none;"></div>
					</div>
				</div>

				<div id="tags" class="list-group"></div>

			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
							<form id="form_procurar_pessoas" class="input-group">
								<input type="text" id="nome_pessoa" name="nome_pessoa" class="form-control" placeholder="Quem procuras?" maxlength="200" />
								<span class="input-group-btn">
								<button class="btn btn-default" id="btn_procurar_pessoa" type="button">Procurar</button>
								</span>
							</form>
					</div>
						<div id="pessoas" class="list-group"></div>
				</div>
			</div>


		</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>