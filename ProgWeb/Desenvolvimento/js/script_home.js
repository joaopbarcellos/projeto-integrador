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

lupa.addEventListener("click", () => {
  let divSlides = document.querySelector(".carousel");
  let divDots = document.querySelector(".carousel-indicators");

  if(!barra_pesquisa.value){
    divSlides.style.display = "block";
    divDots.style.display = "block";
    lista_conteudo.forEach(conteudo => {
      conteudo.style.display = "block";
    })
  } else {
    divSlides.style.display = "none";
    divDots.style.display = "none";
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
  }
})

// Adicionando um EventListener para quando for feita a pesquisa
barra_pesquisa.addEventListener("search", () => {
  let divSlides = document.querySelector(".carousel");
  let divDots = document.querySelector(".carousel-indicators");

  if(!barra_pesquisa.value){
    divSlides.style.display = "block";
    divDots.style.display = "block";
    lista_conteudo.forEach(conteudo => {
      conteudo.style.display = "block";
    })
  } else {
    divSlides.style.display = "none";
    divDots.style.display = "none";
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
  }
});