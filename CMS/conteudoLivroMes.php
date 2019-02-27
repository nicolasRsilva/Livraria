<?php
    require_once('conexao.php');
    $conexao = conexaoDB();
    
    $img = null;

    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        if($modo == "img"){
            $id = $_GET['id'];
             
            //SQL atualiza ativacao para 0
            $sql0 = "UPDATE produtos SET livroMes=0";
            mysqli_query($conexao,$sql0);
            //sql atualiza ativacao para 1
            $sql1 = "UPDATE produtos SET livroMes=1 where idProdutos=".$id;
            mysqli_query($conexao,$sql1);
            
        }
    }
?>


<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="js/funcoes.js">

<div class="livroMes">
    <table width="100%" height="100%" border="1">
        <tr>
            <td width="80%">
                Nome:
            </td>
            <td width="20%">
                Ativar/Desativar
            </td>

        </tr>
        <?php
            $sql = "select * from produtos";
            $select = mysqli_query($conexao, $sql);
            //tabela de livros
            while($dadosLivroMes = mysqli_fetch_array($select)){
        ?>
        <tr>
            <td>
                <?php echo utf8_encode ($dadosLivroMes['nome']) ?>
            </td>
            <?php
                //saber se esta ativado ou desativado
                if($dadosLivroMes['livroMes'] == 1){
                    $img = "ativar";
                }else if($dadosLivroMes['livroMes'] == 0){
                    $img = "desativado";
                }
            ?>
            <td>
                <img src="imagens/<?php echo($img) ?>.png" onclick="ativacaoLivroMes(<?php echo($dadosLivroMes['idProdutos']) ?>)"><!--ATIVAR E DESATIVAR-->
            </td>
        </tr>
        <?php 
            }
        ?>
    </table>
</div>

