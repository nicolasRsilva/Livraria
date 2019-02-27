var verificarSubMenu = 1;

//FUNÇÃO PARA ABRIR O MENU
function AbrirMenu(menu){

    //cancela o bem vindo
    var display = document.getElementById('bemvindo').style.display = "none";

    //pega o menu clicado
    var display = document.getElementById(menu).style.display = "block";

    //array para armezena as paginas
    var paginas = ['conteudo','faleconosco','produtos', 'usuario'];

    //verifica o array para deixa os ostros menus com block
    for(i=0; i < 4; i++){
        if(menu != paginas[i]){
            var display = document.getElementById(paginas[i]).style.display = "none";
            document.getElementById('areaconteudoCms').style.display = "none";

        }
    }
}

//********FALE CONOSCO**********//

//FUNÇÃO PARA ABRIR CONTEUDO DO FALE CONOSCO
function conteudoFaleConosco(){
    $.ajax({
        type:"POST",
        url:"conteudoFaleConosco.php",
        success: function(dados){
            $('.areaconteudoCms').html(dados)
            document.getElementById('areaconteudoCms').style.display = "block";
        }

    });
    
}

//função para fechar modal
$(document).ready(function(){  
    $('.fechar').click(function(){
        $('#container').fadeOut(400); 
    });


});


//ABRIR MODAL FALE CONOSCO
$(document).ready(function(){

    $(".vizualizar").click(function(){
        $("#container").fadeIn(400);                      
    });                  
});

//CONTEUDO DA MODAL FALE CONOSCO
function modalFaleConosco(idItem){   
    $.ajax({
        type:"POST",
        url:"modalFaleConosco.php",
        data:{idregistro:idItem},
        success: function(dados){
            //modal recebe dados
            $("#modal").html(dados)
        }

    })
}
//DELETAR FALE CONOSCO
function deletarFaleConosco(id){
    $.ajax({
        type:"GET",
        url:"conteudoFaleConosco.php?modo=excluir&id="+id,
        success: function(dados){
            $('.areaconteudoCms').html(dados)
        }

    })

}

//************* Nivel USUARIO**********

//DESCARREGAR NIVELUSUARIO
function conteudoNivelUsuario(){
    $.ajax({
        type:"POST",
        url:"conteudoNivelUsuario.php",
        success:function(dados){
            $('.areaconteudoCms').html(dados)
            document.getElementById('areaconteudoCms').style.display = "block"
        }
    })
}

//atualixar NIVELUSUARIO
function atualizarNivelUsuario(){
    $.ajax({
        type:"POST",
        url:"conteudoNivelUsuario.php",
        success:function(dados){
            $('.areaconteudoCms').html(dados)
            
        }
    })
}
//deletar NivelUsuario
function deletarNivelUsuario(id){
    $.ajax({
        type:"GET",
        url:"conteudoNivelUsuario.php?modo=excluir&id="+id,
        success: function(dados){
            $('.areaconteudoCms').html(dados)
        }

    })

}
//editar nivelUsuario
function editarNivelUsuario(id){
    $.ajax({
        type:"GET",
        url:"conteudoNivelUsuario.php?modo=editar&id="+id,
        success: function(dados){
            $('.areaconteudoCms').html(dados)
        }

    });

}

//enviar dados para dar update de ativado ou desativado
function ativarDesativar(id,ativacao){
    $.ajax({
        type:"GET",
        url:"conteudoNivelUsuario.php?modo=img&id="+id+"&ativacao="+ativacao,
        success: function(dados){
            $('.areaconteudoCms').html(dados)
        }

    });

}

//************* USUARIO**********

//DESCARREGAR USUARIO
function conteudoUsuario(){
    $.ajax({
        type:"POST",
        url:"conteudoUsuario.php",
        success:function(dados){
            $('.areaconteudoCms').html(dados) 
            document.getElementById('areaconteudoCms').style.display = "block";
        }
    })   
}

