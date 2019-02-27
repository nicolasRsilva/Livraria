<?php 
    
    require_once('conexao.php');
    $conexao = conexaoDB();
    session_start();
    
    $img = null;
    $acao = "Inserir";
    $checked1 = null;
    $checked0 = null;   
    $selecao = 0;
    $livro = null;
    $desconto = null;
    $ativacao = null;

    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        //ativar e desativar promocoes
        if($modo == "img"){
            $id = $_GET['id'];
            $ativacao = $_GET['ativacao'];
    
            if($ativacao == 0){
                $sql = "Update promocao set ativarDesativar=1 where idPromocao=".$id;
            }    
            else if($ativacao == 1){
                $sql = "Update promocao set ativarDesativar=0 where idPromocao=".$id;
            }
        }
        //excluir promocoes
        else if($modo == "excluir"){
            $id = $_GET['id'];
            $sql = "Delete from promocao where idPromocao=".$id;
        }
        //editar promocoes
        else if($modo == "editar"){
            $id = $_GET['id'];
            $_SESSION['idPromocao'] = $id; 
            
            $sql = "Select promocao.*, produtos.nome from promocao, produtos where produtos.idProdutos=promocao.idProdutos and idPromocao=".$id;
            
            $select = mysqli_query($conexao,$sql);
            
            while($selectEditar =  mysqli_fetch_array($select)){
                $livro = $selectEditar['nome'];
                $nivel = $selectEditar['idProdutos'];
                $desconto = $selectEditar['desconto'];
                $ativacao = $selectEditar['ativarDesativar'];
            }
            
            //ativação do radio
            if($ativacao == 1){
                $checked1 = "checked";  
            }
            else if($ativacao == 0){
                $checked0 = "checked";  
            }  
            
            //botao valer editar
            $acao = "Editar";
        }
        
        mysqli_query($conexao, $sql);
        
    }

?>

<script src="js/jquery.js"></script>
<script src="js/funcoes.js"></script>

<div class="conteudoNivelUsuario">
    <div class="cadastroNivelUsuario">
       <div class="bordaNivel">    
           <form method="post" action="index.php" name="frmPromocoes">
               <div class="colunaPromocoes">
                    <div class="linhaNomePromocoes"><!--Desconto-->
                        <strong>Livros:</strong>
                    </div>
                    <div class="linhaNomePromocoes"><!-- combo livros-->
                        <select name="livros" id="comboUsuario">
                            <!--Carregar os livros no comboBox-->
                            <?php 
                                if($modo == "editar"){
                                    $selecao = $livro;
                                }else{
                                    $selecao = "Selecione um Livro";
                                }
                        
                            ?>
                            
                            <option value="<?php echo($nivel) ?>"><?php echo($selecao) ?></option>
                            <!--livros do banco-->
                            <?php
                                $sql = "select * from produtos where ativarDesativar=1 and idProdutos !='".$selecao."'";

                                $select = mysqli_query($conexao, $sql);
                                
                                while($dadoslivros = mysqli_fetch_array($select)){
                                    echo("<option value='".$dadoslivros['idProdutos']."'>".$dadoslivros['nome']."</option>");
                                }
                            
                            ?>

                        </select>
                    </div>
                </div>
                <div class="colunaPromocoes">
                    <div class="linhaNomePromocoes"><!--Desconto-->
                        <strong>Desconto em %:</strong>
                    </div>
                    <div class="linhaNomePromocoes">
                        <input type="text" name="txtDesconto" id="comboUsuario" value="<?php echo($desconto)?>">
                    </div>
                </div>
                <div class="colunaPromocoes">
                    <div class="linhaNomePromocoes">
                        <strong>Ativação:</strong><!--Ativação-->
                    </div>
                    <div class="linhaNomePromocoes">
                        <input type="radio" name="ativacao" value="1" <?php echo($checked1)?>>Ativar
                        <input type="radio" name="ativacao" value="0" <?php echo($checked0)?>>Desativar
                    </div>
                </div>
               <div class="botaoPromocoes">
                    <input type="submit" name="btnPromocoes" id="buttonNivel" value="<?php echo($acao)?>">
               </div>
            </form>
        </div>
    </div>
    <div class="crudNivelUsuario">
        <table width="100%" height="100%" border="1">
            <tr height="10%">
                <td width="23%">
                    Livro
                </td>
                <td width="23%">
                    Desconto
                </td>
                <td width="23%">
                    Valor Final
                </td>
                <td width="10%">
                    Editar
                </td>
                <td width="10%">
                    Excluir
                </td>
                <td width="10%">
                    Ativar/desativar
                </td>         
            </tr>
            <?php
                //select da tabela
                $sql = "Select promocao.*, produtos.nome, produtos.preco from promocao, produtos where promocao.idProdutos=produtos.idProdutos";
                               
                $select = mysqli_query($conexao,$sql);
                
                while($dadosPomocoes = mysqli_fetch_array($select)){
            ?>
            <tr>
                <td>
                   <?php echo utf8_encode ($dadosPomocoes['nome']) ?><!--Nome do livro-->
                </td>
                <td>
                   <?php echo utf8_encode ($dadosPomocoes['desconto']."%") ?><!--Desconto livro-->
                </td>
                <td>
                   <?php 
                        // valor do desconto
                        $preco = $dadosPomocoes['preco'];
                        $desconto = $dadosPomocoes['desconto'];
                        $valorDesconto = ($preco*$desconto)/100;
                        $valorDescontoTotal = $preco - $valorDesconto;
                        echo("R$ ".substr($valorDescontoTotal,0,2).",00");
                        
                    
                    ?>
                </td>
                <td>
                    <a href="#">
                        <img src="imagens/editar.png" width="30px" onclick="editar(<?php echo($dadosPomocoes['idPromocao']) ?>,'conteudoPromocoes')"><!-- EDITAR-->
                    </a>
                </td>
                <td>
                    <img src="imagens/if_delete_678153.png" width="25px" onclick="deletar(<?php echo($dadosPomocoes['idPromocao']) ?>,'conteudoPromocoes')"><!-- DELETAR -->
                </td>
                <td>
                    <!-- ATIVACAO-->
                    <?php 
                        if($dadosPomocoes['ativarDesativar'] == 1){
                            $img = "ativar";
                        }
                        else if($dadosPomocoes['ativarDesativar'] == 0){
                            $img = "desativado";
                        }                       
                    
                    ?>
                    <a href="#">
                        <img src="imagens/<?php echo($img)?>.png" onclick="ativacao(<?php echo($dadosPomocoes['idPromocao']) ?>,<?php echo($dadosPomocoes['ativarDesativar']) ?>,'conteudoPromocoes')"><!-- ATIVAR E DESATIVAR-->
                    </a>
                </td>         
            </tr>
            <?php
                }
            ?>
        </table>
    </div>
</div>




