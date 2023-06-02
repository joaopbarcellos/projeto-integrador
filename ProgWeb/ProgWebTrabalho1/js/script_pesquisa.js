import {send} from "./script_base.js";

let lista_conteudo = document.querySelectorAll(".evento");
// Pegando a lista de eventos

let barra_pesquisa = document.querySelector("#busca");
// Pegando a barra de pesquisa

// Adicionando um EventListener para quando for feita a pesquisa
barra_pesquisa.addEventListener("search", () => {
  // Percorrendo por todos os eventos
  lista_conteudo.forEach(conteudo =>{
    // Pegando o título do evento
    let titulo = conteudo.children[0].children[1].children[0].textContent.toUpperCase();

    // Verificando se o texto pesquisado é o mesmo que o título
    if(titulo.includes(barra_pesquisa.value.toUpperCase())){
      // Mostrando todos os conteúdos que tiverem o texto pesquisado como título
      conteudo.style.display = "block";
    }else{
      // Escondendo todos os conteúdos que não tiverem o texto pesquisado como título
      conteudo.style.display = "none";
    }
  });
});

// Pegando todos os botões para se inscrever
const btns = document.querySelectorAll(".inscrever");

// Percorrendo todos os botões
btns.forEach(btn =>{
  // Adicionando um EventListener em cada um
  btn.addEventListener("click", () => {
    // Perguntando ao usuário
    let confirmar = confirm("Deseja se inscrever no evento?")
    // Verificando se o usuário confirmou a pergunta
    if(confirmar){
      alert("Você foi inscrito no evento.")
    }else{
      alert("Você não foi inscrito.")
    }
  })
})

// Enviar email do footer
document.querySelector("#enviarEmail").addEventListener("click", () =>{
  send(document.querySelector("#email"))
});