<?php
    require_once('conexao.php');
    $conexao = conexaoDB();
    session_start();

    $img = null;
    $acao = "Inserir";
    $checked0 = null;
    $checked1 = null;
    $cidade = null;
    $telefone = null;
    $celular = null;
    $ativacao = null;
    $logradouro = null;

    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        //delete Lojas
        if($modo == "excluir"){
            $id = $_GET['id'];
            
            $sql = "Delete from lojas where idLojas=".$id;
        
        }
        //ativar e desativar lojas
        else if($modo == "img"){
            $id = $_GET['id'];
            $ativacao = $_GET['ativacao'];
            
            if($ativacao == 0){
                $sql = "Update lojas set ativarDesativar=1 where idLojas=".$id;
            }    
            else if($ativacao == 1){
                $sql = "Update lojas set ativarDesativar=0 where idLojas=".$id;
            }        
        }
        //EDITAR USUARIO
        else if($modo == "editar"){
            $id = $_GET['id'];
            $_SESSION['idLojas'] = $id;

            $sql = "select * from lojas where idLojas=".$id;
            
            $select = mysqli_query($conexao,$sql);
            
            while($lojasDados = mysqli_fetch_array($select)){
                $cidade = $lojasDados['cidade'];
                $telefone = $lojasDados['Telefone'];
                $celular = $lojasDados['celular'];
                $ativacao = $lojasDados['ativarDesativar'];
                $logradouro = $lojasDados['endereco'];
            }
            
            //ATIVACAO
            if($ativacao == 0){
                $checked0 = "checked";
            }
            else if($ativacao == 1){
                $checked1 = "checked";
            }
            
            $acao = "Editar"; 
        }
        
        mysqli_query($conexao,$sql);
        
    }
    
?>


<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="js/funcoes.js">
<link href="js/jquery.js">
<script src="js/jquery.min.js"></script>
<script src="js/jquery.form.js"></script>


<div class="conteudoLivraria"><!--Conteudo livraria-->
    <div class="dadosLoja">
        <form action="index.php" method="post" name="frmDados"><!--form dados-->
            <div class="conteudoloja">
                <div class="coluna1loja">
                    <div class="linhaDadoslivraria">
                        <div class="nomecampoLoja">
                            <strong>Cidade:</strong>
                        </div>
                        <div class="dadosCampoLoja"><!--Cidade-->
                            <input type="text" name="txtCidade" value="<?php echo utf8_encode($cidade)?>">
                        </div>
                    </div>
                    <div class="linhaDadoslivraria">
                        <div class="nomecampoLoja">
                            <strong>Telefone:</strong>
                        </div>
                        <div class="dadosCampoLoja"><!--Telefone-->
                            <input type="text" name="txtTelefone" value="<?php echo utf8_encode ($telefone)?>">
                        </div>
                    </div>
                    <div class="linhaDadoslivraria">
                        <div class="nomecampoLoja"><!---->
                            <strong>Celular:</strong>
                        </div>
                        <div class="dadosCampoLoja"><!--Celular-->
                            <input type="text" name="txtCelular" value="<?php echo utf8_encode ($celular)?>">
                        </div>
                    </div>
                    <div class="linhaDadoslivraria">
                        <div class="nomecampoLoja">
                           <strong>Ativação:</strong>
                        </div>
                        <div class="dadosCampoLoja"><!--Ativação-->
                            <input type="radio" name="ativacao" value="1" <?php echo utf8_encode ($checked1) ?>>Ativar
                            <input type="radio" name="ativacao" value="0" <?php echo utf8_encode ($checked0) ?>>Desativar
                        </div>
                    </div>
                </div>
                <div class="coluna2loja">
                    <div class="linhaAreaLoja">
                        <strong>Logradouro:</strong>
                    </div>
                    <div class="dadosAreaLoja">
                        <textarea name="txtLogradouro" id="areaLoja"><?php echo utf8_encode ($logradouro)?></textarea>
                    </div>
                </div>
            </div>
            <div class="linha3Loja"> <!--input dados-->
                <input type="submit" name="btnSalvarLoja" id="buttonNivel" value="<?php echo utf8_encode ($acao) ?>" class="formataLoja3">
            </div>
        </form>
    </div>
    <div class="crudLoja">
        <table width="100%" height="100%" border="1">
            <tr>
                <td width="30%">
                    Cidade
                </td>
                <td width="40%">
                    Logradouro
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
                $sql = "select * from lojas";
                $select = mysqli_query($conexao,$sql);
            
                while($dadosLojas = mysqli_fetch_array($select)){
            
            ?>
            <tr>
                <td>
                    <?php echo utf8_encode ($dadosLojas['cidade'])?>
                </td>
                <td>
                    <?php echo utf8_encode ($dadosLojas['endereco'])?>
                </td>
                <td>
                    <img src="imagens/editar.png" width="30px" onclick="editarLojas(<?php echo($dadosLojas['idLojas']);?>)"><!--BOTAO EDITAR-->
                </td>
                <td>
                    <img src="imagens/if_delete_678153.png" width="25px" onclick="deletarLojas(<?php echo($dadosLojas['idLojas']);?>)"><!--BOTAO DELETAR-->
                </td>
                <?php
                    if($dadosLojas['ativarDesativar'] == 1){
                        $img = "ativar";
                    }else if($dadosLojas['ativarDesativar'] == 0){
                        $img = "desativado";
                    }
                ?>
                <td>
                    <img src="imagens/<?php echo($img)?>.png" onclick="ativacaoLojas(<?php echo($dadosLojas['idLojas']) ?>,<?php echo($dadosLojas['ativarDesativar']) ?>)"><!--ATIVAR E DESATIVAR-->
                </td>
            </tr>
            <?php
                }
            ?>
        </table>
    </div>

</div>