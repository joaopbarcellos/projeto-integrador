function nomeEvento(){
    let nomeJanela = document.referrer.replace("/ProgWeb/Desenvolvimento").replace("/eventos/", "").replace(".html", "").replace("http://", "").replace("localhost", "").replace("127.0.0.1", "").replace( ":5500", "");
    return nomeJanela.toLowerCase();
};

const mapa = document.getElementById("mapa");

// Funcao que calcula o tamanho do mapa com base no tamanho da tela
function calculaTamanhoMapa(mapa){
    const posicaoYMapa = mapa.offsetTop;
    var alturaPagina = window.innerHeight;
    mapa.style.height = `${alturaPagina - posicaoYMapa}px`;
    mapa.style.width = `${document.querySelector("nav").clientWidth}px`
}

// locIfes, locAulaZico, locTreinoBlack, locNatacao, locMarDourado, loc10Corrida, locLEtape, locSurf, locBasquete, locMotocross
const locIfes = (-20.197329691804068, -40.2170160437478);
const locAulaZico = (-20.210745686329638, -40.26339017193191);
const locTreinoBlack = (-20.277042066307818, -40.299547001384624);
const locNatacao = (-19.98934303687819, -40.149159630227594);
const locMarDourado = (-20.372179535206815, -40.30335365665824);
const loc10Corrida = (-20.326947780230874, -40.291622531407256);
const locLEtape = (-22.919773340159463, -43.1700841452671);
const locSurf = (-20.37053693311, -40.30429837370785);
const locBasquete = (-20.309387282525176, -40.294921876227576);
const locMotocross = (-20.144511854276182, -40.18332926312631);
const locEventos = {};
locEventos["locIfes"] = locIfes;
locEventos["aulazico"] = locAulaZico;
locEventos["basquetecaue"] = locBasquete;
locEventos["corridapenha"] = loc10Corrida;
locEventos["desafionatacao"] = locNatacao;
locEventos["etaperio"] = locLEtape;
locEventos["mardourado"] = locMarDourado;
locEventos["motocrossarena"] = locMotocross;
locEventos["surfitaparica"] = locSurf;
locEventos["treinoblack"] = locTreinoBlack;

function initMap() {
    calculaTamanhoMapa(mapa)
    // Cria um objeto de mapa
    var map = new Microsoft.Maps.Map('#map', {
        credentials: 'ApnC6tV3CfJdVOfveqNzIuG3c35nb-C9fVqrksCiQD2-BOQNdsDS76pGWTgx4y4w', // Substitua por sua chave da API do Bing Maps
        center: new Microsoft.Maps.Location(locEventos[nomeEvento()][0], locEventos[nomeEvento()][1]),
        zoom: 12
    });

    // Adicione um marcador no centro do mapa
    var centerMarker = new Microsoft.Maps.Pushpin(map.getCenter(), {});
    map.entities.push(centerMarker);
}


window.addEventListener("resize", (e) =>{
    calculaTamanhoMapa(document.getElementById("mapa"));
});