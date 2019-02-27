<?php
    require_once('conexao.php');
    session_start();

    $conexao = conexaoDB();

    $sessao = "Selecione um autor";
    $sessaoCategoria = "Selecione uma categoria";
    $sessaoSubcategoria = "Selecione uma subcategoria";
    $idAutorBanco = 0;
    $idCategoriaBanco = 0;
    $idsubcategoriaBanco = 0;
    $acao = "Salvar";
    $imagem = "imagens/fundoft.png";
    $controleCombo = 0;
    $checked1=null;
    $checked0 = null;
    $nome = null;
    $descricao = null;
    $autor = null;
    $preco = null;
    $ativacao = null;
    

    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        if($modo == "editar"){
            $acao = "Editar";
            $id = $_GET['id'];
            $_SESSION['idProdutos'] = $id;

            $sql = "select produtos.*,autores.nome as nomAutor from produtos, autores where produtos.idAutores = autores.idAutores and produtos.idProdutos=".$id;

            $select = mysqli_query($conexao, $sql);

            while($dadosProdutos = mysqli_fetch_array($select)){
                $nome = $dadosProdutos['nome'];
                $descricao = $dadosProdutos['descricao'];
                $imagem = $dadosProdutos['imagem'];
                $idAutorBanco = $dadosProdutos['idAutores'];
                $preco = $dadosProdutos['preco'];
                $ativacao = $dadosProdutos['ativarDesativar'];
                $sessao = $dadosProdutos['nomAutor'];
                
            }
        
            if($ativacao == 1){
                $checked1 = "checked";
            }else{
                $checked0 = "checked";
            }
            
            //select da categoria e subCategoria
            $sql = "select subcategoria.nome as nomesub,subcategoria.idsubCategoria as idsub,categoria.nome as nomecategoria, categoria.idcategoria as idcategoria from subcategoria,categoria,subcategoria_produto where subcategoria.idsubCategoria = subcategoria_produto.idSubcategoria and subcategoria.idCategoria = categoria.idcategoria  and subcategoria_produto.idProdutos=".$id;
            
            $select = mysqli_query($conexao, $sql);
    
            while($dadosProdutos = mysqli_fetch_array($select)){
                
                $idCategoriaBanco = $dadosProdutos['idcategoria'];
                $idsubcategoriaBanco = $dadosProdutos['idsub'];
                $sessaoCategoria = $dadosProdutos['nomecategoria'];
                $sessaoSubcategoria = $dadosProdutos['nomesub'];
            }

        }
    }


?>

<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="js/funcoes.js">
<link href="js/jquery.js">
<script src="js/jquery.min.js"></script>
<script src="js/jquery.form.js"></script>

