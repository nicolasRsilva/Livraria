<?php

    require_once('conexao.php');
    session_start();

    $conexao = conexaoDB();


    if(isset($_GET['palavra'])){
    
        $pesquisa = $_GET['palavra'];      

        //sql que busca no banco a palavra que usuario esta digitando
        $sql = "Select * from produtos where nome like '%".$pesquisa."%'";
        
         
    }
        
        
        $select = mysqli_query($conexao,$sql);
        
        while($pesquisa = mysqli_fetch_array($select)){

?>

<!--livro-->
<div class="quadradoConteudo">
    <div class="imgConteudo">
        <img src="CMS/<?php echo($pesquisa['imagem']) ?>">
    </div>
    <div class="dadosQuadrado">
        <div class="nomeProdutoNome">
            <strong>Nome:</strong> <?php echo utf8_encode($pesquisa['nome'])?>
        </div>
        <div class="nomeProduto">
            <strong>Descrição:</strong> <?php echo substr ($pesquisa['descricao'],0,20)."..."?>
        </div>
        <div class="nomeProdutoPreco">
            <div class="nomeProdutoPc">
                <strong>Preço:</strong> R$<?php echo  utf8_encode($pesquisa['preco']).",00"?>
            </div>
            <div class="detalhe">
                <a href="#">
                    <strong>Detalhes
                    </strong>
                </a>
            </div>
        </div>
    </div>
</div>
<?php
    }
?>