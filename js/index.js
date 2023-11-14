// Importando a funcao de autenticacao de campos
import * as base from "./base.js";

// Pegando todos os botoes para ir para o evento
const btns = document.querySelectorAll(".evento");

// Percorrendo todos os botoes
btns.forEach((btn) => {
  // Adicionando um EventListener em cada um
  btn.addEventListener("click", () => {
    console.log(btn.id)
    window.location.assign(`evento.php?id_evento=${btn.id}`);
  });
});

console.log(btns)

// Pegando todos os botoes para ir para o evento
const eventoSlide = document.querySelectorAll(".item");

// Percorrendo todos os botoes
eventoSlide.forEach((ev) => {
  // Adicionando um EventListener em cada um
  ev.addEventListener("click", () => {
    window.location.assign(`evento.php?id_evento=${ev.id}`);
  });
});

const barra_pesquisa = document.querySelector("#busca");
// Pegando a barra de pesquisa

const lista_conteudo = document.querySelectorAll(".evento");
// Pegando a lista de eventos

const lupa = document.querySelector("#lupa");

// Adicionando EventListener para resetar a pagina quando o campo estiver em branco
barra_pesquisa.addEventListener("search", () => {
  if (!barra_pesquisa.value) {
    base.barraVazia(lista_conteudo, true);
  }
});

// Adicionando um EventListener para quando for feita a pesquisa
barra_pesquisa.addEventListener("keypress", (event) => {
  let tecla = event.key;

  if (tecla == "Enter") {
    base.pesquisar(lista_conteudo, barra_pesquisa, true);
  }
});

lupa.addEventListener("click", () => {
  base.pesquisar(lista_conteudo, barra_pesquisa, true);
});

barra_pesquisa.addEventListener("input", () => {
  if (!barra_pesquisa.value) {
    base.barraVazia(lista_conteudo, true);
  }
});

jQuery(document).ready(function($) {
  var owl = $(".owl-carousel").owlCarousel({
    center: true,
    loop: true,
    margin: 10,
    nav: false,
    items: 3,
    autoplay: true,
    autoplayTimeout: 7000,
    autoplaySpeed: 2000,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 2
      },
      1000: {
        items: 3
      }
    }
  });
    

  $(".custom-dot").on("click", function() {
    var dotIndex = $(this).data("dot-index");
    owl.trigger("to.owl.carousel", [dotIndex, 300]);
  });

  $(".custom-prev").on("click", function() {
    owl.trigger("prev.owl.carousel");
  });

  $(".custom-next").on("click", function() {
    owl.trigger("next.owl.carousel");
  });
  $(document).ready(function() {
    var slideHeight = $(".owl-carousel .item").height();
    var slideTop = $(".owl-carousel .item").offset().top;
    var arrowTopPosition = slideTop + (slideHeight / 2) - ($(".custom-prev").height() / 2);
    $(".custom-prev, .custom-next").css("top", arrowTopPosition + 30);
  });
});
