<?php

    //arquivo que chama as funções
    require_once('conexao.php');
    require_once('login.php');

    session_start();
    //chamando conexão com o banco
    $conexao = conexaoDB();

    //caso usuario não esteja logado e queira entrar
    Login();

    //******Sair do cms
    if(isset($_GET['sair'])){
        header ('location:../');
        session_destroy();
    }
    
    //***** USUARIO ******
    if(isset($_POST['btnUsuarioSalvar'])){
        $nome = $_POST['txtnomeUsuario'];
        $usuario = $_POST['txtUsuario'];
        $senha = $_POST['txtSenhaUsuario'];
        $nivel = $_POST['nivelU'];
        $ativar = $_POST['ativacao'];
        
        //Inserir usuarios
        if($_POST['btnUsuarioSalvar'] == "Inserir"){
            if($nivel == 'null'){
            echo("<script>alert('Selecione um nivel')</script>");
            
            }
            else{
                $sql = "INSERT INTO usuario (nome, usuario, senha, nivel, AtivarDesativar)VALUES('".$nome."','".$usuario."','".$senha."','".$nivel."','".$ativar."');";   
            }     
        }
        //editar usuarios
        else if($_POST['btnUsuarioSalvar'] == "Editar"){
            $sql = "UPDATE usuario SET usuario='".$usuario."',senha='".$senha."',nivel=".$nivel.",AtivarDesativar=".$ativar.",nome='".$nome."'Where idUsuario=".$_SESSION['idUsuario'].";";
            
        }
        
        mysqli_query($conexao,$sql);
    }
        
    
     //****NIVEL USUARIO****
    if(isset($_POST['enviarNivel'])){
        $ativacao = $_POST['ativacao'];
        $nome = $_POST['txtNomeNivel'];
        
        //Inserir nivel usuarios
        if($_POST['enviarNivel'] == "Inserir"){
            $sql = "INSERT INTO nivelusuario (nivel,ativarDesativar) VALUES('".$nome."',".$ativacao.");";
        }
        //editar nivel usuarios
        else if($_POST['enviarNivel']=="Editar"){
            $sql = "UPDATE NivelUsuario SET nivel='".$nome."',ativarDesativar='".$ativacao."'WHERE idNivelUsuario=".$_SESSION['id'];
        }
        
        mysqli_query($conexao,$sql);
    }
    
    //****AUTORES******
    if(isset($_POST['btnSalvarAutores'])){
        $nome = $_POST['txtNome'];
        $ativacao = $_POST['ativacao'];
        $descricao = $_POST['txtDescricao'];
        $foto = $_POST['txtfoto'];
        
        //INSERIR AUTORES
        if($_POST['btnSalvarAutores'] == "Inserir"){
            $sql = "INSERT INTO autores(nome,descricao,imagem,ativarDesativar) VALUES('".$nome."','".$descricao."','".$foto."','".$ativacao."');";
        }
        //EDITAR AUTORES
        else if($_POST['btnSalvarAutores'] == "Editar"){
            //se não foi selecionado foto não foto
            if($foto == ""){
                $sql = "UPDATE autores SET nome='".$nome."',ativarDesativar='".$ativacao."',descricao='".$descricao."' where idAutores=".$_SESSION['idAutores'];
            }
            //se foto foi selecionada atualizar foto
            else{
                $sql = "UPDATE autores SET nome='".$nome."',ativarDesativar='".$ativacao."',descricao='".$descricao."',imagem='".$foto."' where idAutores=".$_SESSION['idAutores'];
            }         
        } 
        
        mysqli_query($conexao,$sql);
        
    }

    //****LIVRARIA*******
    if(isset($_POST['btnSalvarLivraria'])){
        
        $historia = $_POST['txtHistoria'];
        $visao = $_POST['txtVisao'];
        $missao = $_POST['txtMissao'];
        $foto =  $_POST['txtfoto'];
        $ativacao = $_POST['ativacao'];
        
        //insert de livraria no banco
        if($_POST['btnSalvarLivraria'] == "Inserir"){
            if($ativacao == 1){
                $sql0 = "UPDATE livraria SET ativarDesativar=0";
                mysqli_query($conexao,$sql0);
                
                $sql = "INSERT INTO livraria(historia,visao,missao,slide,ativarDesativar) VALUES('".$historia."','".$visao."','".$missao."','".$foto."',".$ativacao.")";
            }else{
                $sql = "INSERT INTO livraria(historia,visao,missao,slide,ativarDesativar) VALUES('".$historia."','".$visao."','".$missao."','".$foto."',".$ativacao.")";
            }
        }
        //editar livraria no banco
        else if($_POST['btnSalvarLivraria'] == "Editar"){
            $sql = "UPDATE livraria SET historia='".$historia."',visao='".$visao."',missao='".$missao."',slide='".$foto."',ativarDesativar=".$ativacao." where idLivraria=".$_SESSION['idlivraria'];
            
        }
        mysqli_query($conexao,$sql);
        
        
    }
    
    //*****LOJAS****

    if(isset($_POST['btnSalvarLoja'])){
        $cidade = $_POST['txtCidade'];
        $telefone = $_POST['txtTelefone'];
        $celular = $_POST['txtCelular'];
        $ativacao = $_POST['ativacao'];
        $logradouro = $_POST['txtLogradouro'];
        
        
        if($_POST['btnSalvarLoja'] == "Inserir"){
            $sql = "INSERT INTO lojas(cidade,Telefone,celular,endereco,ativarDesativar)VALUES('".$cidade."','".$telefone."','".$celular."','".$logradouro."',".$ativacao.")";
        }
        else if($_POST['btnSalvarLoja'] == "Editar"){
            $sql="UPDATE lojas SET cidade='".$cidade."',Telefone='".$telefone."',celular='".$celular."',ativarDesativar=".$ativacao.",endereco='".$logradouro."'where idLojas=".$_SESSION['idLojas'];
            
        }
        
        mysqli_query($conexao,$sql);
        
    }

    //***Promocoes
    if(isset($_POST['btnPromocoes'])){
        $livro = $_POST['livros'];
        $desconto = $_POST['txtDesconto'];
        $ativacao = $_POST['ativacao'];
        
        //insert de promocoes
        if($_POST['btnPromocoes'] == "Inserir"){
            $sql = "INSERT INTO promocao(idProdutos,desconto,ativarDesativar)VALUES(".$livro.",".$desconto.",".$ativacao.")";
        }
        //Editar promocoes
        if($_POST['btnPromocoes'] == "Editar"){
            $sql = "UPDATE promocao SET idProdutos=".$livro.",desconto=".$desconto.",ativarDesativar=".$ativacao." where idPromocao=".$_SESSION['idPromocao'];
        }
        mysqli_query($conexao,$sql);
    }

    //******Categoria
    
    if(isset($_POST['enviarCategoria'])){
        $nome = $_POST['txtNomeCategoria'];
        $ativacao = $_POST['ativacao'];
        $id = $_SESSION['idcategoria'];
        
        if($_POST['enviarCategoria'] == "Salvar"){
            $sql = "INSERT INTO categoria (nome,ativarDesativar)VALUES('".$nome."',".$ativacao.")";
        }
        else if($_POST['enviarCategoria'] == "Editar"){
            $sql = "UPDATE categoria SET nome='".$nome."',ativarDesativar=".$ativacao." where idcategoria=".$id;
        }
        
            
        mysqli_query($conexao,$sql);
    
    }

    ///********SUB CATEGORIA

    if(isset($_POST['btnSubCategoria'])){
        
        
        $nome = $_POST['txtsubCategoria'];
        $ativacao = $_POST['ativacao'];
        $categoria = $_POST['categoria'];
        
        
        if($_POST["btnSubCategoria"] == "Salvar"){
            
            if($categoria == 0){
                echo("<script>alert('Selecione uma categoria')</script>");
            }else{
                $sql = "INSERT INTO subcategoria(nome,idCategoria,ativarDesativar)VALUES('".$nome."',".$categoria.",".$ativacao.")";
                mysqli_query($conexao,$sql);
            }  
        }
        else if($_POST["btnSubCategoria"] == "Editar"){
            $id = $_SESSION['idSubCategoria'];
            
            //if para saber se selecionou uma categoria
            if($categoria == 0){
                $sql = "UPDATE subcategoria SET nome='".$nome."',ativarDesativar=".$ativacao." where idsubCategoria=".$id;
            }else{
               $sql = "UPDATE subcategoria SET nome='".$nome."',idCategoria=".$categoria.",ativarDesativar=".$ativacao." where idsubCategoria=".$id; 
            }
            
            mysqli_query($conexao,$sql);
        }
             
    }


    ///********Produto
    if(isset($_POST['btnProdutosSalvar'])){
        
        $nome = $_POST['txtnome'];
        $preco = $_POST['txtpreco'];
        $autor = $_POST['comboAutor'];
        $ativacao = $_POST['ativacao'];
        $descricao = $_POST['txtdescricao'];
        $imagem = $_POST['txtfoto'];
        
        $Categoria = $_POST['comboCategoria'];
        $subCategoria = $_POST['comboSubcategoria'];
        
        $id = $_SESSION['idProdutos'];
        
        if($_POST['btnProdutosSalvar'] == "Salvar"){
            //inserindo na tabela livros
            $sql = "INSERT INTO produtos (nome, descricao, imagem, preco, ativarDesativar,idAutores)VALUES('".$nome."','".$descricao."','".$imagem."','".$preco."',".$ativacao.",".$autor.")";
            
            
            mysqli_query($conexao,$sql);
            //pega o ultimo dado da tabela livro
            $ultimoid = mysqli_insert_id($conexao);
            
            //insere na tabela relacionamento livro e subcategoria
            $sqlSubCategoria = "INSERT INTO subcategoria_produto(idSubcategoria,idProdutos)VALUES(".$subCategoria.",".$ultimoid.")";
            
            mysqli_query($conexao,$sqlSubCategoria);
            
        }
        else if($_POST['btnProdutosSalvar'] == "Editar"){
            
            //if para saber se a imagem foi trocada
            if($imagem == null){
                //atualizando tabela produtos
                $sql = "UPDATE produtos SET nome='".$nome."',descricao='".$descricao."',preco='".$preco."',ativarDesativar=".$ativacao.",idAutores=".$autor." where idProdutos=".$id; 
            }else{
               //atualizando tabela produtos
                $sql = "UPDATE produtos SET nome='".$nome."',descricao='".$descricao."',imagem='".$imagem."',preco='".$preco."',ativarDesativar=".$ativacao.",idAutores=".$autor." where idProdutos=".$id; 
            }
            
                        
            mysqli_query($conexao,$sql);
            
            //atualizando relacionamento da tabela produtos
            $select = "UPDATE subcategoria_produto SET idSubcategoria=".$subCategoria." where idProdutos=".$id;
            
            mysqli_query($conexao,$select);
            
            
            
        }
    }



