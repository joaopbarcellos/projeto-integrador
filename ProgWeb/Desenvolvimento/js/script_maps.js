function calculaTamanhoMapa(mapa){
    const posicaoYMapa = mapa.offsetTop;
    const larguraPagina = window.innerWidth;
    const alturaPagina = window.innerHeight;
    mapa.style.width = `${larguraPagina}px`;
    mapa.style.height = `${alturaPagina - posicaoYMapa}px`;
}

// locIfes, AulaZico, TreinoBlack, Natacao, MarDourado, 10Corrida, LEtape, Surf, Basquete, Motocross
//const locEventos = [new Microsoft.Maps.Location(-20.197329691804068, -40.2170160437478), new Microsoft.Maps.Location(-20.210889496623864, -40.26341089837753),     new Microsoft.Maps.Location(-20.277042066307818, -40.299547001384624), new Microsoft.Maps.Location(-19.98934303687819, -40.149159630227594), new Microsoft.Maps.Location(-20.372179535206815, -40.30335365665824), new Microsoft.Maps.Location(-20.326947780230874, -40.291622531407256), new Microsoft.Maps.Location(-22.919773340159463, -43.1700841452671), new Microsoft.Maps.Location(-20.37053693311, -40.30429837370785), new Microsoft.Maps.Location(-20.309387282525176, -40.294921876227576), new Microsoft.Maps.Location(-20.144511854276182, -40.18332926312631)]

function entrarEvento(){
    let nomeJanela = document.referrer.replace("http://localhost:5500/eventos/", "").replace(".html", "");
    console.log(nomeJanela)
}
entrarEvento()

function loadMapScenario(){
    const mapa = document.getElementById("mapa");

    calculaTamanhoMapa(mapa)
    
    const locIfes = new Microsoft.Maps.Location(-20.197329691804068, -40.2170160437478)
    if(window.innerWidth <= 540){
        const maps = new Microsoft.Maps.Map(document.getElementById("mapa"), {
            center: locIfes,
            zoom: 100,
            NavigationBarMode: "minified",
            navigationBarOrientation: "vertical",
            showMapTypeSelector: false,
            showLocateMeButton: true,
        });
    }
    else{
        const maps = new Microsoft.Maps.Map(document.getElementById("mapa"), {
            center: locIfes,
            zoom: 100,
            NavigationBarMode: "minified",
            navigationBarOrientation: "horizontal",
            showLocateMeButton: true
        });
    }

    // var pushpin = new Microsoft.Maps.Pushpin(new locIfes, {color: "green", title: "Sede Time In"})
    // mapa.entities.push(pushpin);
}

window.addEventListener("resize", (e) =>{
    calculaTamanhoMapa(document.getElementById("mapa"));
} )