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

//configurações do dragble de filtros de esporte
var $imagesCarousel = jQuery('.carouselOfImages').flickity({
  accessibility: false,
  autoPlay: false,
  pauseAutoPlayOnHover: false,
  cellAlign: 'left',
  contain: true,
  draggable: true,
  friction: 0.3,
  velocity: 0.8,
  initialIndex: 0,
  lazyLoad: false,
  percentPosition: true,
  prevNextButtons: false,
  pageDots: false,
  resize: true,
  rightToLeft: false,
  freeScroll: true,
  freeScrollFriction: 0.03,
  setGallerySize: true,
  watchCSS: false,
  wrapAround: false
});

// Evento gratuito ou não
const checkGratuito = document.querySelector(".form-check-input");
const precomax = document.querySelector("#divprecomax");

if (checkGratuito.checked == false){
  precomax.style.opacity = "1";
  precomax.style.height = "auto";
} else {
  precomax.style.opacity = "0";
  precomax.style.height = "0";
}

checkGratuito.addEventListener("change", () => {
  if (checkGratuito.checked == false){
    precomax.style.opacity = "1";
    precomax.style.height = "auto";
  } else {
    precomax.style.opacity = "0";
    precomax.style.height = "0";
  }
});

// Botao limpar filtros
const limpar_filtros = document.querySelector("#btn_limpar_filtros");
limpar_filtros.addEventListener("click", () =>{
  window.location.assign("../conexaoBancoDados/limpar_filtros.php");
});

