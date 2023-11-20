// Importando a funcao de autenticacao de campos
import * as base from "./base.js";

// Pegando todos os botoes para ir para o evento
const cards = document.querySelectorAll(".evento");

// Percorrendo todos os botoes
cards.forEach((card) => {
  // Adicionando um EventListener em cada um
  card.addEventListener("click", () => {
    window.location.assign(`evento.php?id_evento=${card.id}`);
  });
});

// Pegando o email do usuario logado
const email = document.querySelector("#nome_usuario");

// Identificando se o usuario esta logado ou nao
if (!email) {
  base.naoEstaLogado();
}

// Pegando todos os botoes para se inscrever
const cancel = document.querySelectorAll(".inscricao");

// Percorrendo todos os botoes
cancel.forEach((btn) => {
  // Adicionando um EventListener em cada um
  btn.addEventListener("click", (event) => {
    event.stopPropagation();
    cancelarInscricao(btn.id);
  });
});

// Funcao para cancelar a inscricao
function cancelarInscricao(id) {
  // Iniciando um alert perguntando se o usuario deseja cancelar a inscricao.
  Swal.fire({
    title: "Cancelar inscrição?",
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sim",
    cancelButtonText: "Não",
  }).then((result) => { // Depois da resposta
    if (result.isConfirmed) { // Se confirmar
      // Desinscrever do evento
      window.location.assign(`conexaoBancoDados/cancelar_inscricao_evento.php?id=${id}`);
    }
  });
}

// Pegando a barra de pesquisa e a lupa
const barra_pesquisa = document.querySelector("#busca");
const lupa = document.querySelector("#lupa");

// Adicionando EventListener para quando for feita a pesquisa
lupa.addEventListener("click", () => {
  cards.forEach((card) => {
    if(card.getAttribute("name").toLowerCase().includes(barra_pesquisa.value.toLowerCase())) card.style.display = "block";
    else card.style.display = "none";
  });
  pesquisa(barra_pesquisa.value);
});

barra_pesquisa.addEventListener("keypress", (event) => {
  let tecla = event.key;
  if (tecla == "Enter") {
    cards.forEach((card) => {
      if(card.getAttribute("name").toLowerCase().includes(barra_pesquisa.value.toLowerCase())) card.style.display = "block";
      else card.style.display = "none";
    });
    pesquisa(barra_pesquisa.value);
  }
});

barra_pesquisa.addEventListener("search", () => {
  cards.forEach((card) => {
    if(card.getAttribute("name").toLowerCase().includes(barra_pesquisa.value.toLowerCase())) card.style.display = "block";
    else card.style.display = "none";
  });
  pesquisa(barra_pesquisa.value);
});

barra_pesquisa.addEventListener("input", () => {
  cards.forEach((card) => {
    if(card.getAttribute("name").toLowerCase().includes(barra_pesquisa.value.toLowerCase())) card.style.display = "block";
    else card.style.display = "none";
  });
  pesquisa(barra_pesquisa.value);
});
// ------------------------------------------------------------------------------------


// Funcao pra saber se foi encontrado um evento com o valor da barra de pesquisa
function pesquisa(valor){
  var conteudo = document.querySelector("#naoAchou");
  var cont = 0;
  cards.forEach((card) => {
    if (card.style.display == "block") cont+=1;
  })
  if (cont == 0){ 
    conteudo.textContent = `Nenhum resultado para "${valor}" encontrado!`;
    conteudo.style.display = "block";
  } else {
    conteudo.style.display = "none";
  }
}
// ------------------------------------------------------------------------------------

