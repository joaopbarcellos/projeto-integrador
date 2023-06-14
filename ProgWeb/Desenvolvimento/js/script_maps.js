function calculaTamanhoMapa(mapa){
    const posicaoYMapa = mapa.offsetTop;
    const larguraPagina = window.innerWidth;
    const alturaPagina = window.innerHeight;
    mapa.style.width = `${larguraPagina}px`;
    mapa.style.height = `${alturaPagina - posicaoYMapa}px`;
};

// locIfes, locAulaZico, locTreinoBlack, locNatacao, locMarDourado, loc10Corrida, locLEtape, locSurf, locBasquete, locMotocross
const locIfes = new Microsoft.Maps.Location(-20.197329691804068, -40.2170160437478);
const locAulaZico = new Microsoft.Maps.Location(-20.210745686329638, -40.26339017193191);
const locTreinoBlack = new Microsoft.Maps.Location(-20.277042066307818, -40.299547001384624);
const locNatacao = new Microsoft.Maps.Location(-19.98934303687819, -40.149159630227594);
const locMarDourado = new Microsoft.Maps.Location(-20.372179535206815, -40.30335365665824);
const loc10Corrida = new Microsoft.Maps.Location(-20.326947780230874, -40.291622531407256);
const locLEtape = new Microsoft.Maps.Location(-22.919773340159463, -43.1700841452671);
const locSurf = new Microsoft.Maps.Location(-20.37053693311, -40.30429837370785);
const locBasquete = new Microsoft.Maps.Location(-20.309387282525176, -40.294921876227576);
const locMotocross = new Microsoft.Maps.Location(-20.144511854276182, -40.18332926312631);
const locEventos = {};
locEventos["locIfes"] = locIfes ;
locEventos["aulazico"] = locAulaZico;
locEventos["basquetecaue"] = locBasquete;
locEventos["corridapenha"] = loc10Corrida;
locEventos["desafionatacao"] = locNatacao;
locEventos["etaperio"] = locLEtape;
locEventos["mardourado"] = locMarDourado;
locEventos["motocrossarena"] = locMotocross;
locEventos["surfitaparica"] = locSurf;
locEventos["treinoblack"] = locTreinoBlack;

function nomeEvento(){
    let nomeJanela = document.referrer.replace("/ProgWeb/Desenvolvimento/eventos/", "").replace(".html", "").replace("http://localhost:5500", "");
    return nomeJanela.toLowerCase();
};

function loadMapScenario(){
    const mapa = document.getElementById("mapa");

    calculaTamanhoMapa(mapa);
    
    if(window.innerWidth <= 540){
        console.log(nomeEvento());
        console.log(locEventos[nomeEvento()]);
        const maps = new Microsoft.Maps.Map(document.getElementById("mapa"), {
            center: locEventos[nomeEvento()],
            zoom: 100,
            NavigationBarMode: "minified",
            navigationBarOrientation: "vertical",
            showMapTypeSelector: false,
            showLocateMeButton: true,
        });
    } else{
        const maps = new Microsoft.Maps.Map(document.getElementById("mapa"), {
            center: locEventos[nomeEvento()],
            zoom: 100,
            NavigationBarMode: "minified",
            navigationBarOrientation: "horizontal",
            showLocateMeButton: true
        });
    }

}

window.addEventListener("resize", (e) =>{
    calculaTamanhoMapa(document.getElementById("mapa"));
});

loadMapScenario();