<?php

    require_once('conexao.php');
    $conexao = conexaoDB();
    session_start();

    $acao = "Inserir";

    $checked1 = null;
    $checked0 = null;
    $nome = null;
    $descricao = null;
    $ativacao = null;
    $imagem = "imagens/fundoft.png";

    if(isset($_GET['modo'])){ 
        $modo = $_GET['modo'];
        
        //EXCLUIR AUTORES
        if($modo == "excluir"){
            $id = $_GET['id']; 
            $select = "DELETE FROM autores WHERE idAutores =".$id;
            mysqli_query($conexao,$select);
        }
        //ativar e desativar img
        else if($modo == "img"){
            $id = $_GET['id'];
            $ativacao = $_GET['ativacao'];
            
            //verificar se existe algum autor ativo
            $sql = "select ativarDesativar from autores where ativarDesativar = 1 and idAutores !=".$id;
            $selectVerificar = mysqli_query($conexao,$sql);
            $verificarAutor = mysqli_fetch_array($selectVerificar);
                    
            //desativar
            if($ativacao == 1){
                //verificar se existe algum autor ativo não pode dessativar todos os autores
                if($verificarAutor['ativarDesativar'] == ""){
                    echo("<script>alert('Não é possivel Desativar todos os autores')</script>");
                }else{
                    $select = "UPDATE autores SET ativarDesativar = 0 WHERE idAutores=".$id;
                }
            }
            //ativar
            else if($ativacao == 0){
                $select = "UPDATE autores SET ativarDesativar = 1 WHERE idAutores=".$id;
            }
            
            
            @mysqli_query($conexao,$select);
        }
        //EDITAR AUTORES
        else if($modo == "editar"){
            $acao = "Editar";
            $id = $_GET['id'];
            $_SESSION['idAutores'] = $id;
            
            $sql = "SELECT * FROM autores WHERE idAutores=".$id;
            
            $select = mysqli_query($conexao, $sql);
            
            while($dadosAutores = mysqli_fetch_array($select)){
                $nome = $dadosAutores['nome'];
                $descricao = $dadosAutores['descricao'];
                $imagem = $dadosAutores['imagem'];
                $ativacao = $dadosAutores['ativarDesativar'];
             
            }
            //ATIVACAO
            if($ativacao == 1){
                $checked1 = "checked";
            }else if($ativacao == 0){
                $checked0 = "checked";    
            }
            
                
            
        }
    
    }
             
       

?>


<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="js/funcoes.js">
<link href="js/jquery.js">
<script src="js/jquery.min.js"></script>
<script src="js/jquery.form.js"></script>

<div class="conteudoAutores">
    <div class="dadosAutores">
        <div class="bordarDadosAutores">    
            <div class="form">
                <div class="form1">
                    <form name="frmDados" action="index.php" method="post"><!-- form com todos os dados  -->
                        <div class="linha1dadosAutores">
                            <div class="colunadadosAutores">
                                <div class="linhaDadosConteudoAutores"><!-- nome -->
                                    <strong>Nome:</strong>
                                </div>
                                <div class="contAutoresdados">
                                    <input type="text" name="txtNome" value="<?php echo($nome)?>">
                                </div>
                                <div class="linhaDadosConteudoAutores"><!-- ativação -->
                                    <strong>Ativação:</strong>
                                </div>
                                <div class="contAutoresdados">
                                    <input type="radio" name="ativacao" value="1" <?php echo($checked1) ?>>Ativar<input type="radio" name="ativacao" value="0" <?php echo($checked0) ?>>Desativar
                                </div>
                                <div class="descricaonomeAutores"> <!-- descrição -->
                                    <strong>Descrição: </strong>
                                    <!-- caixa que vai receber o nome da imagem-->
                                    <input type="hidden" name="txtfoto"> 
                                </div> 
                                <div class="conteudoDescricao">
                                    <textarea name="txtDescricao" id="areaAutores"><?php echo($descricao)?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="linha2dadosAutores">
                            <input type="submit" id="buttonNivel" name="btnSalvarAutores" value="<?php echo($acao) ?>" >
                        </div>
                    </form>
                </div>     
                <div class="colunadadosAutores"> <!-- form do upload-->
                    <form id="frmfoto" method="post" action="upload.php" name="frmfoto" enctype="multipart/form-data">
                        <div class="fotoConteudoAutores">
                            <input type="file" name="fleArquivo" id="foto">
                        </div>
                    </form>
                    <div class="autoresFoto"><!-- DIV QUE CARREGA A FOTO--> 
                        <img src="<?php echo($imagem)?>" width="120px" height="120px">
                    </div>
                </div>       
            </div>     
            
        </div>
    </div>
    <div class="crudAutores">
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
                    Ativar/Desativar
                </td>
            </tr>
            <?php 
                 //CARREGAR OS DADOS NA TABELA
                $sql = "SELECT * FROM autores";
                $select = mysqli_query($conexao,$sql);
                
                while($dadosAutores = mysqli_fetch_array($select)){
                
            
            ?>
            <tr>
                <td width="23%">
                    <?php echo utf8_encode ($dadosAutores['nome'])?><!--NOME-->
                </td>
                <td width="10%">
                    <img src="imagens/editar.png" width="30px" onclick="editarAutores(<?php echo($dadosAutores['idAutores']) ?>)"><!--BOTAO EDITAR-->
                </td>
                <td width="10%">
                    <img src="imagens/if_delete_678153.png" width="25px" onclick="deleteAutores(<?php echo($dadosAutores['idAutores']) ?>)"><!--BOTAO DELETAR-->
                    
                </td>
                <?php
                    //saber se esta ativado ou desativado
                    if($dadosAutores['ativarDesativar'] == 1){
                        $img = "ativar";
                    }else if($dadosAutores['ativarDesativar'] == 0){
                        $img = "desativado";
                    }
                ?>
                <td width="10%">
                    <img src="imagens/<?php echo($img) ?>.png" onclick="ativarDesativarAutores(<?php echo($dadosAutores['idAutores'])?>,<?php echo($dadosAutores['ativarDesativar'])?>)"><!--ATIVAR E DESATIVAR-->
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
        $('#foto').live('change',function(){
            $('#frmfoto').ajaxForm({
                target:'.autoresFoto'
            }).submit();
        });

    });
    
    
</script>