?>

<html>
    <head>
        <title>CMS</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/jquery.js"></script>    
        <script src="js/funcoes.js"></script>
        
    </head>
    <body>
        <div id="container">
            <div id="modal">
            
            </div>
        </div>
        
        <div class="cms_center">
            <div class="cms"> <!--CMS-->
                <div class="cmsCabecalho">
                    <div class="cmstitulo">
                        <div class="tituloCMS">
                            CMS
                        </div>
                        <div class="titulo_cms">
                           - Sistem de gerenciamento do site
                        </div>
                    </div>
                    <div class="cmsImg">
                    
                    </div>
                </div>
                <div class="cmsMenu"><!--MENU CMS-->
                    <div class="cmsMenuImg">
                        <div class="cmsMenuDados" onclick="AbrirMenu('conteudo')"><!--DADOS DO MENU CMS-->
                            <div class="imgMenucms">
                            
                            </div>
                            <div class="menuNomecms">
                                Adm.Conteúdo
                            </div>
                        </div>
                        <div class="cmsMenuDados" onclick="AbrirMenu('faleconosco')"><!--DADOS DO MENU CMS-->
                            <div class="imgMenucms">
                                
                            </div>
                            <div class="menuNomecms">
                                Adm. Fale Conosco
                            </div>
                        </div>
                        <div class="cmsMenuDados" onclick="AbrirMenu('produtos')"><!--DADOS DO MENU CMS-->
                            <div class="imgMenucms">
                            
                            </div>
                            <div class="menuNomecms">
                                Adm. Produtos
                            </div>
                        </div>
                        <div class="cmsMenuDados" onclick="AbrirMenu('usuario')"><!--DADOS DO MENU CMS-->
                            <div class="imgMenucms">
                            
                            </div>
                            <div class="menuNomecms">
                                Adm. Usuários
                            </div>
                        </div>
                    </div>
                    <div class="campoNomeUsuario">
                        <div class="bemvindouUser">
                            Bem-Vindo, <strong><?php echo utf8_encode ($_SESSION['nome'])?>.</strong>                      
                        </div>
                        <div class="logout">
                            <a href="index.php?sair=sair">
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
                <div class="cmsConteudo"><!--Conteudo-->
                    <div class="Bemvindo"  id="bemvindo">
                        Bem-vindo ao<p> CMS</p>
                    </div>
                    
                    <div class="menuConteudoCms" id="conteudo">  <!--menu conteudo-->
                        <div class="linhaMenuConteuCms">
                            <div class="imgLinhaContCMS">

                            </div>
                            <div class="textLinhaContCMS" id="autores" onclick="ConteudoAutores()">
                                Autores
                            </div>
                        </div>
                        <div class="linhaMenuConteuCms">
                            <div class="imgLinhaContCMS">

                            </div>
                            <div class="textLinhaContCMS" onclick="conteudoLivraria()">
                                Livraria
                            </div>
                        </div>
                        <div class="linhaMenuConteuCms">
                            <div class="imgLinhaContCMS">

                            </div>
                            <div class="textLinhaContCMS" onclick="conteudoLoja()">
                                Lojas
                            </div>
                        </div>
                        <div class="linhaMenuConteuCms">
                            <div class="imgLinhaContCMS">

                            </div>
                            <div class="textLinhaContCMS" onclick="conteudoLivroMes()">
                                Livro do Mês
                            </div>
                        </div>
                        <div class="linhaMenuConteuCms">
                            <div class="imgLinhaContCMS">

                            </div>
                            <div class="textLinhaContCMS" onclick="conteudoPromocoes()">
                                Promoções
                            </div>
                        </div>
                    </div>
                    <div class="menuConteudoCms" id="faleconosco"> <!--menu fale conosco-->  
                        <div class="linhaMenuConteuCms">
                            <div class="imgLinhaContCMS">

                            </div>
                            <div class="textLinhaContCMS" onclick="conteudoFaleConosco()">
                                Fale conosco
                            </div>
                        </div>
                    </div>
                    <div class="menuConteudoCms" id="produtos"> <!--menu produtos-->  
                        <div class="linhaMenuConteuCms" onclick="conteudoProdutos()">
                            <div class="imgLinhaContCMS">

                            </div>
                            <div class="textLinhaContCMS">
                                Produtos
                            </div>
                        </div>
                        <div id="linhaSubMenuConteuCms" onclick="conteudoTabelaProdutos()">
                            <div class="imgLinhaSubContCMS">

                            </div>
                            <div class="textLinhaSubContCMS">
                               Tabela Produtos
                            </div>
                        </div>
                        <div id="linhaMenuConteuCmsCategoria">
                            <div class="imgLinhaContCMS">

                            </div>
                            <div class="textLinhaContCMS" onclick="conteudoCategoria()">
                                Categoria
                            </div>
                        </div>
                        <div class="linhaMenuConteuCms">
                            <div class="imgLinhaContCMS">

                            </div>
                            <div class="textLinhaContCMS" onclick="conteudoSubcategoria()">
                                Subcategoria
                            </div>
                        </div>
                        
                    </div>
                    <div class="menuConteudoCms" id="usuario"> <!--menu usuario-->  
                        <div class="linhaMenuConteuCms">
                            <div class="imgLinhaContCMS">

                            </div>
                            <div class="textLinhaContCMS" id="usuarioNome" onclick="conteudoUsuario()">
                                Usuario
                            </div>             
                        </div>
                        <div class="linhaMenuConteuCms">
                            <div class="imgLinhaContCMS">

                            </div>
                            <div class="textLinhaContCMS" id="nivelUsuario" onclick="conteudoNivelUsuario()">
                                Nivel Usuario
                            </div>
                        </div>
                    </div>
                    <div class="areaconteudoCms" id="areaconteudoCms"><!--Conteudo CMS-->
                    
                    </div>
                </div>
                <div class="cmsRodape">
                    <div class="nomeProgramador">
                        Desenvolvido por: <strong>Nícolas Ruan Silva</strong>
                    </div> 
                </div>
            </div>
        </div>
    </body>
</html>