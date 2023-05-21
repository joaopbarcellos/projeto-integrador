import * as base from "./script_base.js";

const btn = document.querySelector("#envio");
const noEmail = document.querySelector("#noEmail");
const noEmailPadrao = document.querySelector("#noEmailPadrao");
const noMsg = document.querySelector("#noMsg");

const campoEmail = document.querySelector("#emailuser");

const emailLogado = sessionStorage.getItem("logado");

// Caso o usuário não esteja logado
if(!emailLogado){
    Swal.fire({
        // Alert avisando ao usuário fazer login
        title: 'Faça login!',
        icon: 'error',
        text: 'Você precisa estar logado para enviar mensagem',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Login'
    }).then((result) => {
        if(result.isConfirmed){
            // Enviando o usuário para a tela de login
            window.location.assign("index.html");
        }
    })
}

campoEmail.value = emailLogado;
// Preenchendo o campo com email do usuário logado

btn.addEventListener("click", () => {
    let verificaEmail = base.verificaCampoVazio(campoEmail, false, noEmail, noEmailPadrao);
    let verificaMsg = base.verificaCampoVazio(document.querySelector("#mensagem"), false, noMsg, false);

    if(verificaEmail){
        let verificaForaPadrao = base.verificaEmailForaPadrao(campoEmail, noEmail, noEmailPadrao);
        if(verificaMsg && verificaForaPadrao && verifica(campoEmail.value)){
            Swal.fire({
                // Alert avisando ao usuário que a mensagem foi enviada
                title: 'Obrigado!',
                icon: 'success',
                text: 'Sua mensagem foi enviada!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            }).then(() => {
                // Enviando o usuário para a tela de ajuda
                window.location.assign("ajuda.html");
            })
        }
    }
    
});


function verifica(email){
    // Se o email não estiver cadastrado no banco
    if(!localStorage.getItem(email)){
        Swal.fire({
            // Alert avisando ao usuário que o email não está cadastrado no banco
            title: 'Email Inválido!',
            icon: 'error',
            text: 'Esse email não está cadastrado',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        })
        return false;
    }
    return true;

}

let voltar = document.querySelector(".cssbuttons-io-button");
if(voltar){
  // Adicionando o ouvidor do evento para se inscrever
  voltar.addEventListener("click", () => {
    window.location.assign("ajuda.html")
})
}