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


function meusEventos(){
  // Verificando se o usuário está logado
  if(!email){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Você não está logado!'
    }).then(() => {
      // Enviando para a tela de login
      window.location.assign("index.html")
    })
  }
  let todosEventos = document.querySelectorAll(".evento");
  todosEventos.forEach(evento => {
    for(let i = 0; i < dados.eventos_inscritos  .length; i++){
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
      
      let idTodo = id.slice(3);
      // Id do botão cortado 
      // Id do botão == btnnomeEvento
      // Id da div contendo evento == divnomeEvento
      // Portando, é necessário cortar o id do botão para pegar a div inteira por motivos de praticidade

      dados.eventos_inscritos = dados.eventos_inscritos.filter((valor) => {
        return valor != idTodo;
        // Retirando da lista o evento que o usuário está desinscrevendo
      });

      let stringJson = JSON.stringify(dados);
      localStorage.setItem(email, stringJson);
      // Setando novamente no localStorage

      document.querySelector(`#div${idTodo}`).style.display = "none";
      // Retirando o evento da tela
      if(!dados.eventos_inscritos.length){
        document.querySelector("#semevento").style.display = "block";
        // Caso não haja eventos inscritos, irá aparecer a mensagem
      }
    }
  })
}