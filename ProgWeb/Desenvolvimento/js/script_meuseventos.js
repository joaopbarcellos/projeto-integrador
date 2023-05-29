// Pegando todos os botões para se inscrever
const cancel = document.querySelectorAll(".inscricao");

// Pegando o email do usuário logado
const email = sessionStorage.getItem("logado");
// Pegando todos os dados do usuário
const dados = JSON.parse(localStorage.getItem(email));

// Percorrendo todos os botões
cancel.forEach(btn =>{
    // Adicionando um EventListener em cada um
    btn.addEventListener("click", () => {
      cancelarInscricao(btn.id);
    });
  })


  // Caso o usuário não esteja logado
  if(!email){
      Swal.fire({
          // Alert avisando ao usuário fazer login
          title: 'Faça login!',
          icon: 'error',
          text: 'Você precisa estar logado para enviar mensagem',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Login'
      }).then((result) => {
          if(result.isConfirmed){
              // Enviando o usuário para a tela de login
              window.location.assign("index.html");
          }
      })
  }
function meusEventos(){
  let todosEventos = document.querySelectorAll(".evento");
  todosEventos.forEach(evento => {
      for(let i = 0; i < dados.eventos_inscritos.length; i++){
        if(evento.id == `div${dados.eventos_inscritos[i]}`){
        // Colocando display block em todos os eventos que o usuário está inscrito
        evento.style.display = "block";
        document.querySelector("#semevento").style.display = "none";
        }
      }
})
}

meusEventos()

function cancelarInscricao(id){
  Swal.fire({
    // Iniciando um alert perguntando se o usuário deseja cancelar a inscrição.
    title: 'Cancelar inscrição?',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sim',
    cancelButtonText: 'Não'
  }).then((result) => {
    if (result.isConfirmed) {
      // Alert para caso o usuário se inscreveu.
      Swal.fire(
        'Feito!',
        'Sua inscrição foi cancelada.',
        'success'
      ) 
      

      dados.eventos_inscritos = dados.eventos_inscritos.filter((valor) => {
        return valor != id;
        // Retirando da lista o evento que o usuário está desinscrevendo
      });

      let stringJson = JSON.stringify(dados);
      localStorage.setItem(email, stringJson);
      // Setando novamente no localStorage

      document.querySelector(`#div${id}`).style.display = "none";
      // Retirando o evento da tela
      if(!dados.eventos_inscritos.length){
        document.querySelector("#semevento").style.display = "block";
        // Caso não haja eventos inscritos, irá aparecer a mensagem
      }
    }
  })
}
