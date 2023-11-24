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

// Pegando todos os botoes para ir para o evento
const eventoSlide = document.querySelectorAll(".eventoslide");

// Percorrendo todos os botoes
eventoSlide.forEach((ev) => {
  // Adicionando um EventListener em cada um
  ev.addEventListener("click", () => {
    window.location.assign(`evento.php?id_evento=${ev.id}`);
  });
});

const barra_pesquisa = document.querySelector("#busca");
// Pegando a barra de pesquisa


const lupa = document.querySelector("#lupa");

// Adicionando EventListener para resetar a pagina quando o campo estiver em branco
barra_pesquisa.addEventListener("search", () => {
  if (!barra_pesquisa.value) {
    window.location.assign("index.php");
  }
});

// Adicionando um EventListener para quando for feita a pesquisa
barra_pesquisa.addEventListener("keypress", (event) => {
  let tecla = event.key;

  if (tecla == "Enter") {
    if (!barra_pesquisa.value) {
      window.location.assign("index.php");
    }
  }
});

lupa.addEventListener("click", () => {
  if (!barra_pesquisa.value) {
    window.location.assign("index.php");
  }
});

barra_pesquisa.addEventListener("input", () => {
  if (!barra_pesquisa.value) {
    window.location.assign("index.php");
  }
});

jQuery(document).ready(function($) {
  var owl = $(".slideowl").owlCarousel({
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


jQuery(document).ready(function($) {
  var owl2 = $(".filtro").owlCarousel({
      loop: true,
      margin: 20, // Ajuste a margem conforme necessário
      nav: false,
      autoplay: false,
      autoplayTimeout: 0,
      autoplayHoverPause: false,
      responsive: {
          0: {
              items: 4, // Ajuste o número de itens para telas menores
          },  
          416: {
              items: 6, // Ajuste o número de itens para telas menores
          },
          600: {
              items: 8,
          },
          700: {
              items: 10, // Ajuste o número de itens para telas de tamanho médio
          },
          1000: {
              items: 15, // Ajuste o número de itens para telas maiores
          },
          1814: {
              items: 20, // Ajuste o número de itens para telas maiores
          }
      }
  });
});