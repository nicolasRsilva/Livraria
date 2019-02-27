<?php
    require_once('conexao.php');
    session_start();

    $conexao = conexaoDB();

    $img = null;

    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        //ativar e desativar promocoes
        if($modo == "img"){
            $id = $_GET['id'];
            $ativacao = $_GET['ativacao'];
    
            if($ativacao == 0){
                $sql = "Update produtos set ativarDesativar=1 where idProdutos=".$id;
            }    
            else if($ativacao == 1){
                $sql = "Update produtos set ativarDesativar=0 where idProdutos=".$id;
            }
            
            
        }
        //excluir promocoes
        else if($modo == "excluir"){
            $id = $_GET['id'];
            //deletar tabela produtos
            $sql = "Delete from produtos where idProdutos=".$id;
            //deletar subCategoria_produtos
            $select = "Delete from subcategoria_produto where idProdutos=".$id;
            mysqli_query($conexao,$select);

        }
        
        mysqli_query($conexao,$sql);
        
    }
?>

<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="js/funcoes.js">
<link href="js/jquery.js">
<script src="js/jquery.min.js"></script>
<script src="js/jquery.form.js"></script>

<div class="conteudoTabelaProdutos">
    <table width="100%" height="100%" border="1">
        <tr height="10%">
            <td width="23%">
                Nome
            </td>
            <td width="23%">
                Autor
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
        <!--Select Produtos-->
            <?php
                $sql = "Select produtos.*,autores.nome as autores from produtos,autores where autores.idAutores = produtos.idAutores ";
            
                $select = mysqli_query($conexao, $sql);
            
                while($dadosprodutos = mysqli_fetch_array($select)){
            
            ?>
        <tr>
            <td>
                <!--Nome produto-->
                <?php echo utf8_encode($dadosprodutos['nome']) ?>  
            </td>
            <td>
                <!--Nome produto-->
                <?php echo utf8_encode($dadosprodutos['autores']) ?>
            </td>
            <td>
                <a href="#">
                    <img src="imagens/editar.png" width="30px" onclick="editarP(<?php echo($dadosprodutos['idProdutos'])?>,'conteudoProdutos')"><!-- EDITAR-->
                </a>
            </td>
            <td>
                <a href="#">
                    <img src="imagens/if_delete_678153.png" width="25px" onclick="deletar(<?php echo($dadosprodutos['idProdutos']) ?>,'conteudoTabelaProdutos')"><!-- DELETAR-->
                </a>           
            </td>
            <td>
                <!-- ATIVACAO-->
                <?php 
                   if($dadosprodutos['ativarDesativar']==1){
                       $img = "ativar";
                   }else{
                       $img = "desativado";
                   }

                ?>
                <a href="#">
                    <img src="imagens/<?php echo($img)?>.png" onclick="ativacao(<?php echo($dadosprodutos['idProdutos'])?>,<?php echo($dadosprodutos['ativarDesativar']) ?>,'conteudoTabelaProdutos')"><!-- ATIVAR E DESATIVAR-->
                </a>
            </td>         
        </tr>
        <?php
            }
        ?>
    </table>
</div>
