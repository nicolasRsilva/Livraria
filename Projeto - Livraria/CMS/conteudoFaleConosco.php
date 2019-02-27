<?php 
    require_once('conexao.php');
    $conexao = conexaoDB();

    //excluir contato
    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        if($modo == "excluir"){
            $codigo = $_GET['id'];
            $sql = "delete from Faleconosco where idFaleConosco=".$codigo;
            
            mysqli_query($conexao, $sql);
        }
    }
?>


<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/jquery.js"></script>
<script src="js/funcoes.js"></script>

<div class="tableFaleConosco">
    <table width="100%" height="100%">
        <tr height="10%" class="bordaLinha">
            <td width="25%" >
                <strong>Nome:</strong>
            </td>
            <td width="20%">
                <strong>Tel:</strong>
            </td>
            <td width="20%">
                <strong>Profissão:</strong>
            </td>
            <td width="15%">
                <strong>Sexo:</strong>
            </td>
            <td width="10%">
                <strong>Vizualizar</strong>
            </td>
            <td width="10%">
                <strong>Excluir</strong>
            </td>  
        </tr>
        <!--Carregar a tabela do banco-->
        <?php

            $sql = "select  nome, telefone, profissao, sexo, idFaleConosco from FaleConosco";

            $select = mysqli_query($conexao,$sql);

            while($rsFaleConosco = mysqli_fetch_array($select)){


        ?>

        <tr border="1">
            <td>
                <?php echo utf8_encode ($rsFaleConosco['nome']) ?>
            </td>
            <td>
                <?php echo utf8_encode ($rsFaleConosco['telefone'])?>
            </td>
            <td>
                <?php echo utf8_encode ($rsFaleConosco['profissao'])?>
            </td>
            <td>
                <?php echo utf8_encode ($rsFaleConosco['sexo'])?>
            </td>
            <td align="center">  
                 <img src="imagens/lupa.png" width="25px" class="vizualizar" onclick="modalFaleConosco(<?php echo($rsFaleConosco["idFaleConosco"])?>)">
            </td>
            <td>
                <a href="#" onclick="deletarFaleConosco(<?php echo($rsFaleConosco["idFaleConosco"])?>)">
                    <img src="imagens/if_delete_678153.png" width="25px">
                </a>  
            </td>
        </tr>
        <?php
            }
        ?>
    </table>
