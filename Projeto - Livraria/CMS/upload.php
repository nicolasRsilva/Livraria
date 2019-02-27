<?php 
    session_start(); 
    if(isset($_POST)){
        
        $arquivo = $_FILES['fleArquivo']['name'];
        
        //pega o tamanho do arquivo
        $tamanho_arquivo = $_FILES['fleArquivo']['size'];
        
        //transforma de bytes para kbytes (/1024) e arredonda o resultado do calculo trazendo apenas a parte inteira
        $tamanho_arquivo = round($tamanho_arquivo/1027);
        
        //Pega a extensão do arquivo(strrchr)
        $ext_arquivo = strrchr($arquivo,".");
        
        //Pega apenas o nome do arquivo sem a extensão
        $nome_arquivo = pathinfo($arquivo, PATHINFO_FILENAME);
        
        $nome_arquivo = md5(uniqid(time()).$nome_arquivo);
        
        
        //Guarda o diretório que será feito o upload do arquivo
        $diretorio_arquivo = "arquivos/";
        
        //Vertor de dados contendo todas as extensões válidas para o upload do arquivo
        $arquivos_permitido = array(".jpg",".png",".jpeg");
         
        //Verifica se a extensão do arquivo é permitida dentro do vetor de extensões válidas
        if(in_array($ext_arquivo,$arquivos_permitido)){
            //valida o tamanho do arquivo a ser enviado para servidor
            if($tamanho_arquivo <= 2000){
                
                $arquivo_tmp = $_FILES['fleArquivo']['tmp_name'];
                $foto = $diretorio_arquivo . $nome_arquivo . $ext_arquivo;
                
                if(move_uploaded_file($arquivo_tmp,$foto)){
                    
                    //Retora para a div visualizar a imagem a ser exibida.
                    echo("<img src='".$foto."'>");
                    
                    
                     echo("
                        <script>
                            frmDados.txtfoto.value = '".$foto."';
                        </script>

                    ");
                      
                }else{
                    echo("<script>alert('Não foi possivel enviar o arquivo para o servidor')</script>");
                }
                
            }else{
                echo("<script>alert('Tamanho de arquivo inválido')</script>");
            }
        }
        else{
            echo("<script>alert('Extensão Inválida!')</script>");
        }
                    
    }

?>

