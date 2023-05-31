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