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

	$sql= "SELECT COUNT(id_usuario) AS qtd_seguidores FROM usuarios_seguidores WHERE seguindo = 1 AND seguindo_id_usuario = $id_usuario";
	
	$resultado_id = mysqli_query($link, $sql);

	if($resultado_id){
		$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		$qtd_seguidores = $registro['qtd_seguidores'];
	}else{
		echo'houve um erro';
	}

    $sql= "SELECT COUNT(seguindo) AS qtd_seguindo FROM usuarios_seguidores WHERE id_usuario = $id_usuario";
    $resultado_id = mysqli_query($link, $sql); 
    if($resultado_id){
        $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
        $qtd_seguindo = $registro['qtd_seguindo'];
    }else{
        echo'houve um erro';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <!-- jquery - link cdn -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <!-- bootstrap - link cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!--animte.css-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <script>
        new WOW().init();
    </script>

    <style>
       *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
       }

       body{
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        background-color: #000000;
        color: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
       }

       .profile-container{
        display: flex;
        gap: 50px;
        align-items: flex-start;
        max-width: 900px;
        padding: 40px;
       }

       .profile-picture{
        flex-shrink: 0;
       }

       .profile-picture img {
        width: 180px;
        height: 180px;
        display: block;
       }

       .profile-content{
        flex: 1;
        display: flex;
        flex-direction: column;
       }

       .profile-header{
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
       }

       .profile-info{
        flex: 1;
       }

       .profile-name{
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 5px;
        color: #ffffff;
       }

       .profile-username{
        font-size: 20px;
        color: #ffffff;
        margin-bottom: 25px;
       }

       .profile-bio{
        font-size: 16px;
        line-height: 1.5;
        margin-bottom: 30px;
        color: #cccccc;
        max-width: 400px;
       }

       .profile-stats{
        display: flex;
        gap: 40px;
        margin-bottom: 30px;
       }

       .stat{
        text-align: left;
       }

       .stat-number{
        font-size: 20px;
        font-weight: bold;
        color: #ffffff;
        display: block;
       }

       .stat-label{
        font-size: 14px;
        color: #888888;
       }

       .edit-button{
        background-color: transparent;
        color: #ffffff;
        border: 2px solid #ffffff;
        padding: 10px 30px;
        border-radius: 20px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s;
        white-space: nowrap;
        margin-left: 20px;
       }

       .edit-button:hover{
        background-color: #ffffff;
        color: #000000;
       }

       /* Modo Edição */
       #edicao-perfil{
        display: none;
       }

       .edit-form{
        background-color: #1a1a1a;
        padding: 40px;
        border-radius: 10px;
        border: 1px solid #333;
        max-width: 500px;
        margin: 0 auto;
       }

       .form-group{
        margin-bottom: 20px;
       }

       .form-group label{
        display: block;
        color: #ffffff;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: bold;
       }

       .form-group input, .form-group textarea{
        width: 100%;
        padding: 12px;
        background-color: #2a2a2a;
        border: 1px solid #444;
        border-radius: 5px;
        color: #fff;
        font-size: 16px;
       }

       .form-group textarea{
        resize: vertical;
        min-height: 80px;
       }

       .photo-edit{
        text-align: center;
        margin-bottom: 30px;
       }

       .photo-edit img{
        width: 150px;
        height: 150px;
        margin-bottom: 15px;
       }

       .photo-buttons{
        display: flex;
        gap: 10px;
        justify-content: center;
       }

       .photo-buttons button{
        background-color: #333;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
       }

       .form-buttons{
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 25px;
        }

        .save-btn{
            background-color: #ffffff;
            color: #000000;
            border: none;
            padding: 12px 30px;
            border-radius: 20px;
            font-weight: bold;
            cursor: pointer;
        }

        .cancel-btn{
            background-color: transparent;
            color: #ffffff;
            border: 2px solid #ffffff;
            padding: 12px 30px;
            border-radius: 20px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!--Visualização do perfil -->
    <div id="visualizacao">
        <div class="profile-container">
            <!-- Foto de Perfil -->
            <div class="profile-picture">
                <img id="foto-visu" src="https://via.placeholder.com/180" alt="Foto_perfil" width="180" height="180">
            </div>

            <!-- Informações -->
            <div class="profile-content">
                <div class="profile-header">
                    <div class="profile-info">
                        <h1 class="profile-name" id="nome"><?= $_SESSION['usuario'] ?><small>#<?=$_SESSION['id']?></small></h1>
                        <p class="profile-username" id="username"><?= $_SESSION['username'] ?></p>
                    </div>
                    <button class="edit-button" onclick="modoEdicao()">Editar perfil</button>
                </div>
                
                <p class="profile-bio" id="biografia"><?= $_SESSION['bio']; ?></p>

                <div class="profile-stats">
                    <div class="stat">
                        <span class="stat-number"><?=$qtd_tags?></span>
                        <span class="stat-label">Tags</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number"><?=$qtd_seguidores?></span>
                        <span class="stat-label">Seguidores</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number"><?=$qtd_seguindo?></span>
                        <span class="stat-label">Seguindo</span>
                    </div>
                </div>
            </div>
        </div>
    </div> 

    <!-- Modo de edição de perfil  -->
    <div id="edicao-perfil" style="display: none;">
        <div class="edit-form">
            <h2 style="color: #ffffff; text-align: center; margin-bottom: 30px; font-size: 24px;">Editar Perfil</h2>

            <!--Foto de Perfil-->
            <div class="photo-edit">
                <img id="foto-edicao" src="https://via.placeholder.com/150" alt="foto de perfil">
                <div class="photo-buttons">
                    <input type="file" id="upload-foto" onchange="previewFoto(this)" accept="image/*" style="display: none;">
                    <button onclick="document.getElementById('upload-foto').click()">Alterar foto</button>
                    <button onclick="removerFoto()">Remover foto</button>
                </div>
            </div>

            <!--Form de edição-->
            <form id="form-edicao">
                <div class="form-group">
                    <label for="nome-edicao">Nome:</label>
                    <input type="text" id="nome-edicao" value="<?= $_SESSION['usuario'] ?>" placeholder="Seu nome">
                </div>

                <div class="form-group">
                    <label for="username-edicao">Username:</label>
                    <input type="text" id="username-edicao" value="<?= $_SESSION['username'] ?>" placeholder="Seu username">
                </div>

                <div class="form-group">
                    <label for="bio-edicao">Biografia:</label>
                    <textarea id="bio-edicao" rows="4" placeholder="Conte sobre voce!"><?= $_SESSION['bio']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="email-edicao">Email:</label>
                    <input type="email" id="email-edicao" value="<?= $_SESSION['email']; ?>" placeholder="SeuEmail@gmail.com">
                </div>

                <div class="form-group">
                    <label for="telefone-edicao">Telefone:</label>
                    <input type="tel" id="telefone-edicao" value="<?= $_SESSION['telefone']; ?>" placeholder="(11)99999-9999">
                </div>

                <div class="form-group">
                    <label for="site-edicao">Site:</label>
                    <input type="url" id="site-edicao" value="<?= $_SESSION['endereco']; ?>" placeholder="www.sitelegal.com">
                </div>

                <div class="form-group">
                    <label for="nascimento-edicao">Data de Nascimento:</label>
                    <input type="date" id="nascimento-edicao" value="<?= $_SESSION['dt_nasc']; ?>">
                </div>

                <!--Botões de Ação-->
                <div class="form-buttons">
                    <button type="button" class="save-btn" onclick="salvarAlteracoes()">Salvar alterações</button>
                    <button type="button" class="cancel-btn" onclick="cancelarEdicao()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

<script>
    function modoEdicao(){
        document.getElementById('visualizacao').style.display = 'none';
        document.getElementById('edicao-perfil').style.display = 'block';
    }

    function voltarVisualizacao(){
        document.getElementById('edicao-perfil').style.display = 'none';
        document.getElementById('visualizacao').style.display = 'block';
    }

    function cancelarEdicao(){
        if(confirm('Descartar alterações?')){
            voltarVisualizacao();
        }
    }

    function salvarAlteracoes(){
        //Atualizar dados na visualizacao
        document.getElementById('nome').textContent = document.getElementById('nome-edicao').value;
        document.getElementById('username').textContent = document.getElementById('username-edicao').value;
        document.getElementById('biografia').textContent = document.getElementById('bio-edicao').value;

        alert('Perfil atualizado com sucesso');
        voltarVisualizacao();
    }

    function previewFoto(input){
        if (input.files && input.files[0]){
            const reader = new FileReader();
            reader.onload = function(e){
                document.getElementById('foto-edicao').src = e.target.result;
                document.getElementById('foto-visu').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removerFoto(){
        const fotoPadrao = 'https://via.placeholder.com/180';
        document.getElementById('foto-edicao').src = fotoPadrao;
        document.getElementById('foto-visu').src = fotoPadrao;
    }
</script>
</body>
</html>