<div class="conteudoProdutos">
    <div class="cadastroProdutos">
        <form name="frmDados" action="index.php" method="post">
            <div class="conteudoCadastro"><!--Conteudo Cadastros-->
                <div class="linhaCadastro"><!--Linha cadastro-->
                    <div class="nomeCadastro">
                        Nome:
                        <!--nome da imagem do livro-->
                        <input type="hidden" name="txtfoto">
                    </div>
                    <div class="caixasCadastro">
                        <input type="text" name="txtnome" class="produtosTela" value="<?php echo($nome) ?>" > <!--Nome-->
                    </div>
                </div>
                <div class="linhaCadastro">
                    <div class="nomeCadastro"><!--Preço-->
                        Preço:
                    </div>
                    <div class="caixasCadastro">
                        <input type="text" name="txtpreco" class="produtosTela" value="<?php echo($preco) ?>"><!--Preco-->
                    </div>
                </div>
                <div class="linhaCadastro">
                    <div class="nomeCadastro"><!--Categoria-->
                        Categoria:
                    </div>
                    <div class="caixasCadastro"><!--Categoria-->
                        <select name="comboCategoria" class="produtosTela" id="cmbCategoria" onchange="atualizarCombo()">
                            
                            <option value="<?php echo($idCategoriaBanco) ?>"><?php echo utf8_encode($sessaoCategoria) ?></option>
                            
                            <?php 
                                $sql = "Select * from categoria where idcategoria !=".$idCategoriaBanco;

                                $select = mysqli_query($conexao,$sql);

                                while($dadosCategoria =  mysqli_fetch_array($select)){
                                
                            ?> 
                                <option value="<?php echo($dadosCategoria['idcategoria']) ?>"><?php echo utf8_encode($dadosCategoria['nome']) ?></option>
                            
                            <?php } ?>

                        </select>
                    </div>
                </div>
                <div class="linhaCadastro">
                    <div class="nomeCadastro"><!--subCategoria-->
                        SubCategoria
                    </div>
                    <div class="caixasCadastro"><!--subCategoria-->
                        <select name="comboSubcategoria" class="produtosTela" id="comboSubCategoria" disabled>
                            <option value="<?php echo($idsubcategoriaBanco) ?>"><?php echo utf8_encode($sessaoSubcategoria) ?></option>
                            <?php 
                                
                                
                                $sql = "Select * from subcategoria where idsubCategoria !=".$idsubcategoriaBanco;
                                
                                
                                $select = mysqli_query($conexao,$sql);

                                while($dadosSubcategoria =  mysqli_fetch_array($select)){
                            ?> 
                                <option value="<?php echo($dadosSubcategoria['idsubCategoria']) ?>"><?php echo utf8_encode($dadosSubcategoria['nome']) ?></option>
                            <?php

                                }
                            ?>

                        </select>
                    </div>
                </div>
                <div class="linhaCadastro"><!--Combo-box autor-->
                    <div class="nomeCadastro">
                        Autor:
                    </div>
                    <div class="caixasCadastro">
                        <select name="comboAutor" class="produtosTela">
                            <option value="<?php echo($idAutorBanco) ?>"><?php echo utf8_encode($sessao) ?></option>
                            <?php 
                                $sql = "Select * from autores where idAutores !=".$idAutorBanco;

                                $select = mysqli_query($conexao,$sql);

                                while($dadosautores =  mysqli_fetch_array($select)){
                            ?> 
                                <option value="<?php echo($dadosautores['idAutores']) ?>"><?php echo utf8_encode($dadosautores['nome']) ?></option>
                            <?php

                                }
                            ?>

                        </select><!--Autor-->
                    </div>  
                </div>
                <div class="linhaCadastro">
                    <div class="nomeCadastro"><!--Ativar e Desativar-->
                        Ativação:
                    </div>
                    <div class="caixasCadastro"><!--ativacao-->
                        <input type="radio" name="ativacao" value="1" <?php echo($checked1) ?>><strong>Ativar</strong>
                        <input type="radio" name="ativacao" value="0" <?php echo($checked0) ?>><strong>Desativar</strong>
                    </div>
                </div>
                <div class="linhaCadastroDescricao"><!--Descrição-->
                    <div class="nomeCadastro">
                        Descrição:
                    </div>
                    <div class="caixasCadastroDescricao">
                        <textarea name="txtdescricao" class="caixaCadastroArea"><?php echo($descricao) ?></textarea><!--Nome-->
                    </div>
                </div>
            </div>
            <div class="btnSalvarProdutos">
                <input type="submit" name="btnProdutosSalvar" id="buttonNivel" value="<?php echo($acao) ?>">
            </div>
        </form>
    </div>
    <div class="uploadFoto"><!--Foto Livro-->
        <div class="linha1foto">
            <form id="frmfoto" method="post" action="upload.php" name="frmfoto">
                <input type="file" name="fleArquivo" id="foto" class="flArquivo">
            </form>
        </div>
        <div class="linha2foto">
            <div class="fotolivro"><!-- DIV QUE CARREGA A FOTO--> 
                <img src="<?php echo($imagem)?>" width="150px" height="150px">
            </div>
        </div>
    </div>
</div>
    
<script>
    //CARREGAR A IMAGEM NA DIV
    $(document).ready(function(){   
        $('#foto').live('change',function(){
            $('#frmfoto').ajaxForm({
                target:'.fotolivro'
            }).submit();
        });

    });
    
    function atualizarCombo(){
        //pega oq estiver em categoria(value é id)
        var valor = $('#cmbCategoria');

        $.ajax({
            type: 'post',
            //chama a pagina que pega o id e faz o select do combo subCategoria
            url: "comboSubcategoria.php?idCategoria=" + valor.val(),
            success:function(dados){
                //descarrega no combo o selec de subcategoria
                $('#comboSubCategoria').html(dados);
                document.getElementById('comboSubCategoria').disabled = false;
            }
            
        });
        
        
        
    }
    
</script>





