// Importando a função de autenticação de campos
import * as base from "./script_base.js";

// Pegando todos os botões para ir para o evento
const btns = document.querySelectorAll(".sabermais");

// Percorrendo todos os botões
btns.forEach(btn =>{
  // Adicionando um EventListener em cada um
  btn.addEventListener("click", () => {
    window.location.assign(`eventos/${btn.id}.html`)
  });
})

const barra_pesquisa = document.querySelector("#busca");
// Pegando a barra de pesquisa

const lista_conteudo = document.querySelectorAll(".evento");
// Pegando a lista de eventos

const lupa = document.querySelector("#lupa");

// Adicionando EventListener para resetar a página quando o campo estiver em branco
barra_pesquisa.addEventListener("search", () =>{
  if(!barra_pesquisa.value){
    base.barraVazia(lista_conteudo, true)
  }
})

// Adicionando um EventListener para quando for feita a pesquisa
barra_pesquisa.addEventListener("keypress", (event) => {
  let tecla = event.key;

  if(tecla == "Enter"){
      base.pesquisar(lista_conteudo, barra_pesquisa, true);
    }
});

lupa.addEventListener("click", () =>{
  base.pesquisar(lista_conteudo, barra_pesquisa, true)
})
