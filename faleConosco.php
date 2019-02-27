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


    if(isset($_GET["btnSalvar"])){
        
        $nome = $_GET["txtNome"];
        $email = $_GET["txtEmail"];
        $celular = $_GET["txtCelular"];
        $sexo = $_GET["rdoSexo"];
        $profissao = $_GET["txtProfissao"];
        $telefone = $_GET["txtTelefone"];
        $homePage = $_GET["txtHomePage"];
        $linkFacebook = $_GET["txtLinkFacebook"];
        $sugestao = $_GET["txtSugestao"];
        $informacoesProduto = $_GET["txtInforcoesProduto"];
        
        $sql = "INSERT INTO FaleConosco(nome, email, celular, sexo, profissao, telefone, home, facebook, sugestao, informacoesProdutos) VALUES ('".$nome."','".$email."','".$celular."','".$sexo."','".$profissao."','".$telefone."','".$homePage."','".$linkFacebook."','".$sugestao."','".$informacoesProduto."')";


        mysqli_query($conexao,$sql);
        
        echo("<script>alert('Dados Salvo, obrigado!')</script>");
        
    }


?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Livraria</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="javascripts/jquery-1.9.1.min.js"></script>
        <script src="javascripts/jquery.excoloSlider.js"></script>
        <link href="css/jquery.excoloSlider.css" rel="stylesheet">
        <!--slider-->
        <script>
            $(function () {
                $("#slider").excoloSlider();
            });             
        </script>
        <!--Validação-->
        <script>
            function Validar(caracter, name, campo){
		
                document.getElementById(campo).style="background-color:white;";
                
                //navegador
                if(window.event)
                    //Quando o ascii da letra digitada pelo usuario
                    var letra = caracter.charCode;
                else
                    //Quando o ascii da letra digitada pelo usuario
                    var letra = caracter.which;
                
                //verifica se é  caracter ou número
                if(name == "letra"){
					//bloqueia numero
                    if( letra >47 && letra < 58){
                        document.getElementById(campo).style="background-color:red;";
                        return false;
                    }
                    
                }
                else if(name == "numero"){
					//bloqueia letra
                    if(letra < 48 || letra > 57){
                        document.getElementById(campo).style="background-color:red;";
                        return false;
                    }
                    
                }
                
                
            }
        
        </script>
    </head>
    <body>
        <header>
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
        </header>
        <div class="conteudoCenterFaleConosco"> <!--Conteudo-->    
            <div class="caixaFaleConosco">
                <div class="bordaFaleConosco">
                    <form name="faleConosco" method="get" action="faleConosco.php">
                        <div class="metadeBorda">
                            <div class="linhaDados">               
                                <div class="linhaInfo">
                                    <label>Nome:</label>
                                </div>
                                <div class="linhaCampo">
                                    <input type="text" id="nome" name="txtNome" value="" class="bordaCaixas" required onKeypress="return Validar(event, 'letra', this.id);">
                                </div>
                            </div>
                            <div class="linhaDados">
                                <div class="linhaInfo">
                                    <label>Email:</label>
                                </div>
                                <div class="linhaCampo">
                                    <input type="text" id="email" name="txtEmail" value="" class="bordaCaixas" required>
                                </div>           
                            </div>
                            <div class="linhaDados">       
                                <div class="linhaInfo">
                                    <label>Telefone:</label>  
                                </div>
                                <div class="linhaCampo">
                                    <input type="text" id="numero" name="txtTelefone" value="" class="bordaCaixas" placeholder="EX: 4142-0987" pattern="[0-9]{4}[-][0-9]{4}" > 
                                </div>      
                            </div>
                            <div class="linhaDados">
                                <label>Sexo:</label>
                                <input type="radio" name="rdoSexo" value="M" class="bordaCaixas" style="width:20px; height:20px;" required><label>Masculino</label>
                                <input type="radio" name="rdoSexo" value="F" class="bordaCaixas" style="width:20px; height:20px;"><label>Feminino</label>

                            </div>

                            <div class="linhaBotao">                             
                                <label>Sugestão/Criticas:</label> 
                                <div class="areaCenter"
                                     ><textarea name="txtSugestao" class="bordaCaixas" style="width:400px; height:200px;"></textarea>
                                    
                                </div> 
                            </div>
                            <div class="botao">
                                <input type="submit" name="btnSalvar" value="Salvar" class="bordaBotao">        
                            </div>
                        </div>
                        <div class="metadeBorda">
                            <div class="linhaDados">
                                <div class="linhaInfo">
                                    <label>Profissão:</label>
                                </div>
                                <div class="linhaCampo">
                                    <input type="text" id="profissao" name="txtProfissao" value="" class="bordaCaixas" required onKeypress="return Validar(event, 'letra', this.id);">
                                </div>                 
                            </div>
                            <div class="linhaDados">
                                <div class="linhaInfo">
                                    <label>Facebook:</label>
                                </div>
                                <div class="linhaCampo">
                                    <input type="text" name="txtLinkFacebook" value="" class="bordaCaixas">
                                </div>
                            </div>
                            <div class="linhaDados">
                                <div class="linhaInfo">
                                    <label>Celular:</label> 
                                </div>
                                <div class="linhaCampo">
                                    <input type="text" id="celular" name="txtCelular" value="" class="bordaCaixas" required placeholder="EX: 11 99876-0978" pattern="[0-9]{2}[ ][9][0-9]{4}[-][0-9]{4}"> 
                                </div>
                            </div>
                            <div class="linhaDados">
                                <div class="linhaInfo">
                                    <label>Home:</label> 
                                </div>
                                <div class="linhaCampo">
                                    <input type="text" id="home" name="txtHomePage" value="" class="bordaCaixas" onKeypress="return Validar(event, 'letra', this.id);">
                                </div>                                 
                            </div>
                            <div class="linhaBotao">
                                <label>Informações de Produtos: </label>
                                <div class="areaCenter">
                                    <textarea  name="txtInforcoesProduto" class="bordaCaixas" style="width:400px; height:200px;"></textarea>
                                </div>
                            </div>
                            <div class="botao">
                                <input type="reset" name="btnSalvar" value="Limpar" class="bordaBotao">        
                            </div>
                        </div>  
                    </form>
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