<script src="js/jquery.js"></script>
<script src="js/funcoes.js"></script>

<?php
    require_once('conexao.php');
    session_start();

    $conexao = conexaoDB();
    
    $acao = "Salvar";
    $sql = null;
    $nome = "";
    $ativacao = "";
    $checked1 = null;
    $checked0 = null;

    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        $id = $_GET['id'];
        
        //ativar e desativar imagem
        if($modo == "img"){
            $ativacao = $_GET['ativacao'];
            if($ativacao == 1){
                $sql = "UPDATE categoria set ativarDesativar=0 where idcategoria=".$id;
                
            }else{
                $sql = "UPDATE categoria set ativarDesativar=1 where idcategoria=".$id;
            }   
        }
        else if($modo == "excluir"){
            $sql= "Delete from categoria where idcategoria=".$id;
        }
        else if($modo == "editar"){
            $acao = "Editar";
            $id = $_GET['id'];
            $_SESSION['idcategoria'] = $id;
            
            $sql = "select * from categoria where idCategoria=".$id;
            
            $select = mysqli_query($conexao, $sql);
            
            while($dadosCategoria = mysqli_fetch_array($select)){
                $nome = $dadosCategoria['nome'];
                $ativacao = $dadosCategoria['ativarDesativar'];
            }
            
            if($ativacao == 1){
                $checked1 = "checked";
            }else{
                $checked0 = "checked";
            }

        }
        
        mysqli_query($conexao,$sql);
    }
    

?>

<div class="conteudoNivelUsuario">
    <div class="cadastroNivelUsuario">
       <div class="bordaNivel">    
            <form method="POST" name="fmrCategoria" action="index.php">
               <div class="centroNivelUsuario">
                    <div class="colunaNivelUsuario">
                        <div class="nomedadosNivel">
                            <strong>Nome:</strong><!-- NOME-->
                        </div>
                        <div class="dadosFaleConosco">
                            <input type="text" name="txtNomeCategoria" value="<?php echo($nome)?>">
                        </div>

                    </div>
                    <div class="colunaNivelUsuario">
                        <div class="nomedadosNivel">
                            <strong>Ativação:</strong><!-- ATIVACAO-->
                        </div>
                        <div class="dadosFaleConosco">
                            <input type="radio" name="ativacao" value="1" <?php echo($checked1)?>>Ativar
                            <input type="radio" name="ativacao" value="0" <?php echo($checked0)?>>Desativar
                        </div>
                    </div>
               </div> 


                <div class="botaoNivelUsuario"><!-- SUBMIT-->
                    <input type="submit" name="enviarCategoria" id="buttonNivel" value="<?php echo($acao)?>">
                </div>

            </form>
        </div>
    </div>
    <div class="crudNivelUsuario">
        <table width="100%" height="100%" border="1">
            <tr height="10%">
                <td width="70%">
                    Nome:
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
            <!--Select Categoria-->
            <?php
                $sql = "Select * from categoria";
            
                $select = mysqli_query($conexao, $sql);
            
                while($dadosCategoria = mysqli_fetch_array($select)){
            
            ?>
            <tr>
                <td>
                    <!--Nome categoria-->
                    <?php echo utf8_encode($dadosCategoria['nome']) ?>
                </td>
                <td>
                    <a href="#">
                        <img src="imagens/editar.png" width="30px" onclick="editar(<?php echo($dadosCategoria['idcategoria']) ?>,'conteudoCategoria')"><!-- EDITAR-->
                    </a>     
                </td>
                <td>
                    <a href="#">
                        <img src="imagens/if_delete_678153.png" width="25px" onclick="deletar(<?php echo($dadosCategoria['idcategoria']) ?>,'conteudoCategoria')"><!-- DELETAR-->
                    </a>
                    
                </td>
                <td>
                    <!-- ATIVACAO-->
                    <?php 
                       if($dadosCategoria['ativarDesativar']==1){
                           $img = "ativar";
                       }else{
                           $img = "desativado";
                       }
                        
                    ?>
                    <a href="#">
                        <img src="imagens/<?php echo($img)?>.png" onclick="ativacao(<?php echo($dadosCategoria['idcategoria'])?>,<?php echo($dadosCategoria['ativarDesativar']) ?>,'conteudoCategoria')"><!-- ATIVAR E DESATIVAR-->
                    </a>
                </td>         
            </tr>
            <?php
                }
            ?>
        </table>
    </div>
    
</div>




