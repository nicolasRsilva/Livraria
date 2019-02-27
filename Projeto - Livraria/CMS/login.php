<?php
    
    function Login(){
        
        //se usuario não estiver logado retorna para pagina inicial
        if($_SESSION['validacao'] == null){
            header ('location:../');
        }
        
       
    }

?>