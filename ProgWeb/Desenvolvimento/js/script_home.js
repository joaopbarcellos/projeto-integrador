// Mostrando o primeiro slide
let slideIndex = 1;
mostraSlides(slideIndex);

// Controle de voltar slides
document.querySelector(".prev").addEventListener("click", () => {
  mostraSlides(slideIndex += -1);
});

// Controle de passar slides
document.querySelector(".next").addEventListener("click", () => {
  mostraSlides(slideIndex += 1);
});

//passar slides sozinho
setInterval(
    function(){
        nextImage();
    
}, 5000)

function nextImage(){
    slideIndex++;
    if(slideIndex>3){
        slideIndex = 1;
    }
    mostraSlides(slideIndex);
}

// Passar e voltar slides com os dots
let pontos = document.querySelectorAll(".dot");
const dots = Array.from(pontos);

dots.forEach(dot => {
  dot.addEventListener("click", () => {
    let index = dots.indexOf(dot) + 1;
    mostraSlides(slideIndex = index);
  })
});

// Mostrar o slide correto na tela
function mostraSlides(n) {
  let slides = document.getElementsByClassName("mySlides"); // Armazendo as divs dos slides
  let dots = document.getElementsByClassName("dot"); // Armazenando os dots
  if (n > slides.length) {slideIndex = 1} // Se tentar passar o slide quando for o último, o index voltará ao primeiro
  if (n < 1) {slideIndex = slides.length} // Se tentar voltar o slide quando for o primeiro, o index irá para o último
  for (let i = 0; i < slides.length; i++) { // Passando por todas as imagens
    slides[i].style.display = "none"; // Tirando a visualização de todas as imagens
  }
  for (let i = 0; i < dots.length; i++) { // Passando por todos os dots
    dots[i].className = dots[i].className.replace(" active", ""); // Substituindo o nome da classe
  }
  slides[slideIndex-1].style.display = "block"; // Mostrando o slide
  dots[slideIndex-1].className += " active"; // Adicionando a classe de ativo no dot referente ao slide atual
}


// Pegando todos os botões para ir para o evento
const btns = document.querySelectorAll(".lista");

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


// Adicionando um EventListener para quando for feita a pesquisa
barra_pesquisa.addEventListener("search", () => {
  let divSlides = document.querySelector(".slideshow-container");
  let divDots = document.querySelector("#dots");

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