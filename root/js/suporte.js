// Importando a funcao de autenticacao de campos
import * as base from "./base.js";

// Capturando os elementos html
const btn = document.querySelector("#envio");
const noEmail = document.querySelector("#noEmail");
const noEmailPadrao = document.querySelector("#noEmailPadrao");
const noMsg = document.querySelector("#noMsg");
const campoEmail = document.querySelector("#floatingInputGrid");

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
      window.location.assign("ajuda.php");
    });
  }
}

btn.addEventListener("click", suporte);

// Funcao para preencher o campo de email se estiver logado
function preencheCampoEmailSeEstiverLogado(){
  // Pegando o email logado do sessionStorage
  let emailLogado = sessionStorage.getItem("logado");  
  if (emailLogado){ // Se estiver logado
    campoEmail.value = emailLogado; // Coloca o email logado no campo de email
  }
}
preencheCampoEmailSeEstiverLogado();