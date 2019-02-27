<?php

    require_once('conexao.php');
    session_start();

    $conexao = conexaoDB();


    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        $id = $_GET['id'];      


        $sql = "select produtos.* from subcategoria, categoria, subcategoria_produto, produtos where
                subcategoria_produto.idProdutos = produtos.idProdutos and
                subcategoria_produto.idSubcategoria = ".$id." and
                subcategoria.idCategoria = categoria.idcategoria and
                subcategoria_produto.idSubcategoria= subcategoria.idsubCategoria
                ;";
        

        
    }
        
        
        $select = mysqli_query($conexao,$sql);
        
        while($categoria = mysqli_fetch_array($select)){

?>

<!--livro-->
<div class="quadradoConteudo">
    <div class="imgConteudo">
        <img src="CMS/<?php echo($categoria['imagem']) ?>">
    </div>
    <div class="dadosQuadrado">
        <div class="nomeProdutoNome">
            <strong>Nome:</strong> <?php echo utf8_encode($categoria['nome'])?>
        </div>
        <div class="nomeProduto">
            <strong>Descrição:</strong> <?php echo substr ($categoria['descricao'],0,20)."..."?>
        </div>
        <div class="nomeProdutoPreco">
            <div class="nomeProdutoPc">
                <strong>Preço:</strong> R$<?php echo  utf8_encode($categoria['preco']).",00"?>
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