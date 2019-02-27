
<?php
    require_once('conexao.php');

    $conexao = conexaoDB();
    session_start();
    
    $img = null;
    $checked1 = null;
    $checked0 = null;
    $imagem = "imagens/fundoft.png";
    $historia = null;
    $visao = null;
    $missao = null;
    $ativacao = null;
    $imagem = null;
    $acao = "Inserir";
    $imagem = "imagens/fundoft.png";

    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        //delete Livraria
        if($modo == "excluir"){
            $id = $_GET['id'];
            
            $sql = "Delete from livraria where idLivraria=".$id;
            
            
        }
        //ativar e desativar livraria
        else if($modo == "img"){
            $id = $_GET['id'];
            $ativacao = $_GET['ativacao'];
            
            //SQL atualiza ativacao para 0
            $sql0 = "UPDATE livraria SET ativarDesativar=0";
            mysqli_query($conexao,$sql0);
            //sql atualiza ativacao para 1
            $sql1 = "UPDATE livraria SET ativarDesativar=1 where idLivraria=".$id;
            mysqli_query($conexao,$sql1);        
            
        }
        //editar livraria
        else if($modo == "editar"){
            $id = $_GET['id'];
            $_SESSION['idlivraria'] = $id; 
            
            $sql = "select * from livraria where idLivraria=".$id;
            
            $select = mysqli_query($conexao,$sql);
            
            while($selectEditar =  mysqli_fetch_array($select)){
                $historia = $selectEditar['historia'];
                $visao = $selectEditar['visao'];
                $missao = $selectEditar['missao'];
                $ativacao = $selectEditar['ativarDesativar'];
                $imagem = $selectEditar['slide'];
            }
            
            //ativação do radio
            if($ativacao == 1){
                $checked1 = "checked";  
            }
            else if($ativacao == 0){
                $checked0 = "checked";  
            }  
            
            //botao valer editar
            $acao = "Editar";
            
        }
        
        
        @mysqli_query($conexao, $sql);
        
    }



?>



<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="js/funcoes.js">
<link href="js/jquery.js">
<script src="js/jquery.min.js"></script>
<script src="js/jquery.form.js"></script>


<div class="conteudoLivraria"><!--Conteudo livraria-->
    <div class="dadosLivraria">
        <form action="index.php" method="post" name="frmDados"><!--form dados-->
            <div class="textoLivraria">
                <strong>História:</strong>
            </div>
            <div class="textoLivraria">
               <strong>Visão:</strong> 
            </div>
            <div class="textoLivraria">
                <strong>Missão:</strong>
            </div>
            <div class="areaTextoLivraria">
                <textarea name="txtHistoria" id="areaLivraria"><?php echo utf8_encode ($historia) ?></textarea><!--historia-->
            </div>
            <div class="areaTextoLivraria">
                <textarea name="txtVisao" id="areaLivraria"><?php echo utf8_encode ($visao) ?></textarea><!--visao-->

            </div>
            <div class="areaTextoLivraria">
                <input type="hidden" name="txtfoto" value="<?php echo utf8_encode ($imagem)?>"><!--botao invisivel pega foto-->
                <textarea name="txtMissao" id="areaLivraria"><?php echo utf8_encode ($missao) ?></textarea><!--missao-->

            </div>
            <div class="linha3Livrariab">
                <div class="ativacaoLivraria">
                    <strong>Ativação:</strong><!--Ativação-->
                    <input type="radio" name="ativacao" value="1" <?php echo utf8_encode ($checked1) ?>>Ativar
                    <input type="radio" name="ativacao" value="0" <?php echo utf8_encode ($checked0)?>>Desativar
                </div>
                
                <input type="submit" name="btnSalvarLivraria" id="buttonNivel" class="formatacaoL" value="<?php echo utf8_encode ($acao) ?>">
            </div>
        </form>
        <div class="linha3Livraria">
            <form id="frmfotoLivraria" method="post" action="upload.php" name="frmfotoLivraria" enctype="multipart/form-data">
                <div class="inserirFotoLivraria">
                    <input type="file" name="fleArquivo" id="fotoLivraria">
                </div>
            </form>
            <div class="fotoLivraria">
                <img src="<?php echo utf8_encode ($imagem)?>" width="200px" height="80px">
            </div>
        </div>
    </div>
    <div class="crudLivraria"><!--Crud livraria-->
        <table width="100%" height="100%" border="1">
            <tr>
                <td width="70%">
                    Historia
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
                //lista da livraria
                $sql = "select * from livraria";
                $select = mysqli_query($conexao,$sql);
                
                while($listaLivraria = mysqli_fetch_array($select)){
                       
            
            ?>            
            <tr>
                <td>
                    <?php echo substr($listaLivraria['historia'], 0, 50)."..."?> <!--Historia-->
                </td>
                <td>
                    <img src="imagens/editar.png" width="30px" onclick="editarLivraria(<?php echo($listaLivraria['idLivraria'])?>)"><!--BOTAO EDITAR-->
                </td>
                <td>
                    <img src="imagens/if_delete_678153.png" width="25px" onclick="deletarLivraria(<?php echo($listaLivraria['idLivraria'])?>)"><!--BOTAO DELETAR-->
                </td>
                <?php
                    if($listaLivraria['ativarDesativar'] == 1){
                        $img = 'ativar';
                    }else if($listaLivraria['ativarDesativar'] == 0){
                         $img = 'desativado';
                    }    
                
                ?>
                <td>
                    <img src="imagens/<?php echo($img)?>.png" onclick="ativacaoLivraria(<?php echo($listaLivraria['idLivraria'])?>, <?php echo($listaLivraria['ativarDesativar']) ?>)"><!--ATIVAR E DESATIVAR-->
                </td>
            </tr>
            <?php
                }
            ?>
        </table>
    </div>
</div>

<script>
    //CARREGAR A IMAGEM NA DIV
    $(document).ready(function(){   
        $('#fotoLivraria').live('change',function(){
            $('#frmfotoLivraria').ajaxForm({
                target:'.fotoLivraria'
            }).submit();
        });

    });
    
    
</script>