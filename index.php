<?php
    
    require_once('conexao.php');
    $conexao = conexaoDB();
    session_start();
    

    //enviar para cms
    if(isset($_POST['btnSenha'])){
        
        $idBanco = null;
        $valido = null;
        $usuario = $_POST['txtLogin'];
        $senha = $_POST['txtSenha'];
        
        $sql = "SELECT idUsuario,nome from usuario as u where u.usuario='".$usuario."' and u.senha='".$senha."' and AtivarDesativar = 1;";
            
        $select = mysqli_query($conexao, $sql);
        
        while($valido = mysqli_fetch_array($select)){
            $idBanco = $valido['idUsuario'];
            $nomeUsuario = $valido['nome'];
        }    
        $_SESSION['LoginV'] = $idBanco;
        //se não diferente de nada envia para cms
        if($idBanco != null){
            //envia para cms se usuario e senha tiver ok
            header('location:CMS/index.php');
            //variavel para empedir o usuario de entrar sem estiver logado
            $_SESSION['validacao'] = "OK";
            //variavel para mostra o nome do usuario no cms
            $_SESSION['nome'] = $nomeUsuario;
        }else{
            echo("<script>alert('dados incorretos')</script>");
        }        
    }

?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Livraria</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="css/jquery.excoloSlider.css" rel="stylesheet">
        <script src="javascripts/jquery-1.9.1.min.js"></script>
        <script src="javascripts/jquery.excoloSlider.js"></script>
        <script>
            $(function () {
                $("#slider").excoloSlider();
            });
        </script>
    </head>
    <body>
        <header>
        </header>
        <nav class="menu">
            <div class="menuCenter">
                <a href="index.php">                
                    <div id="logo"> <!--logo-->

                    </div>
                </a>
                <div class="menuEspaco">
                    <div class="menuConteudo">
                        <a href="autores.php">
                            Autores
                        </a>
                    </div>
                    <div class="menuConteudo">
                        <a href="sobreLivraria.php">
                            Livraria 
                        </a>
                    </div>
                    <div class="menuConteudo">
                        <a href="promocoes.php">
                            Promoções
                        </a>
                    </div>
                    <div class="menuConteudo">
                        <a href="nossasLojas.php">
                            Lojas 
                        </a>
                    </div>
                    <div class="menuConteudo">
                        <a href="livroDoMes.php">
                            Livro do Mês
                        </a>             
                    </div>
                    <div class="menuConteudo">
                        <a href="faleConosco.php">
                             Fale Conosco
                        </a>      
                    </div>
                </div>
                <div class="login">
                    <form method="POST" name="frmEnviar"  action="index.php" >
                        <div class="loginEntradaDados">
                            <div class="loginNomesTexto">
                                Usuário:
                            </div>
                            <div class="loginNomes">
                                <input type="text"  name="txtLogin" class="btnLogin">
                            </div>
                        </div>
                        <div class="loginEntradaDados">
                            <div class="loginNomesEntradaTexto">
                                Senha:
                            </div>
                            <div class="loginNomesEntrada">
                                <input type="password" name="txtSenha" class="btnLogin">
                                <input type="submit" name="btnSenha" value="ok" > 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
        <div class="centrotudo">
            <div class="conteudoCenter"> <!--Conteudo-->
                <div class="caixaHeader">
                    <div class="header">
                        <div id="slider">
                            <img src="images/image1.jpg" alt="erro">
                            <img src="images/image2.jpg" alt="erro">
                            <img src="images/image3.jpg" alt="erro">
                            <img src="images/image4.jpg" alt="erro">
                            <img src="images/image5.jpg" alt="erro">
                            <img src="images/image6.jpg" alt="erro">
                        </div>
                    </div>                
                </div>
                <div id="center">
                    <div class="pesquisa">
                        <div class="textoPesquisa"><!--pesquisa-->
                            <input type="text" id="txtPesquisa" class="txtPesquisa" placeholder="Pesquisa" onkeypress="pesquisa(this.value);">
                        </div>
                    </div>
                    <div class="itens"><!--todos os itens-->
                        <?php 
                            //select de categorias    

                            $sql = "select * from categoria";
                            $select = mysqli_query($conexao,$sql);
                            
                            while($categoriaDa = mysqli_fetch_array($select)){ 
                        
                        ?>           
                        <div class="itensConteudo"> 
                            <!--categoria - chama a função que carrega categoria-->
                            <div class="categoria" onclick="menuCategoria(<?php echo($categoriaDa['idcategoria']) ?>)">
                                <!--nome categoria-->
                                <?php echo utf8_encode($categoriaDa['nome'])?>
                            </div>
                            
                            <!--Subcategoria-->
                            <div class="Subcategoria"><!--Itens Subcategoria-->
                                <?php 
                                    //select subCategoria       

                                    $sqlSub = "select subcategoria.* from subcategoria,categoria where categoria.idcategoria=".$categoriaDa['idcategoria']." and subcategoria.idCategoria=".$categoriaDa['idcategoria'];

                                    $selectSub = mysqli_query($conexao,$sqlSub);

                                    while($subCategoria = mysqli_fetch_array($selectSub)){

                                ?>
                                <!--nome subCategoria - chama a função que carrega subCategoria-->
                                <div class="itensConteudo" onclick="menuSubcategoria(<?php echo($subCategoria['idsubCategoria']) ?>)">
                                    <?php echo utf8_encode($subCategoria['nome'])?>  
                                </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <?php
                            }
                        ?> 
                    </div>
                    <div class="conteudo">
                        <div class="linhaConteudo" id="linhaConteudo">
                            <?php                               
                                
                                
                                //select de produtos aleatorios
                                $sql = "Select * from produtos ORDER BY rand()";
                            
                                $select = mysqli_query($conexao,$sql);
                                
                                while($aleatorioProdutos = mysqli_fetch_array($select)){

                            ?>
                            
                            <div class="quadradoConteudo" id="quadrado">
                                <div class="imgConteudo">
                                    <img src="CMS/<?php echo($aleatorioProdutos['imagem']) ?>">
                                </div>
                                <div class="dadosQuadrado">
                                    <div class="nomeProdutoNome">
                                        <strong>Nome:</strong> <?php echo utf8_encode($aleatorioProdutos['nome'])?>
                                    </div>
                                    <div class="nomeProduto">
                                        <strong>Descrição:</strong> <?php echo substr ($aleatorioProdutos['descricao'],0,20)."..."?>
                                    </div>
                                    <div class="nomeProdutoPreco">
                                        <div class="nomeProdutoPc">
                                            <strong>Preço:</strong> R$<?php echo  utf8_encode($aleatorioProdutos['preco']).",00"?>
                                        </div>
                                        <div class="detalhe">
                                            <a href="#">
                                                <strong>Detalhes
                                                </strong>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>    
            </div>
            <div class="redes">
                <div class="comunidadesWhats">
                    
                </div>
                <div class="comunidadesface">
                    
                </div>
                <div class="comunidadesinstagram">     
                    
                </div>     
            </div>
        </div>
        <div id="rodape">
            <div class="rodapeCenter">
                <div class="rodapeDivisao">
                    <div class="rodapeTituloContato">
                        CONTATO
                    </div>
                    <div class="imgContato">
                        <div class="rodapeImgCont">
                        </div>
                    </div>
                    <div class="rodapeContato">
                        <div class="rodapeTelContato">
                            <p>TEL: (11) 9999-9999</p><br>
                            CEL: (11) 9 9999-9999
                        </div>
                    </div>
                </div>
                <div class="rodapeDivisao">
                    <div class="rodapeTituloContato">
                        LOCALIZAÇÃO
                    </div>
                    <div class="imgContato">
                        <div class="rodapeImgLoca">
                        </div>
                    </div>
                    <div class="rodapeContato">
                        <div class="rodapeLocalizacao">
                            Av.João Europa, 78 - Jardim Bela vida,
                            São Paulo -
                            Cep:00000-000
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            
            //função para descarregar Categorias
            function menuCategoria(id){
                
                $.ajax({
                    type:"GET",
                    url:"conteudoCategoria.php?modo=categoria&id="+id,
                    success:function(dados){
                        $('.linhaConteudo').html(dados)                        
                    }
                    
                })      
                
            }
            //função para descarregar subCategorias
            function menuSubcategoria(id){
                $.ajax({
                    type:"GET",
                    url:"conteudoSubCategoria.php?modo=sub&id="+id,
                    success:function(dados){
                        $('.linhaConteudo').html(dados)
                        
                    }
                }) 
            }
        
            //função que descarrega aquilo que usuario esta digitando
            function pesquisa(palavra){
                 $.ajax({
                    type:"GET",
                    url:"conteudoPesquisa.php?palavra="+palavra,
                    success:function(dados){
                        $('.linhaConteudo').html(dados)
                        
                    }
                })
                
            }
        
        </script>
    </body>
</html>
