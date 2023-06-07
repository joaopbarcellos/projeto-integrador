// Importando a função de autenticação de campos
import * as base from "./script_base.js";

// Capturando o botão da tela e adicionando um ouvidor de clique
document.querySelector("#btnEnviar").addEventListener("click", autenticar);

// Capturando os campos de texto
const campoEmail = document.querySelector("#floatingInputGroup1");
const campoSenha = document.querySelector("#floatingInputGroup2");


// Capturando as labels com mensagem de erro
const noEmail = document.querySelector("#noEmail");
const noPass = document.querySelector("#noPass");
const aotPass = document.querySelector("#aotPass");
const noEmailPadrao = document.querySelector("#noEmailPadrao");

// Capturando a label de email e senha
const labelEmail = document.querySelector("#label_email");
const labelSenha = document.querySelector("#label_senha");


function autenticar(){
    // Variáveis de verificação de padrão
    let verificaEmailForaPadrao = false
    let verificaSenhaForaPadrao = false

    // Verificando se o email está vazio
    let verificaEmailVazio = base.verificaCampoVazio(campoEmail, labelEmail, noEmail, noEmailPadrao);
    
    // Se estiver com algo escrito
    if(verificaEmailVazio){
        // Verifica o padrão do email
        verificaEmailForaPadrao = base.verificaEmailForaPadrao(campoEmail, noEmail, noEmailPadrao);
    }

    // Verifica se o campo de senha está vazio
    let verificaSenhaVazia = base.verificaCampoVazio(campoSenha, labelSenha, noPass, aotPass);
    
    // Se estiver com algo escrito
    if(verificaSenhaVazia){
        // Verifica o padrão da senha
        verificaSenhaForaPadrao = base.verificaSenhaForaPadrao(campoSenha, labelSenha, aotPass);
    }

    // Verificando se estão todos os campos certos
    if(verificaEmailVazio && verificaEmailForaPadrao && verificaSenhaVazia && verificaSenhaForaPadrao){
        // Arrumando a estética com a função
        base.campoCorreto(campoEmail, labelEmail, noEmail, noEmailPadrao);
        base.campoCorreto(campoSenha, labelSenha, noPass, aotPass);
        
        // Se o usuário tiver a conta criada
        if(base.verificaLogin(campoEmail.value, campoSenha.value) == "certo"){
            // Passa a tela para home com a conta logada
            passaTela(campoEmail.value);
        
        } else {
            Swal.fire({
                // Alert informando para o usuário que algo está errado
                title: 'ERRO!',
                icon: 'error',
                text: verificaLogin(campoEmail.value, campoSenha.value),
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Confirmar',
            })
        }
    }
}

// Funcao para levar para tela de home e setar o usuário logado no sessionStorage
function passaTela(email){
    // Salvando o email na chave logado no session storage para saber qual usuário está logado
    sessionStorage.setItem("logado", email);
    // levando para a tela de home
    window.location.assign('home.html');
}

// Ouvidor de cliques para entrar como convidado
document.querySelector("#entrar_conv").addEventListener("click", () =>{
    window.location.assign('home.html');
})