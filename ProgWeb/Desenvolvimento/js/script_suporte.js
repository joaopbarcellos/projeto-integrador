import * as base from "./script_base.js";

const btn = document.querySelector("#envio");
const noEmail = document.querySelector("#noEmail");
const noEmailPadrao = document.querySelector("#noEmailPadrao");
const noMsg = document.querySelector("#noMsg");

const campoEmail = document.querySelector("#floatingInputGrid");

document.querySelectorAll("input").forEach(input => {
    input.addEventListener("keypress", (event) => {
        if(event.key == "Enter"){
            suporte();
        }
    })
})

function suporte(){
    let verificaEmail = base.verificaCampoVazio(campoEmail, false, noEmail, noEmailPadrao);
    let verificaMsg = base.verificaCampoVazio(document.querySelector("#floatingTextarea1"), false, noMsg, false);

    if(verificaEmail){
        let verificaEmail = base.verificaEmailForaPadrao(campoEmail, noEmail, noEmailPadrao);
        if(verificaMsg && verificaEmail){
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
}

btn.addEventListener("click", suporte)
