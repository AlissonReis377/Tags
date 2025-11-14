<?php

//começa aqui mas pega o coisa do php ali em cima
session_start();
//validação sessao do usuario
    if(!isset($_SESSION['usuario'])){
        header('location: index.php?erro=1');
    }

	//puxa tudo que tem no banco de dados
	require_once('db.class.php');
	require_once('Usuario.class.php');
	require_once('consulta.class.php');
	$objDb = new Db();
	$link = $objDb->conecta_mysql();

    //acaba aqui
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

    <style>
        body{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            background-color: #1a1a1a;
            color: #bb86fc;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        #visualizacao, #edicao-perfil{
            padding: 2rem;
            max-width: 800px;
            margin: 0 auto;
        }

        section{
            background-color: #2d2d2d;
            padding: 1.5rem;
            border-radius: 8px;
            border: 1px solid #444;
        }

        h1, h2, h3{
            color: #bb86fc;
            margin-top: 0;
        }

        h2{
            border-bottom: 1px solid #444;
            padding-bottom: 0.5rem;
        }

        button{
            background-color: #bb86fc;
            color: #1a1a1a;
            border: none;
            padding: 0.5rem 1rem;
            margin: 0.25rem;
            border-radius: 4px;
            cursor: pointer;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 0.9rem;
            font-weight: bold;
        }

        button:hover{
            background-color: #9d67e8;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
        }

        table, th, td{
            border: 1px solid #555;
        }

        th,td{
            padding: 0.75rem;
            text-align: left;
        }
        
        th{
            background-color: #3d3d3d;
            color: #bb86fc;
        }
        
        td{
            background-color: #2d2d2d;
            color: #bb86fc;
        }

        input, textarea, select{
            width: 100%;
            padding: 0.5rem;
            margin: 0.25rem 0;
            background-color: #3d3d3d;
            border: 1px solid #555;
            border-radius: 4px;
            color: #bb86fc;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        input:focus, textare:focus{
            outline: none;
            border-color: #bb86fc;
        }

        label{
            color: #bb86fc;
            display: block;
            margin: 0.5rem 0 0.25rem 0;
        }

        ul{
            list-style-type: none;
            padding: 0;
        }

        li{
            padding: 0.5rem 0;
            border-bottom: 1px solid #444;
            color: #bb86fc;
        }

        li:last-child{
            border-bottom: none;
        }

        img{
            border-radius: 8px;
            border: 2px solid #bb86fc;
        }

        .cabecalho-perfil{
            display: flex;
            gap: 2rem;
            align-items: flex-start;
        }

        .info-perfil{
            flex: 1;
        }

        .info-perfil p{
            color: #bb86fc;
            margin: 0.5rem 0;
        }

        .botoes-acao{
            margin: 1rem 0;
        }

        @media (max-width: 600px){
            .cabecalho-perfil{
                flex-direction: column;
                text-align: center;
            }
            #visualizacao, #edicao-perfil{
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <!--Visualização do perfil -->
    <div id="visualizacao">
        <section>
            <!-- Cabeçalho do Perfil -->
            <div class="cabecalho-perfil">
                <div>
                    <img id="foto-visu" src="https://via.placeholder.com/150" alt="Foto_perfil" width="150" height="150">
                </div>

                <div class="info-perfil">
                    <button onclick="modoEdicao()">Editar perfil</button>

                    <h1 id="nome">Laura Olivetti</h1>
                    <p id="username">@lauradopix</p>
                    <p id="info-visu">Desenvolvedora Web! São Paulo</p>

                <!--Estatístiicas-->
                <table>
                    <tr>
                        <th>Tags</th>
                        <th>Seguidores</th>
                        <th>Seguindo</th>
                    </tr>
                    <tr>
                        <td>100</td>
                        <td>420</td>
                        <td>6969</td>
                    </tr>
                </table>
                </div>
            </div>
        </section>

        <!--Biografia-->
        <section>
            <h2>Biografia</h2>
            <p id="biografia">Gosto de fazer chocolate quente e cafuné em gatos fofinhos! :3</p>
        </section>

        <!--Informações pessoais-->
        <section>
            <h2>Informações</h2>
            <ul>
                <li>Email: <span id="email-visu">laurinha.mataporco@gmai.com</span></li>
                <li>Telefone: <span id="telefone-visu">(11) 99124-1855</span></li>
                <li>Site: <span id="site-visu"> wwww.laurasexshop.com</span></li>
                <li>Data de Nascimento: <span id="nascimento-visu">06/05/2006</span></li>
            </ul>
        </section>
    </div> 

    <!-- Modo de edição de perfil  -->
    <div id="edicao-perfil" style="display: none;">
        <section>
            <h2>Editar perfil</h2>

            <!--Foto de Perfil-->
            <div>
                <img id="foto-edicao" src="https://via.placeholder.com/150" alt="foto de perfil" width="150" height="150">
                <br>
                <label for="upload-foto">Alterar foto:</label>
                <input type="file" id="upload-foto" onchange="previewFoto(this)" accept="image/*">
                <button onclick="removerFoto()">Remover foto</button>
            </div>

        <!--Form de edição-->
        <form id="form-edicao">
            <label for="nome-edicao">Nome:</label>
            <input type="text" id="nome-edicao" value="Laura" placeholder="Seu nome">

            <label for="username-edicao">Username:</label>
            <input type="text" id="username-edicao" value="lauradopix" placeholder="Seu username">

            <label for="cidade-edicao">Cidade:</label>
            <input type="text" id="cidade-edicao" value="Sao Paulo" placeholder="Sua cidade">

            <label for="bio-edicao">Biografia:</label>
            <textarea id="bio-edicao" rows="4" placeholder="Conte sobre voce!">Gosto de fazer chocolate quente e cafuné em gatos fofinhos! :3</textarea>

            <label for="email-edicao">Email:</label>
            <input type="email" id="email-edicao" value="laura.mataporco@gmail.com" placeholder="SeuEmail@gmail.com">

            <label for="telefone-edicao">Telefone:</label>
            <input type="tel" id="telefone-edicao" value="(11)99124-1855" placeholder="(11)99999-9999">

            <label for="site-edicao">Site:</label>
            <input type="url" id="site-edicao" value="www.laurasexshop.com" placeholder="www.sitelegal.com">

            <label for="nascimento-edicao">Data de Nascimento:</label>
            <input type="date" id="nascimento-edicao" value="2006-05-06">

        <!--Botões de Ação-->
        <div class="botoes-acao">
            <button type="button" onclick="salvarAlteracoes()">Salvar alterações</button>
            <button type="button" onclick="cancelarEdicao()">Cancelar</button>
        </div>
        </form>
        </section>
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
        if(confirm('Descartar alteracoes interrogacao')){
            voltarVisualizacao();
        }
    }
    function salvarAlteracoes(){
        //Atualizar dados na visualizacao
        document.getElementById('nome').textContent = document.getElementById('nome-edicao').value;
        document.getElementById('username').textContent = '@' + document.getElementById('username-edicao').value;
        document.getElementById('biografia').textContent = document.getElementById('bio-edicao').value;
        document.getElementById('email-visu').textContent = document.getElementById('email-edicao').value;
        document.getElementById('telefone-visu').textContent = document.getElementById('telefone-edicao').value;
        document.getElementById('site-visu').textContent = document.getElementById('site-edicao').value;

        //Atualizar Informacoes resumidas
        const cidade = document.getElementById('cidade-edicao').value
        document.getElementById('info-visu').textContent = `${cidade}`;

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
        const fotoPadrao = 'https://via.placeholder.com/150';
        document.getElementById('foto-edicao').src = fotoPadrao;
        document.getElementById('foto-visu').src = fotoPadrao;
    }
</script>
</body>
</html>