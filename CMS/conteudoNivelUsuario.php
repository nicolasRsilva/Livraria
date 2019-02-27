<?php 
    
    require_once('conexao.php');
    $conexao = conexaoDB();
    session_start();
    
    $nome = null;
    $nivel = null;
    $checked1 = null;
    $checked0 = null;
    //acao é carregado no botao salvar. é o valor do botao
    $acao = "Inserir";

    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        //EXCLUIR
        if($modo == "excluir"){
            $id = $_GET['id'];
            $sql = "delete from nivelusuario where idNivelUsuario=".$id;
            
            mysqli_query($conexao, $sql);
        }
        //EDITAR
        else if($modo == "editar"){
            $id = $_GET['id'];
            $sql = "select * from nivelusuario where idNivelUsuario=".$id;
            
            $_SESSION['id']=$id;
            
            $select = mysqli_query($conexao,$sql);
            
            //pegando os dados
            if($consulta=mysqli_fetch_array($select)){
                $nome = $consulta['nivel'];
                $nivel = $consulta['ativarDesativar'];
            }
            
            if($nivel == 1){
                $checked1 = "checked";
            }
            else if($nivel == 0){
                $checked0 = "checked";
            }
            //acao é carregado no botao salvar. é o valor do botao
            $acao = "Editar";
        }
        //MUDAR IMAGEM PARA ATIVADO E DESATIVADO
        else if($modo == "img"){
            $id = $_GET['id'];
            $ativacao = $_GET['ativacao'];
            
            $sqlVerificacao = "select usuario.usuario from usuario, nivelUsuario where usuario.nivel = ".$id;
            $selectVerificacao = mysqli_query($conexao, $sqlVerificacao);
            $verificaNivel = mysqli_fetch_array($selectVerificacao);
              
            if($ativacao == 0){ 
                $sql = "UPDATE NivelUsuario SET ativarDesativar=1 where idNivelUsuario=".$id;
            }
            else if($ativacao == 1){
                if($verificaNivel['usuario'] == ""){
                    $sql = "UPDATE NivelUsuario SET ativarDesativar=0 where idNivelUsuario=".$id;
                }else{
                    echo("<script>alert('Esse nivel esta sendo usado não é possivel desativo')</script>");
                }
            }
            
            @mysqli_query($conexao,$sql);
        }
            
    }

 
?>

<script src="js/jquery.js"></script>
<script src="js/funcoes.js"></script>

<div class="conteudoNivelUsuario">
    <div class="cadastroNivelUsuario">
       <div class="bordaNivel">    
            <form method="POST" name="fmrNivel" action="index.php">
               <div class="centroNivelUsuario">
                    <div class="colunaNivelUsuario">
                        <div class="nomedadosNivel">
                            <strong>Nome:</strong><!-- NOME-->
                        </div>
                        <div class="dadosFaleConosco">
                            <input type="text" name="txtNomeNivel" value="<?php echo($nome)?>">
                        </div>

                    </div>
                    <div class="colunaNivelUsuario">
                        <div class="nomedadosNivel">
                            <strong>Ativação:</strong><!-- ATIVACAO-->
                        </div>
                        <div class="dadosFaleConosco">
                            <input type="radio" name="ativacao" value="1" <?php echo($checked1)?> >Ativar
                            <input type="radio" name="ativacao" value="0" <?php echo($checked0)?>>Desativar
                        </div>
                    </div>
               </div> 


                <div class="botaoNivelUsuario"><!-- SUBMIT-->
                    <input type="submit" name="enviarNivel" id="buttonNivel" value="<?php echo($acao)?>">
                </div>

            </form>
        </div>
    </div>
    <div class="crudNivelUsuario">
        <table width="100%" height="100%" border="1">
            <tr height="10%">
                <td width="70%">
                    Nome Nivel:
                </td>
                <td width="10%">
                    Editar
                </td>
                <td width="10%">
                    Excluir
                </td>
                <td width="10%">
                    Ativar/desativar
                </td>         
            </tr>
            <?php 
                //CARREFAR DADOS NA TABELA
                $sql = "SELECT * FROM NivelUsuario order by nivel desc";
                    
                $select = mysqli_query($conexao,$sql);
            
                while($dadosNivel = mysqli_fetch_array($select)){                 
            
            ?>
            <tr>
                <td>
                   <?php echo utf8_encode ($dadosNivel['nivel'])?><!-- NIVEL-->
                </td>
                <td>
                    <a href="#" onclick="editarNivelUsuario(<?php echo($dadosNivel['idNivelUsuario'])?>)">
                        <img src="imagens/editar.png" width="30px"><!-- EDITAR-->
                    </a>
                </td>
                <td>
                    <img src="imagens/if_delete_678153.png" width="25px" onclick="deletarNivelUsuario(<?php echo($dadosNivel['idNivelUsuario'])?>)"><!-- DELETAR-->
                </td>
                <td>
                    <!-- ATIVACAO-->
                    <?php 
                        if($dadosNivel['ativarDesativar'] == 1){
                            $img = "ativar";
                        }
                        else if($dadosNivel['ativarDesativar'] == 0){
                            $img = "desativado";
                        }                       
                    
                    ?>
                    <a href="#" onclick="ativarDesativar(<?php echo($dadosNivel['idNivelUsuario'])?> , <?php echo($dadosNivel['ativarDesativar'])?>)">
                        <img src="imagens/<?php echo($img)?>.png"><!-- ATIVAR E DESATIVAR-->
                    </a>
                </td>         
            </tr>
            <?php 
                }
            ?>
        </table>
    </div>
    
</div>