//deletar um usuario
function deletarUsuario(id){
    $.ajax({       
        type:"GET",
        url:"conteudoUsuario.php?modo=excluir&id="+id,
        success: function(dados){
            $('.areaconteudoCms').html(dados)
        } 
    });
    
}

//enviar dados para dar update de  ativado ou desativado
function AtivarDesativarUsuario(id,ativacao){
    $.ajax({
        type:"GET",
        url:"conteudoUsuario.php?modo=img&id="+id+"&ativacao="+ativacao,
        success:function(dados){
            $('.areaconteudoCms').html(dados)
        }
    });
    
}

//editar Usuario
function EditarUsuario(id){
    $.ajax({
       type:"GET",
        url:"conteudoUsuario.php?modo=editar&id="+id,
        success: function(dados){
            $('.areaconteudoCms').html(dados)
        }
    });
    
}

//******CONTEUDO AUTORES*******

//descarregar conteudoAutores
function ConteudoAutores(){
    $.ajax({
        type:"POST",
        url:"conteudoAutores.php",
        success: function(dados){
            $('.areaconteudoCms').html(dados)        
            document.getElementById('areaconteudoCms').style.display = "block";   
        } 
    });
    
}
//deletar autores
function deleteAutores(id){
    $.ajax({       
        type:"GET",
        url:"conteudoAutores.php?modo=excluir&id="+id,
        success: function(dados){
            $('.areaconteudoCms').html(dados)
        } 
    });
    
}
///ativar e desativar
function ativarDesativarAutores(id,ativacao){
    $.ajax({
        type:"GET",
        url:"conteudoAutores.php?modo=img&id="+id+"&ativacao="+ativacao,
        success: function(dados){
            $('.areaconteudoCms').html(dados)
        }
        
    });
    
}

//EDITAR AUTORES
function editarAutores(id){
    $.ajax({
        type:"GET",
        url:"conteudoAutores.php?modo=editar&id="+id,
        success:function(dados){
           $('.areaconteudoCms').html(dados)
        }      
    });   
}

//LIVRARIA
function conteudoLivraria(){
     $.ajax({
        type:"POST",
        url:"conteudoLivraria.php",
        success: function(dados){
            $('.areaconteudoCms').html(dados)
            document.getElementById('areaconteudoCms').style.display = "block";
        }

    });
}

//deletar livraria
function deletarLivraria(id){
    $.ajax({       
        type:"GET",
        url:"conteudoLivraria.php?modo=excluir&id="+id,
        success: function(dados){
            $('.areaconteudoCms').html(dados)
        } 
    });
}

//ativar e desativar livraria
function ativacaoLivraria(id,ativacao){
    $.ajax({
        type:"GET",
        url:"conteudoLivraria.php?modo=img&id="+id+"&ativacao="+ativacao,
        success:function(dados){
            $('.areaconteudoCms').html(dados)
        }
    });
    
}
//editar livraria
function editarLivraria(id){
    $.ajax({
        type:"GET",
        url:"conteudoLivraria.php?modo=editar&id="+id,
        success:function(dados){
           $('.areaconteudoCms').html(dados)
        }      
    });   
}

//********Lojas*

//descarregar lojas
function conteudoLoja(){
    $.ajax({
        type:"POST",
        url:"conteudoLoja.php",
        success: function(dados){
            $('.areaconteudoCms').html(dados)
            document.getElementById('areaconteudoCms').style.display = "block";
        }

    });
}

//deletar lojas
function deletarLojas(id){
    $.ajax({       
        type:"GET",
        url:"conteudoLoja.php?modo=excluir&id="+id,
        success: function(dados){
            $('.areaconteudoCms').html(dados)
        } 
    });
}

//ativar e desativar lojas
function ativacaoLojas(id,ativacao){
    $.ajax({
        type:"GET",
        url:"conteudoLoja.php?modo=img&id="+id+"&ativacao="+ativacao,
        success:function(dados){
            $('.areaconteudoCms').html(dados)
        }
    });
}

