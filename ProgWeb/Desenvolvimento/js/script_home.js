// Pegando todos os botões para ir para o evento
const btns = document.querySelectorAll(".sabermais");

// Percorrendo todos os botões
btns.forEach(btn =>{
  // Adicionando um EventListener em cada um
  btn.addEventListener("click", () => {
    window.location.assign(`eventos/${btn.id}.html`)
  });
})

const lista_conteudo = document.querySelectorAll(".evento");
// Pegando a lista de eventos

const barra_pesquisa = document.querySelector("#busca");
// Pegando a barra de pesquisa

const lupa = document.querySelector("#lupa");

lupa.addEventListener("click", pesquisar);

// Adicionando EventListener para resetar a página quando o campo estiver em branco
barra_pesquisa.addEventListener("search", () =>{
  if(!barra_pesquisa.value){
    barraVazia()
  }
})

let divSlides = document.querySelector(".carousel-inner");
let divDots = document.querySelector(".carousel-indicators");

function barraVazia(){
  divSlides.style.display = "block";
  divDots.style.display = "flex";
  lista_conteudo.forEach(conteudo => {
    conteudo.style.display = "block";
  })
  naoAchou.style.display = "none"
}


// Adicionando um EventListener para quando for feita a pesquisa
barra_pesquisa.addEventListener("keypress", (event) => {
  let tecla = event.key;

  if(tecla == "Enter"){
      pesquisar();
    }
});

function pesquisar(){
  let naoAchou = document.querySelector("#naoAchou");
  let contAchou = 0;

  if(!barra_pesquisa.value){
    barraVazia();
  } else {
    divSlides.style.display = "none";
    divDots.style.display = "none";
    // Percorrendo por todos os eventos
    lista_conteudo.forEach(conteudo =>{
      // Pegando o título do evento
      let titulo = conteudo.children[0].children[0].children[1].children[0].textContent.toUpperCase();

      // Verificando se o texto pesquisado é o mesmo que o título
      if(titulo.includes(barra_pesquisa.value.toUpperCase())){
        // Mostrando todos os conteúdos que tiverem o texto pesquisado como título
        conteudo.style.display = "block";
        contAchou += 1;
      }else{
        // Escondendo todos os conteúdos que não tiverem o texto pesquisado como título
        conteudo.style.display = "none";
      }

      if(contAchou > 0){
        naoAchou.style.display = "none"
      } else {
        naoAchou.textContent = `Nenhum resultado para "${barra_pesquisa.value}" encontrados!`
        naoAchou.style.display = "block"
      }
    });
  }
}