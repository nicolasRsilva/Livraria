<?php
    
    //conexao com o banco de dados
    function conexaoDB(){
        
        $host = "localhost";
        $database = "livraria_inf3ma";
        $user = "root";
        $password = "123";
        
        if(!$conexao = mysqli_connect($host,$user,$password,$database)){
            echo("Erro na conexão com o Banco de Dados");
            
        }
        
        return $conexao;       
        
    }

?>