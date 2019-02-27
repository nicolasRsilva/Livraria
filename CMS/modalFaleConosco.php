<?php 
    
    //estabelecendo conexão do banco
    require_once('conexao.php');
    
    //conexao com banco
    $conexao = conexaoDB();
    $sexoN = null;
    //id do registro
    $id = $_POST['idregistro'];
    
    //select no banco
    $sql = "select * from FaleConosco where idFaleConosco=".$id;
  
    $select = mysqli_query($conexao,$sql);

    if($rs = mysqli_fetch_array($select)){
        $nome = $rs['nome'];
        $celular = $rs['celular'];
        $telefone = $rs['telefone'];
        $email = $rs['email'];
        $profissao = $rs['profissao'];
        $homePage = $rs['home'];
        $linkFacebook = $rs['facebook'];
        $sugestao = $rs['sugestao'];
        $informacoes = $rs['informacoesProdutos'];
        $sexo = $rs['sexo'];
        
        if($sexo == "M"){
            $sexoN = "Masculino";
        }else if($sexo == "F"){
            $sexoN = "Feminino";
        }
    }

?>

<html>
    <head>
        <title>modalFaleConosco</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/jquery.js"></script>
        <script src="js/funcoes.js"></script>
    </head>
    <body>      
        <a href="#" class="fechar">
            <div class="fecharFaleConosco">
            </div>
        </a>
        <div class="coluna1FaleConosco"><!--Coluna 1-->
            <div class="nomedadosFaleConosco">
               <strong>Nome:</strong><!--nome-->
            </div>
            <div class="dadosFaleConosco">
                <input type="text" id="txtFaleConosco" value="<?php echo($nome) ?>" disabled>
            </div>
            <div class="nomedadosFaleConosco"><!--email-->
                <strong>Email:</strong>
            </div>
            <div class="dadosFaleConosco">
                <input type="text" id="txtFaleConosco" value="<?php echo($email) ?>" disabled>
            </div>
            <div class="nomedadosFaleConosco"><!--Telefone-->
                <strong>Telefone:</strong>
            </div>
            <div class="dadosFaleConosco">
                <input type="text" id="txtFaleConosco" value="<?php echo($telefone) ?>" disabled>
            </div>
            <div class="nomedadosFaleConosco"><!--Celular-->
                <strong>Celular:</strong>
            </div>
            <div class="dadosFaleConosco">
                <input type="text" id="txtFaleConosco" value="<?php echo($celular) ?>" disabled>
            </div>
            <div class="nomedadosFaleConosco"><!--Sugestão/Criticas:-->
                <strong>Sugestão/Criticas:</strong>
            </div>
            <div class="dadosFaleConosco">
                <textarea id="txtareaFaleConosco" disabled><?php echo($sugestao)?>
                </textarea>
            </div>
        </div>
        <div class="coluna1FaleConosco"><!--Coluna 2-->
            <div class="nomedadosFaleConosco">
               <strong>Profissão:</strong><!--profissao-->
            </div>
            <div class="dadosFaleConosco">
                <input type="text" id="txtFaleConosco" value="<?php echo($profissao) ?>" disabled>
            </div>
            <div class="nomedadosFaleConosco"><!--home-->
                <strong>Home:</strong>
            </div>
            <div class="dadosFaleConosco">
                <input type="text" id="txtFaleConosco" value="<?php echo($homePage) ?>" disabled>
            </div>
            <div class="nomedadosFaleConosco"><!--sexo-->
                <strong>Sexo:</strong>
            </div>
            <div class="dadosFaleConosco">
                <input type="text" id="txtFaleConosco" value="<?php echo($sexoN) ?>" disabled>
            </div>
            <div class="nomedadosFaleConosco"><!--facebook-->
                <strong>Facebook:</strong>
            </div>
            <div class="dadosFaleConosco">
                <input type="text" id="txtFaleConosco" value="<?php echo($linkFacebook) ?>" disabled>
            </div>
            <div class="nomedadosFaleConosco"><!--informações:-->
                <strong>Informações do produto:</strong>
            </div>
            <div class="dadosFaleConosco">
                <textarea id="txtareaFaleConosco" disabled><?php echo($informacoes)?>
                </textarea>
            </div>
        </div>
        
        
        
    </body>

</html>