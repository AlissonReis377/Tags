#  O Projeto "Tags": Uma Rede Social Minimalista

  O projeto "Tags" é um trabalho universitário que desenvolvi com alguns colegas de curso para a disciplina de Programação Orientada a Objetos. Nosso principal objetivo era criar uma rede social inspirada no Twitter, mas com uma abordagem radicalmente minimalista. Queríamos redefinir a experiência de uma plataforma social, eliminando muitas das interações complexas que se tornaram onipresentes hoje em dia.

A ideia central por trás de "Tags" era focar na essência da comunicação e do compartilhamento de conteúdo, sem a sobrecarga de funcionalidades. Decidimos remover elementos como respostas a posts, curtidas, e outras interações que, embora populares, muitas vezes desviam o foco do conteúdo em si. Acreditávamos que, ao simplificar a interface e as opções de interação, poderíamos criar um ambiente mais direto e menos poluído para os usuários.

O protótipo de "Tags" foi concebido para ser o mais minimalista possível. As interações seriam reduzidas ao essencial: os usuários poderiam postar suas próprias mensagens (ou "tags"), e a única forma de engajamento permitida seria através dos botões de seguir e deixar de seguir. Essa escolha deliberada visava promover uma experiência mais focada na leitura e na criação de conteúdo, permitindo que as informações fossem consumidas e disseminadas de forma mais limpa e direta. O desafio de programação orientada a objetos aqui era grande, pois exigia uma arquitetura robusta para gerenciar usuários, posts e as conexões de seguidores, tudo dentro de um escopo bastante limitado de funcionalidades.

#  Diagrama de caso de uso

![Diagrama sem nome drawio](https://github.com/user-attachments/assets/041acda9-fe48-4764-974e-f153f544b8f9)

fazer login: O usuário pode se autenticar no sistema para acessar suas funcionalidades.

cadastrar-se: Um novo usuário pode criar uma conta no sistema.

buscar usuários: O usuário pode procurar outros usuários dentro da plataforma.

seguir usuários: O usuário pode começar a seguir outro usuário.

deixar de seguir usuários: O usuário pode parar de seguir outro usuário.

fazer post: O usuário pode criar e publicar uma nova "tag" (postagem).

apagar post: O usuário pode remover uma de suas próprias postagens.


#  Banco de dados
1.	Foi criado a tabela usuário que recebe valores como estão no formulário de cadastro, a senha em especifico é um varchar de 32 caracteres porque futuramente ela vai ser um atributo criptografado:


`CREATE TABLE usuarios(
    Id_usuario INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    usuario VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(32) NOT NULL
);`

###  1.1.	Para ficar mais fácil de visualizar, aqui está a tabela em formato visual:


![image](https://github.com/user-attachments/assets/7ebb6060-15b4-41b6-8436-c1a3d235a999)





##  2.	Criação da tabela para as Tags:
 
  
  2.1	Depois de refletir cuidadosamente sobre a estratégia do sistema e buscar maneiras de torná-lo mais original, cheguei a uma solução criativa: desenvolver um estilo único para os posts, de forma que cada um deles carregue uma identidade própria. A proposta é que, ao se depararem com esse tipo específico de publicação, as pessoas consigam imediatamente reconhecer de qual sistema ou site ela faz parte — como se fosse uma assinatura visual e textual inconfundível. Essa abordagem não só reforça a originalidade da plataforma, como também cria uma conexão mais forte com o público, facilitando o reconhecimento e fortalecendo a marca.

  2.2	O primeiro passo para validar o uso do termo 'Tag' foi a criação da tabela MER (Modelo Entidade-Relacionamento). A ideia por trás desse conceito é que cada pessoa possa criar sua própria Tag, onde poderá publicar projetos, textos ou qualquer outro tipo de conteúdo que desejar. No entanto, uma Tag pertence exclusivamente a uma única pessoa, o que permite que o sistema comporte diversas Tags independentes, cada uma com seu próprio dono e propósito.
 
ENTIDADE: Usuario
- id_usuario (PK)
- nome
- email
- senha
- data_criacao

ENTIDADE: Tag
- id_tag (PK)
- nome
- descricao
- id_usuario (FK)
- data_criacao

ENTIDADE: Post
- id_post (PK)
- titulo
- conteudo
-tipo (ex: 'projeto', 'texto', etc.)
- id_tag (FK)
- data_postagem

RELACIONAMENTOS:

Usuario 1:N Tag
- Um usuário pode ter várias tags
- Uma tag pertence a apenas um usuário

Tag 1:N Post
- Uma tag pode ter vários posts
- Um post pertence a apenas uma tag

#  Estilização do site

Para materializar essa visão minimalista, cada aspecto de "Tags" foi concebido com a simplicidade em mente. A interface visual adota uma paleta de cores neutras, predominantemente preto e branco, que garante um contraste claro e limpo, direcionando a atenção para o texto e as informações essenciais. A tipografia escolhida é uma fonte 'monospace', que com sua uniformidade e clareza, confere um toque moderno, organizado e remete à precisão do código. A própria identidade visual do sistema reforça essa filosofia: a logo, apresentada na tela inicial, é composta por quadrados conectados sobre um fundo branco. Essa representação geométrica simples não só simboliza a união e a rede de usuários, mas também complementa a estética despojada do projeto.

![image](https://github.com/user-attachments/assets/3462b0a8-e613-4942-8544-5988fa8f5647)


![image](https://github.com/user-attachments/assets/6c91df0d-eb24-4263-b9da-91ae42ae4e9a)




Funcionalmente, o Diagrama de Casos de Uso de "Tags" reflete essa abordagem direta. As ações permitidas ao usuário são objetivas: fazer login, cadastrar-se, buscar usuários, seguir e deixar de seguir outros usuários, fazer posts e apagar posts. Essa lista concisa de funcionalidades assegura que a plataforma permaneça focada em seu propósito principal: permitir que os usuários compartilhem suas "tags" (posts)
 
#  Com o que foi feito?

*  HTML e CSS
*  PHP
*  Javascript
*  Jquery
*  Ajax

#  Colaboração

@alissonreis377

@gustavomanoelpo08

@damaceno.hyass

