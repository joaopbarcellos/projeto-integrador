import {send} from "./script_base.js";

let usuarioLogado = sessionStorage.getItem("logado");
// Armazenando a informação de qual usuário está logado

// Verficando se um usuário está logado
if(usuarioLogado == null){
    alert("Você não está logado(a)!");
    window.location.assign("login.html");
    // Enviando para a página de login
} else {
    // Armazenando as informações do usuário logado
    let dados = JSON.parse(localStorage.getItem(usuarioLogado));

    // Pegando o nome do usuário logado e colocando no label
    document.querySelector("#nome_usuario").textContent = dados["nome"];

    // Pegando o email do usuário logado e colocando no label
    document.querySelector("#email_usuario").textContent = dados["email"];

    // Pegando a data de nascimento do usuário logado e colocando no label
    let data = dados["dataNasc"].substring(8, 10) + "/" + dados["dataNasc"].substring(5, 7) + "/" + dados["dataNasc"].substring(0, 4)
    document.querySelector("#dataNasc_usuario").textContent = data
}

// Enviar email do footer
document.querySelector("#enviarEmail").addEventListener("click", () =>{
    send(document.querySelector("#email"))
});
