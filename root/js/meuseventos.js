// Importando a funcao de autenticacao de campos
import * as base from "./base.js";

// Pegando todos os botoes para se inscrever
const cancel = document.querySelectorAll(".inscricao");

// Pegando o email do usuario logado
const email = sessionStorage.getItem("logado");
// Pegando todos os dados do usuario
const dados = JSON.parse(localStorage.getItem(document.querySelector(".paragrafo").value));
console.log(dados);

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

// Caso o usuario nao esteja logado
function naoEstaLogado(){
  Swal.fire({
    // Alert avisando ao usuario fazer login
    title: "Faça login!",
    icon: "error",
    text: "Você precisa estar logado para acessar essa funcionalidade.",
    confirmButtonColor: "#3085d6",
    confirmButtonText: "Login",
  }).then(() => {
    // Enviando o usuario para a tela de login
    window.location.assign("index.php");
  });
}

const todosEventos = document.querySelectorAll(".evento");
function desaparecerTudo(){
  todosEventos.forEach((evento) => {
    evento.style.display = "none";
  });
}
desaparecerTudo();

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


function meusEventosCriados(){
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
divInscrito.addEventListener("click", (e) =>{
  meusEventosInscritos();
  divInscrito.classList.add('selected');
  divInscrito.classList.remove('not-selected');
  
  divCriado.classList.add('not-selected');
  divCriado.classList.remove('selected');
});

divCriado.addEventListener("click", (e) =>{
  meusEventosCriados();
  divInscrito.classList.add('not-selected');
  divInscrito.classList.remove('selected');
  divCriado.classList.add('selected');
  divCriado.classList.remove('not-selected');
});

function cancelarInscricao(id) {
  Swal.fire({
    // Iniciando um alert perguntando se o usuario deseja cancelar a inscricao.
    title: "Cancelar inscrição?",
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sim",
    cancelButtonText: "Não",
  }).then((result) => {
    if (result.isConfirmed) {
      // Alert para caso o usuario cancelou sua inscricao.
      Swal.fire("Feito!", "Sua inscrição foi cancelada.", "success");

      dados.eventos_inscritos = dados.eventos_inscritos.filter((valor) => {
        return valor != id;
        // Retirando da lista o evento que o usuario esta desinscrevendo
      });

      let stringJson = JSON.stringify(dados);
      localStorage.setItem(email, stringJson);
      // Setando novamente no localStorage

      document.querySelector(`#div${id}`).style.display = "none";
      meus_eventos_inscritos.splice(`#div${id}`);
      // Retirando o evento da tela
      if (!dados.eventos_inscritos.length) {
        document.querySelector(".semevento").style.display = "block";
        document.querySelector("#pesquisar").classList.add("sembarra");
        document.querySelector("#pesquisar").classList.remove("d-flex");
        document.querySelector("#seminscrito").style.display = "block";
        document.querySelector("#semcriado").style.display = "none";
        // Caso nao haja eventos inscritos, ira aparecer a mensagem
      }
    }
  });
}

lupa.addEventListener("click", () => {
  if (divInscrito.classList.contains('selected')){
    base.pesquisar(meus_eventos_inscritos, barra_pesquisa);
  } else if (divCriado.classList.contains('selected')){
    base.pesquisar(meus_eventos_criados, barra_pesquisa);
  } else {
    console.log("isso era pra ser impossível")
  }
});



// Adicionando um EventListener para quando for feita a pesquisa
barra_pesquisa.addEventListener("keypress", (event) => {
  let tecla = event.key;
  if (tecla == "Enter") {
    if (divInscrito.classList.contains('selected')){
      base.pesquisar(meus_eventos_inscritos, barra_pesquisa);
    } else if (divCriado.classList.contains('selected')){
      base.pesquisar(meus_eventos_criados, barra_pesquisa);
    } else {
      console.log("isso era pra ser impossível")
    }
  }
});

barra_pesquisa.addEventListener("search", () => {
  if (!barra_pesquisa.value) {
    base.esconderNaoAchou();
    if (divInscrito.classList.contains('selected')){
      meusEventosInscritos();
    } else if (divCriado.classList.contains('selected')){
      meusEventosCriados();
    } else {
      console.log("isso era pra ser impossível")
    }
  }
});

barra_pesquisa.addEventListener("input", () => {
  if (!barra_pesquisa.value) {
    base.esconderNaoAchou();
    if (divInscrito.classList.contains('selected')){
      meusEventosInscritos();
    } else if (divCriado.classList.contains('selected')){
      meusEventosCriados();
    } else {
      console.log("isso era pra ser impossível")
    }
  }
});
