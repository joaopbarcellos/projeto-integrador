import {send} from "./script_base.js";

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

// Pegando as divs do slide
const mySlides = document.querySelectorAll(".mySlides");

// Percorrendo todas as divs
mySlides.forEach(slide =>{
  // Quando o usuário colocar o mouse em cima da div
  slide.addEventListener("mouseover", () =>{
    // Mostrando o campo de texto e o botão
    slide.children[2].style.display = "block";
    slide.children[2].style.opacity = "1";
  });
  // Quando o usuário retirar o mouse de cima da div
  slide.addEventListener("mouseout", () => {
    // Escondendo o campo de texto e o botão
    slide.children[2].style.display = "none";
  });
})

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
    }
    else{
      alert("Você não foi inscrito.")
    }
  })
})

// Enviar email do footer
document.querySelector("#enviarEmail").addEventListener("click", () =>{
  send(document.querySelector("#email"))
});

