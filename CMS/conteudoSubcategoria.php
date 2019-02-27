<?php
    require_once('conexao.php');
    session_start();
    
    $conexao = conexaoDB();
    $acao = "Salvar";
    $checked1 = null;
    $checked0 = null;
    $selecao = "Selecione uma categoria";
    $nome = "";
    $categoria="";
    $ativacao=null;
    $img=null;
    $idCateBanco = 0;

    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        $id = $_GET['id'];
        $_SESSION['idSubCategoria'] = $id;
        
        //EDITAR
        if($modo == "editar"){
            $acao = "Editar";
            $sql = "select subCategoria.*,categoria.nome as categoria,categoria.idcategoria  from subcategoria, categoria where categoria.idcategoria =  subcategoria.idCategoria and idsubCategoria=".$id;
            
            $select = mysqli_query($conexao,$sql);

            while($dadosSub = mysqli_fetch_array($select)){
                $nome = $dadosSub['nome'];
                $categoria = $dadosSub['categoria'];
                $ativacao = $dadosSub['ativarDesativar'];
                $idCateBanco = $dadosSub['idCategoria'];
            }
            
            //ativação do radio
            if($ativacao == 1){
                $checked1 = "checked";  
            }
            else if($ativacao == 0){
                $checked0 = "checked";  
            }
            
            //combo
            $selecao = $categoria;
            
            
        }
        else if($modo == "img"){
            $ativacao = $_GET['ativacao'];
            
            if($ativacao == 1){
                $sql = "UPDATE subcategoria set ativarDesativar=0 where idsubCategoria=".$id;
            }else if($ativacao == 0){
                $sql = "UPDATE subcategoria set ativarDesativar=1 where idsubCategoria=".$id;
            }
        }
        else if($modo == "excluir"){
            $sql= "Delete from subcategoria where idsubCategoria=".$id;    
        }
        
        mysqli_query($conexao,$sql);
    }

?>

<script src="js/jquery.js"></script>
<script src="js/funcoes.js"></script>

<div class="conteudoNivelUsuario">
    <div class="cadastroNivelUsuario">
       <div class="bordaNivel">    
           <form method="post" action="index.php" name="frmSubCategoria">
                <div class="colunaPromocoes">
                    <div class="linhaNomePromocoes"><!--nome subCategoria -->
                        <strong>Nome:</strong>
                    </div>
                    <div class="linhaNomePromocoes">
                        <input type="text" name="txtsubCategoria" value="<?php echo utf8_encode($nome)?>">
                    </div>
                </div>
               <div class="colunaPromocoes">
                    <div class="linhaNomePromocoes"><!--Categorias-->
                        <strong>Categoria:</strong>
                    </div>
                    <div class="linhaNomePromocoes"><!-- combo Categoria-->
                        <select name="categoria" id="comboCategoria">
                            <option value="0"><?php echo utf8_encode($selecao) ?></option>
                            <?php
                            $sql = "select * from categoria where idcategoria !=".$idCateBanco;
                            
                                
                            $select = mysqli_query($conexao,$sql);
                            
                            while($dadosProdutos = mysqli_fetch_array($select)){
                            ?>
                                <option value="<?php echo ($dadosProdutos['idcategoria'])?>"><?php echo utf8_encode($dadosProdutos['nome'])?></option>
                            <?php 
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="colunaPromocoes">
                    <div class="linhaNomePromocoes">
                        <strong>Ativação:</strong><!--Ativação-->
                    </div>
                    <div class="linhaNomePromocoes">
                        <input type="radio" name="ativacao" value="1" <?php echo($checked1)?>> Ativar
                        <input type="radio" name="ativacao" value="0" <?php echo($checked0)?>> Desativar
                    </div>
                </div>
               <div class="botaoPromocoes">
                    <input type="submit" name="btnSubCategoria" id="buttonNivel" value="<?php echo($acao)?>">
               </div>
            </form>
        </div>
    </div>
    <div class="crudNivelUsuario">
        <table width="100%" height="100%" border="1">
            <tr height="10%">
                <td width="23%">
                    Nome
                </td>
                <td width="23%">
                    Categoria
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
                $sql = "select subcategoria.*, categoria.nome as categoria from subcategoria, categoria where categoria.idcategoria = subcategoria.idCategoria";
                
                $select = mysqli_query($conexao,$sql);
            
                while($dadosSub = mysqli_fetch_array($select)){
                    
            ?>
            <tr>
                <td>
                   <?php echo utf8_encode($dadosSub['nome'])?>
                </td>
                <td>
                   <?php echo utf8_encode($dadosSub['categoria'])?>
                </td>
                <td>
                    <a href="#">
                        <img src="imagens/editar.png" width="30px" onclick="editar(<?php echo($dadosSub['idsubCategoria'])?>,'conteudoSubcategoria')"><!-- EDITAR-->
                    </a>
                </td>
                <td>
                    <a href="#">
                        <img src="imagens/if_delete_678153.png" width="25px" onclick="deletar(<?php echo($dadosSub['idsubCategoria']) ?>,'conteudoSubcategoria')"><!-- DELETAR-->
                    </a>           
                </td>
                <td>
                    <!-- ATIVACAO-->
                    <?php 
                        if($dadosSub['ativarDesativar']==1){
                           $img = "ativar";
                       }else{
                           $img = "desativado";
                       }                     
                    
                    ?>
                    <a href="#">
                        <img src="imagens/<?php echo($img)?>.png" onclick="ativacao(<?php echo($dadosSub['idsubCategoria'])?>,<?php echo($dadosSub['ativarDesativar']) ?>,'conteudoSubcategoria')"><!-- ATIVAR E DESATIVAR-->
                    </a>
                </td>         
            </tr>
            <?php
                }
            ?>
        </table>
    </div>
</div>