let voltar = document.querySelector(".cssbuttons-io-button");
if(voltar){
  // Adicionando o ouvidor do evento para se inscrever
  voltar.addEventListener("click", () => {
    window.history.back();
})
}

function calculaTamanhoMapa(mapa){
    const posicaoYMapa = mapa.offsetTop;
    const larguraPagina = window.innerWidth;
    const alturaPagina = window.innerHeight;
    mapa.style.width = `${larguraPagina}px`;
    mapa.style.height = `${alturaPagina - posicaoYMapa}px`;
}

function loadMapScenario() {
    const mapa = document.getElementById("mapa");
    const locIfes = Microsoft.Maps.Location(-20.197329691804068, -40.2170160437478);

    // aulaZico = Microsoft.Maps.Location(-20.210889496623864, -40.26341089837753);

    // Treino -20.277042066307818, -40.299547001384624

    // Natação -19.98934303687819, -40.149159630227594

    // Mar Dourado -20.372179535206815, -40.30335365665824

    // 10 corrida -20.326947780230874, -40.291622531407256

    // L'Étape -22.919773340159463, -43.1700841452671

    // Surf -20.37053693311, -40.30429837370785

    // Basquete -20.309387282525176, -40.294921876227576

    // Motocross -20.144511854276182, -40.18332926312631


    calculaTamanhoMapa(mapa)
    
    if(window.innerWidth <= 540){
        maps = new Microsoft.Maps.Map(document.getElementById("mapa"), {
            center: locIfes,
            zoom: 100,
            NavigationBarMode: "minified",
            navigationBarOrientation: "vertical",
            showMapTypeSelector: false,
            showLocateMeButton: true,
        });
    }
    else{
         maps = new Microsoft.Maps.Map(document.getElementById("mapa"), {
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