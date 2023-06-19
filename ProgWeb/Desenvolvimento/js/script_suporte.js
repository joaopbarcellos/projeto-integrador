// Importando a funcao de autenticacao de campos
import * as base from "./script_base.js";

// Capturando os elementos html
const btn = document.querySelector("#envio");
const noEmail = document.querySelector("#noEmail");
const noEmailPadrao = document.querySelector("#noEmailPadrao");
const noMsg = document.querySelector("#noMsg");
const campoEmail = document.querySelector("#floatingInputGrid");

// Capturando os inputs pra saber se clicou enter
document.querySelectorAll("input").forEach((input) => {
  input.addEventListener("keypress", (event) => {
    if (event.key == "Enter") {
      // Chamando a funcao caso o usuario apertou a tecla enter em algum campo de texto
      suporte();
    }
  });
});

function suporte() {
  // Verificando se o campo de email e vazio
  let verificaEmail = base.verificaCampoVazio(
    campoEmail,
    false,
    noEmail,
    noEmailPadrao
  );
  if (verificaEmail) {
    // Verificando se o email esta dentro dos padroes
    verificaEmail = base.verificaEmailForaPadrao(
      campoEmail,
      noEmail,
      noEmailPadrao
    );
  }
  // Verificando se o campo de mensagem e vazio
  let verificaMsg = base.verificaCampoVazio(
    document.querySelector("#floatingTextarea1"),
    false,
    noMsg,
    false
  );

  if (verificaMsg && verificaEmail) {
    Swal.fire({
      // Alert avisando ao usuario que a mensagem foi enviada
      title: "Obrigado!",
      icon: "success",
      text: "Sua mensagem foi enviada!",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "OK",
    }).then(() => {
      // Enviando o usuario para a tela de ajuda
      window.location.assign("ajuda.html");
    });
  }
}

btn.addEventListener("click", suporte);