//editar lojas
function editarLojas(id){
    $.ajax({
        type:"GET",
        url:"conteudoLoja.php?modo=editar&id="+id,
        success:function(dados){
           $('.areaconteudoCms').html(dados)
        }      
    });
    
}


//*****LIVRO DO MES

//descarregar livro do mês
function conteudoLivroMes(){
    $.ajax({
        type:"POST",
        url:"conteudoLivroMes.php",
        success: function(dados){
            $('.areaconteudoCms').html(dados)        
            document.getElementById('areaconteudoCms').style.display = "block";   
        } 
    });
    
}


function ativacaoLivroMes(id){
    $.ajax({
        type:"GET",
        url:"conteudoLivroMes.php?modo=img&id="+id,
        success:function(dados){
            $('.areaconteudoCms').html(dados)
        }
    });
    
}


//******PROMOÇÕES

//descarregar promocoes
function conteudoPromocoes(){
    $.ajax({
        type:"POST",
        url:"conteudoPromocoes.php",
        success: function(dados){
            $('.areaconteudoCms').html(dados)        
            document.getElementById('areaconteudoCms').style.display = "block";   
        } 
    });
    
}

//deletar promocoes
function deletar(id,pagina){
    $.ajax({       
        type:"GET",
        url:pagina+".php?modo=excluir&id="+id,
        success: function(dados){
            $('.areaconteudoCms').html(dados)
        } 
    });
}

//ativacao
function ativacao(id, ativacao,pagina){
    $.ajax({
        type:"GET",
        url:pagina+".php?modo=img&id="+id+"&ativacao="+ativacao,
        success:function(dados){
            $('.areaconteudoCms').html(dados)
        }
    });
}

//editar promocao
function editar(id,pagina){
    $.ajax({
        type:"GET",
        url:pagina+".php?modo=editar&id="+id,
        success:function(dados){
           $('.areaconteudoCms').html(dados)
        }      
    });
}

//*********PRODUTOS
function conteudoProdutos(){  
    $.ajax({
        type:"GET",
        url:"conteudoProdutos.php",
        success:function(dados){
            $('.areaconteudoCms').html(dados)
             
            //sub menu, sumir e aparecer
            if(verificarSubMenu == 1){
                var ativarDesativarMenu = "block"
                verificarSubMenu = 2;
                var tamanho = "30px";
            }else{
                var ativarDesativarMenu = "none"
                verificarSubMenu = 1;
                var tamanho = "0px";
            }
            document.getElementById('areaconteudoCms').style.display = "block";            
            
           //subMenu
            document.getElementById('linhaSubMenuConteuCms').style.display = ativarDesativarMenu;
            document.getElementById('linhaMenuConteuCmsCategoria').style.marginTop = tamanho;
        }
         
    });
}


//************ Conteudo Categoria
function conteudoCategoria(){
    $.ajax({
       type:"GET",
        url:"conteudoCategoria.php",
        success:function(dados){
            $('.areaconteudoCMS').html(dados)
            document.getElementById('areaconteudoCms').style.display = "block";
        }
    });
}


//********** conteudo Subcategoria
function conteudoSubcategoria(){
    $.ajax({
        type:"GET",
        url:"conteudoSubcategoria.php",
        success:function(dados){
            $('.areaconteudoCMS').html(dados)
            document.getElementById('areaconteudoCms').style.display = "block";
        }
        
    });
    
}


//********** conteudo Tabela Produtos
function conteudoTabelaProdutos(){
    $.ajax({
        type:"GET",
        url:"conteudoTabelaProdutos.php",
        success:function(dados){
            $('.areaconteudoCMS').html(dados)
            document.getElementById('areaconteudoCms').style.display = "block";
        }
        
    });
    
}

//***editar produtos
function editarP(id,pagina){
    $.ajax({
        type:"GET",
        url:pagina+".php?modo=editar&id="+id,
        success:function(dados){
           $('.areaconteudoCms').html(dados)
            document.getElementById('comboSubCategoria').disabled = false;
        }      
    });
}

































