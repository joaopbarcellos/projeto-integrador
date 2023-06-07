let voltar = document.querySelector(".cssbuttons-io-button");
if(voltar){
  // Adicionando o ouvidor do evento para se inscrever
  voltar.addEventListener("click", () => {
    window.history.back();
})
}