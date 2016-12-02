/* Script de Voltar ao Topo */
jQuery(function () {

    jQuery('body').prepend('<div class="voltar-topo"></div>');
    var scrollButtonEl = jQuery('.voltar-topo');
    scrollButtonEl.hide();

    jQuery(window).scroll(function () {
        if (jQuery(window).scrollTop() < 100) {
            jQuery('.voltar-topo').fadeOut()
        } else {
            jQuery('.voltar-topo').fadeIn();
        }
    });

    scrollButtonEl.click(function () {
        jQuery("html, body").animate({scrollTop: 0}, 400);
        return false;
    });


});

/* Ancora com Efeito de Transição */
var $doc = $('html, body');
$('.scrollSuave').click(function () {
    $doc.animate({
        scrollTop: $($.attr(this, 'href')).offset().top
    }, 500);
    return false;
});


/* Validação de Formulário */
function validacao() {
    var usuario = document.getElementById("usuario").value;
    var senha = document.getElementById("senha").value;
    var confirmSenha = document.getElementById("confirmSenha").value;
    var email = document.getElementById("email").value;
    var nome = document.getElementById("nome").value;
    var erro = document.getElementById("erro");
    var maxUsuario = 16;
    var maxSenha = 32;

    if (usuario.length < 4) {
        erro.innerHTML = "Seu nome de usuário tem que ter mais de 4 caracteres!";
        formRegistro.usuario.focus();
        return false;
    }
    if (usuario.length > maxUsuario) {
        erro.innerHTML = "Seu nome de usuário não pode passar de " + maxUsuario + " caracteres!";
        formRegistro.usuario.focus();
        return false;
    }
    if (senha.length < 6) {
        erro.innerHTML = "Sua senha deve ter no minimo 6 caracteres!";
        formRegistro.senha.focus();
        return false;
    }
    if (senha != confirmSenha) {
        erro.innerHTML = "As senhas não conferem!";
        formRegistro.confirmSenha.focus();
        return false;
    }

    if (!email.match(/@/)) {
        erro.innerHTML = "Seu email deve conter um @";
        formRegistro.email.focus();
        return false;
    }
    if (nome == "") {
        erro.innerHTML = "Informe o seu nome e sobrenome!";
        formRegistro.nome.focus();
        return false;
    }
}

/* Validação Formulario de Busca */
document.querySelector('#btnBuscar').onclick = function(){
    var txtPesquisa = document.getElementById("txtPesquisa").value;
    if(txtPesquisa == ""){
        formBusca.txtPesquisa.focus();
        return false;
    }
}


/* Botão submit fora do Formulário */
function botaoSubmit(){
    document.forms["formDeletarMsg"].submit();
}

// Marcar ou desmarcar todos os checkbox
function marcardesmarcar(){
  $('.marcar').each(
         function(){
           if ($(this).prop( "checked")) 
           $(this).prop("checked", false);
           else $(this).prop("checked", true);               
         }
    );
}

$('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})