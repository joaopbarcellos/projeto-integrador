// Funcao para capturar o nome da pagina e saber de qual evento o mapa deve centralizar
function nomeEvento() {
  let nomeJanela = document.referrer
    .replace("/ProgWeb/Desenvolvimento", "")
    .replace("/eventos/", "")
    .replace(".php", "")
    .replace("http://", "")
    .replace("localhost", "")
    .replace("127.0.0.1", "")
    .replace(":5500", "")
    .replace("https://", "")
    .replace("jpzb.github.io/", "")
    .replace("projeto-integrador", "");
  return nomeJanela;
}

// Alterando o tamanho do mapa para mostrar na pagina
function calculaTamanhoMapa(mapa) {
  const posicaoYMapa = mapa.offsetTop;
  var alturaPagina = window.innerHeight;
  mapa.style.height = `${alturaPagina - posicaoYMapa}px`;
  mapa.style.width = `${document.querySelector("nav").clientWidth}px`;
}

function initMap() {
  // Recuperando a latitude e longitude do localStorage
  const localizacao = localStorage.getItem(nomeEvento());
  const coordenadas = JSON.parse(localizacao);
  const latitude = coordenadas["0"];
  const longitude = coordenadas["1"];

  // Verificando se deu f5 e se precisa carregar o mapa de uma nova pagina ou o anterior
  if (coordenadas == null) {
    coordenadas = localStorage.getItem("mapaAtual");
  } else {
    localStorage.setItem("mapaAtual", coordenadas);
  }

  // Criando o location do evento
  const locEvento = new Microsoft.Maps.Location(latitude, longitude);

  // Definindo tamanho do mapa
  mapa = document.querySelector("#mapa");
  calculaTamanhoMapa(mapa);

  // Verificando o tamanho da tela para a orientacao da NavBar
  if (window.innerWidth <= 540) {
    // Criando o mapa e centralizando
    const map = new Microsoft.Maps.Map(mapa, {
      center: locEvento,
      zoom: 19,
      NavigationBarMode: "minified",
      navigationBarOrientation: "vertical",
      showMapTypeSelector: false,
      showLocateMeButton: true,
    });
  } else {
    // Criando o mapa e centralizando com outra orientacao de NavBar
    const map = new Microsoft.Maps.Map(mapa, {
      center: locEvento,
      zoom: 19,
      NavigationBarMode: "minified",
      navigationBarOrientation: "horizontal",
    });
  }
}