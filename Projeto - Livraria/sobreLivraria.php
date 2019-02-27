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
        <div class="centerSobreLivraria">
            <?php
                //select livros
                $sql = "select * from livraria where ativarDesativar=1";
                $select = mysqli_query($conexao, $sql);
            
                while($dadosLivraria = mysqli_fetch_array($select)){
            
            ?>
            
            <div class="imgSobreLibraria"><!--imagem-->
                <img  src="CMS/<?php echo utf8_encode($dadosLivraria['slide'])?>">
            </div>
            <div class="descricaoLivroMes"> <!--historia-->
                <div class="tituloDescricaoMes">
                    <label>História</label>
                </div>
                <div class="conteudoDescricao">
                    <p><?php echo utf8_encode ($dadosLivraria['historia'])?></p>     
                </div>
            </div>
            <div class="descricaoLivroMes"> <!--missao-->
                <div class="tituloDescricaoMes">
                    <label>Missão</label>
                </div>
                <div class="conteudoDescricao">
                    <p><?php echo utf8_encode ($dadosLivraria['missao'])?></p>

                    
                </div>
            </div>
            <div class="descricaoLivroMes"> <!--visao-->
                <div class="tituloDescricaoMes">
                    <label>Visão</label>
                </div>
                <div class="conteudoDescricao">
                    <p><?php echo utf8_encode ($dadosLivraria['visao'])?></p>
                </div>
            </div>
            <?php
                }
            ?>
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
                            TEL: (11) 9999-9999
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
    </body>
</html>