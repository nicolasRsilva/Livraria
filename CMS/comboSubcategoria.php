<?php
    
    require_once('conexao.php');
    session_start();

    $conexao = conexaoDB();

    //Pega o id de categoria e faz o select de subCategoria
    if(isset($_GET['idCategoria'])){
        $id = $_GET['idCategoria'];
        
        $sql = "Select * from subcategoria where idCategoria=".$id;
        
        $select = mysqli_query($conexao,$sql);
        
        while($nomeSubCategoria = mysqli_fetch_array($select)){
            echo utf8_encode("<option value='" . $nomeSubCategoria['idsubCategoria'] . "' >" . $nomeSubCategoria['nome'] . "</option>");
        }
    }


?>