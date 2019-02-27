<?php 
    
    require_once('conexao.php');
    require_once('login.php');
    $conexao = conexaoDB();
    session_start();

    $acao = "Inserir";
    $checked0 = null;
    $checked1 = null;
    $usuario = null;
    $senha = null;
    $nome = null;
    $selecao = 0;

    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        $id = $_GET['id'];
        
        //excluir usuario
        if($modo == "excluir"){
            
            $sql = "Delete from usuario where idUsuario=".$id;    
           mysqli_query($conexao,$sql); 
        }  
        
        //update para ativar e desativar
        else if($modo == "img"){     
            $ativacao = $_GET['ativacao'];
            //ativa usuario
            if($ativacao == 0){
                $sql = "UPDATE usuario SET AtivarDesativar=1 WHERE idUsuario =".$id;
                mysqli_query($conexao,$sql); 
            }
            //desativa usuario
            else if($ativacao == 1 ){
                //verrifica se o usuario esta tentando desativar ele mesmo
                if($_SESSION['LoginV'] == $id){
                    echo("<script>alert('usuario em uso, não é possivel desativá lo')</script>");
                }else{
                   $sql = "UPDATE usuario SET AtivarDesativar=0 WHERE idUsuario=".$id; 
                    mysqli_query($conexao,$sql); 
                }
            }   
        }
        //EDITAR USUARIO
        else if($modo == "editar"){
            
            $id = $_GET['id'];
            $_SESSION['idUsuario'] = $id;

            $sql = "select usuario.*,nivelusuario.nivel as nomeNivel from usuario, nivelusuario where usuario.idUsuario=".$id." and usuario.nivel=nivelusuario.idNivelusuario";
            
            $select = mysqli_query($conexao,$sql);
            
            while($usuarioDados = mysqli_fetch_array($select)){
                
                $nome = $usuarioDados['nome'];
                $usuario = $usuarioDados['usuario'];
                $senha = $usuarioDados['senha'];
                $nivel = $usuarioDados['nivel'];
                $ativacao = $usuarioDados['AtivarDesativar'];
                $nomeNivel = $usuarioDados['nomeNivel'];
            }
            
            //ATIVACAO
            if($ativacao == 0){
                $checked0 = "checked";
            }
            else if( $ativacao == 1){
                $checked1 = "checked";
            }
            
            $acao = "Editar";
            mysqli_query($conexao,$sql); 
        }
        
        
        
    }


?>

<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="js/funcoes.js">
<link href="js/jquery.js">


<div class="conteudoUsuario">
    <div class="cadastroUsuario">
        <form method="POST" name="frmUsuario" action="index.php" >
            <div class="linhaUsuario">
                <div class="nomeUsuario">
                    <strong>Nome:</strong><input type="text" name="txtnomeUsuario" value="<?php echo($nome)?>"><!-- NOME-->
                </div>
                <div class="nomeUsuario">
                    <strong>Usuario:</strong><input type="text" name="txtUsuario" value="<?php echo($usuario)?>"><!-- USUARIO-->
                </div>
                <div class="nomeUsuario">
                    <strong>Senha:</strong><input type="password" name="txtSenhaUsuario" value="<?php echo($senha)?>"><!-- SENHA-->
                </div>
            </div>
            <div class="linhaNivel">
                <div class="comboNomeNivel">                
                    <!--Carregar o nivel do Usuario no comboBox-->
                    <select name='nivelU' id="comboUsuario">
                       <?php 
                            if($modo == "editar"){
                                $selecao = $nomeNivel;
                            }else{
                                $selecao = "Selecione Nivel";
                            }
                        
                        ?>
                        
                        <option value="<?php echo($nivel)?>"><?php echo($selecao) ?></option>                       
                        <?php
                            $sql = "SELECT idNivelUsuario, nivel from nivelusuario where nivelusuario.ativarDesativar = 1 and nivel != '".$selecao."'";
                            
                            $select = mysqli_query($conexao, $sql);

                
                            while($dadosNivel = mysqli_fetch_array($select)){                       
                                echo("<option value='".$dadosNivel['idNivelUsuario']."'>". $dadosNivel['nivel'] . "</option>");
                            
                            }

                        ?>
                    </select>
                </div>
                <div class="ativaUsuario">
                    <strong>Ativação:</strong><!--Ativação-->
                    <input type="radio" name="ativacao" value="1" <?php echo($checked1)?>>Ativar
                    <input type="radio" name="ativacao" value="0" <?php echo($checked0)?>>Desativar
                </div>
            </div>
            <div class="salvarUsuario">
                 <input type="submit" name="btnUsuarioSalvar" id="buttonNivel" value="<?php echo($acao)?>">       
            </div>
        </form>
    </div>  
    <div class="crudUsuario">
        <table width="100%" height="100%" border="1">
            <tr height="10%">
                <td width="23%">
                    Nome:
                </td>
                <td width="23%">
                    Usuario:
                </td>
                <td width="23%">
                    Senha:
                </td>
                <td width="10%">
                    Editar
                </td>
                <td width="10%">
                    Excluir
                </td>
                <td width="10%">
                    Ativar/Desativar
                </td>
            </tr>
            <?php 
                //CARREGAR OS DADOS NA TABELA
                $sql = "Select * from usuario";
                
                $select = mysqli_query($conexao,$sql);
            
                while($usuario = mysqli_fetch_array($select)){
            
            ?>
            
            <tr>
                <td>
                    <?php echo utf8_encode ($usuario['nome']) ?><!--NOME-->
                </td>
                <td>
                    <?php echo utf8_encode ($usuario['usuario']) ?><!--USUARIO-->
                </td>
                <td>
                    <input type="password" value="<?php echo($usuario['senha']) ?>" disabled>
                    
                </td><!--SENHA-->
                <td>
                    <img src="imagens/editar.png" width="30px" onclick="EditarUsuario(<?php echo($usuario['idUsuario']) ?>)">
                </td><!--BOTAO EDITAR-->
                <td>
                    <img src="imagens/if_delete_678153.png" width="25px" onclick="deletarUsuario(<?php echo($usuario['idUsuario'])?>)"><!--BOTAO DELETAR-->
                </td>
                <td>
                    <?php
                        if($usuario['AtivarDesativar'] == 1){
                            $img = "ativar";
                        }
                        else if($usuario['AtivarDesativar'] == 0){
                            $img = "desativado";
                        }     
                
                    ?>                   
                    <img src="imagens/<?php echo($img)?>.png" onclick="AtivarDesativarUsuario(<?php echo($usuario['idUsuario'])?>,<?php echo($usuario['AtivarDesativar'])?>)"><!--ATIVAR E DESATIVAR-->
                </td>
            </tr>
            <?php
                }
            ?>
        </table>
    </div>
</div>
