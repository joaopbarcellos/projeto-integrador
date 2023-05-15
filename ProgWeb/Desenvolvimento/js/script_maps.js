function calculaTamanhoMapa(mapa){
    const posicaoYMapa = mapa.offsetTop;
    const larguraPagina = window.innerWidth;
    const alturaPagina = window.innerHeight;
    mapa.style.width = `${larguraPagina}px`;
    mapa.style.height = `${alturaPagina - posicaoYMapa}px`;
}

function loadMapScenario() {
    const mapa = document.getElementById("mapa");
    calculaTamanhoMapa(mapa)
    var map = new Microsoft.Maps.Map(document.getElementById("mapa"), {
        center: new Microsoft.Maps.Location(-20.197396103583603, -40.217106774152555), 
        mapTypeId: Microsoft.Maps.MapTypeId.aerial, zoom:100
    });
    var pushpin = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(-20.197396103583603, -40.217106774152555), {color: "green", title: "Sede Time In"})
    map.entities.push(pushpin);
}
