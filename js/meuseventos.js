// Importando a funcao de autenticacao de campos
import * as base from "./base.js";

// Pegando todos os botoes para se inscrever
const cancel = document.querySelectorAll(".inscricao");

// Pegando o email do usuario logado
const email = document.querySelector("#nome_usuario");
console.log(email)

if (!email) {
  base.naoEstaLogado();
}

const barra_pesquisa = document.querySelector("#busca");

const lupa = document.querySelector("#lupa");

var meus_eventos_inscritos = [];
var meus_eventos_criados = [];

// Percorrendo todos os botoes
cancel.forEach((btn) => {
  // Adicionando um EventListener em cada um
  btn.addEventListener("click", () => {
    cancelarInscricao(btn.id);
  });
});

const todosEventosInscritos = document.querySelectorAll(".inscritos");
const todosEventosCriados = document.querySelectorAll(".criados");

function meusEventosInscritos() {
  todosEventos.forEach((evento) => {
    if (dados.eventos_inscritos.includes(evento.id.slice(3))) {
      // Colocando display block em todos os eventos que o usuario está inscrito
      evento.style.display = "block";
      meus_eventos_inscritos.push(evento);
      document.querySelector("#seminscrito").style.display = "none";
      document.querySelector("#semcriado").style.display = "none";
    } else {
      evento.style.display = "none";
    }
    if (meus_eventos_inscritos.length === 0) {
      lupa.classList.add("sembarra");
      barra_pesquisa.classList.add("sembarra");
      barra_pesquisa.classList.remove("form-control");
      barra_pesquisa.classList.remove("me-2");
      lupa.classList.remove("btn");
      document.querySelector("#seminscrito").style.display = "block";
      document.querySelector("#semcriado").style.display = "none";
    } else {
      barra_pesquisa.classList.add("form-control");
      barra_pesquisa.classList.add("me-2");
      barra_pesquisa.classList.remove("sembarra");
      lupa.classList.remove("sembarra");
      lupa.classList.add("btn");
      document.querySelector("#semcriado").style.display = "none";
    }
  });
}
meusEventosInscritos();

function meusEventosCriados() {
  todosEventos.forEach((evento) => {
    if (dados.eventos_criados.includes(evento.id.slice(3))) {
      // Colocando display block em todos os eventos que o usuario está inscrito
      evento.style.display = "block";
      meus_eventos_criados.push(evento);
      document.querySelector("#semcriado").style.display = "none";
      document.querySelector("#seminscrito").style.display = "none";
    } else {
      evento.style.display = "none";
    }
    if (meus_eventos_criados.length === 0) {
      lupa.classList.add("sembarra");
      barra_pesquisa.classList.add("sembarra");
      barra_pesquisa.classList.remove("form-control");
      barra_pesquisa.classList.remove("me-2");
      lupa.classList.remove("btn");
      document.querySelector("#semcriado").style.display = "block";
      document.querySelector("#seminscrito").style.display = "none";
    } else {
      document.querySelector("#seminscrito").style.display = "none";
      barra_pesquisa.classList.add("form-control");
      barra_pesquisa.classList.add("me-2");
      barra_pesquisa.classList.remove("sembarra");
      lupa.classList.remove("sembarra");
      lupa.classList.add("btn");
    }
  });
}

const divCriado = document.querySelector("#criado");
const divInscrito = document.querySelector("#inscrito");
divInscrito.addEventListener("click", (e) => {
  meusEventosInscritos();
  divInscrito.classList.add("selected");
  divInscrito.classList.remove("not-selected");

  divCriado.classList.add("not-selected");
  divCriado.classList.remove("selected");
});

divCriado.addEventListener("click", (e) => {
  meusEventosCriados();
  divInscrito.classList.add("not-selected");
  divInscrito.classList.remove("selected");
  divCriado.classList.add("selected");
  divCriado.classList.remove("not-selected");
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
      // dar refresh na pagina na proxima linha
      // nessa linha:
    }
  });
}

// Barra de pesquisa
lupa.addEventListener("click", () => {
  if (divInscrito.classList.contains("selected")) {
    base.pesquisar(meus_eventos_inscritos, barra_pesquisa);
  } else if (divCriado.classList.contains("selected")) {
    base.pesquisar(meus_eventos_criados, barra_pesquisa);
  } else {
    console.log("isso era pra ser impossível");
  }
});

// Adicionando um EventListener para quando for feita a pesquisa
barra_pesquisa.addEventListener("keypress", (event) => {
  let tecla = event.key;
  if (tecla == "Enter") {
    if (divInscrito.classList.contains("selected")) {
      base.pesquisar(meus_eventos_inscritos, barra_pesquisa);
    } else if (divCriado.classList.contains("selected")) {
      base.pesquisar(meus_eventos_criados, barra_pesquisa);
    } else {
      console.log("isso era pra ser impossível");
    }
  }
});

barra_pesquisa.addEventListener("search", () => {
  if (!barra_pesquisa.value) {
    base.esconderNaoAchou();
    if (divInscrito.classList.contains("selected")) {
      meusEventosInscritos();
    } else if (divCriado.classList.contains("selected")) {
      meusEventosCriados();
    } else {
      console.log("isso era pra ser impossível");
    }
  }
});

barra_pesquisa.addEventListener("input", () => {
  if (!barra_pesquisa.value) {
    base.esconderNaoAchou();
    if (divInscrito.classList.contains("selected")) {
      meusEventosInscritos();
    } else if (divCriado.classList.contains("selected")) {
      meusEventosCriados();
    } else {
      console.log("isso era pra ser impossível");
    }
  }
});
