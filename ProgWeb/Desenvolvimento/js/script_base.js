function send(tag){ // tag: campo de texto do email
  // Capturando o valor escrito no campo de texto
  let email = tag.value 
  
  // Conferindo se o valor escrito tem @, verificação simples de email
  if (email.includes("@") && email.includes(".com")){ 
    // Mensagem de sucesso
    Swal.fire({
      // Alert informando para o usuário que algo está errado
      title: 'EMAIL ENVIADO!',
      icon: 'success',
      text: "Em breve você receberá novidades da Time In!",
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Confirmar',
  }) 
  } else {
    // Mensagem de erro
    Swal.fire({
      // Alert informando para o usuário que algo está errado
      title: 'ERRO!',
      icon: 'error',
      text: "Email inválido!",
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Confirmar',
  }) 
  }

  // Definindo o valor do campo como vazio
  tag.value = "" 
}

function inscrever(evento){
  let emailLogado = sessionStorage.getItem("logado");
  // Pegando o email do usuário logado

  if(emailLogado){
    // Se ele não for nulo, isto é, se há um usuário logado
    Swal.fire({
      // Alert perguntando se o usuário deseja se inscrever
      title: 'Confirmar inscrição?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirmar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        // Alert para caso ele confirmou
        Swal.fire(
          'Confirmado!',
          'Você foi inscrito.',
          'success'
        ) 
        
        let dados = JSON.parse(localStorage.getItem(emailLogado));
        // Pegando os dados do usuário logado e adicionando na lista de eventos inscritos o novo evento
        dados.eventos_inscritos.push(evento.id);
        

        let stringJson = JSON.stringify(dados);
        // Setando novamente no localStorage
        localStorage.setItem(emailLogado, stringJson);
      }
    })
  } else {
    // Se ele não estiver logado, irá ser mandado para a tela de login
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Você não está logado!'
    }).then(() => {
      // Enviando para a página de login
      window.location.assign("../index.html")
    })
  }
}

let btnInscrever = document.querySelector(".inscrever");
if(btnInscrever){
  // Adicionando o ouvidor do evento para se inscrever
  btnInscrever.addEventListener("click", () => {
    inscrever(btnInscrever);
})
}

export function verificaCampoVazio(campo, label=false, noTexto, noTextoPadrao=false){
  if(!campo.value){
      if(label){
        // Mudando a borda do campo
        campo.style.cssText = 'border-bottom: 1px solid #f58181';
        label.classList.remove("certo");
        label.classList.add("erroVazio");
      }
      // Mostrando a mensagem de erro;
      noTexto.style.display = "block";
      
      if(noTextoPadrao){
        // Escondendo a mensagem de erro;
        noTextoPadrao.style.display = "none";
      }
      
      // Retorno da função
      return false;

  } else {
      // Mostrando a mensagem de erro;
      noTexto.style.display = "none";
      // Retorno da função
      return true;
  }
}


// Função para autenticar se o email está dentro dos padrões
export function verificaEmailForaPadrao(campo, noEmail, noEmailPadrao) {
  if(!campo.value.includes("@") || !campo.value.includes(".com")){
    noEmail.style.display = "none";
    noEmailPadrao.style.display = "block";
    return false;
  }
  noEmailPadrao.style.display = "none";
  return true;
}


// Função para autenticar se a senha está dentro dos padrões
export function verificaSenhaForaPadrao(campo, label, aotPass){
  if (campo.value.length < 6 || campo.value.length > 30) {
    // Mudando a borda do campo
    campo.style.cssText = 'border-bottom: 1px solid #f58181';

    // Mudando as classes da label de senha
    label.classList.add("erroPadrao");
    label.classList.remove("erroVazio");
    label.classList.remove("certo");
    
    // Mostrando a mensagem de erro;
    aotPass.style.display = "block";
    
    // Retorno da função
    return false;

} else {
    // Mudando a borda do campo
    campo.style.cssText = 'border-bottom: 1px solid rgb(95, 201, 74)';    

    // Mudando as classes da label de senha
    label.classList.remove("erroPadrao");
    label.classList.add("certo");

    // Mostrando a mensagem de erro;
    aotPass.style.display = "none";
    // Retorno da função
    return true;
}
}

const enviaEmail = document.querySelector("#enviarEmail")
if(enviaEmail){
  // Enviar email do footer
  enviaEmail.addEventListener("click", () =>{
    send(document.querySelector("#email"))
  })
}

var criaa = document.getElementById("criaa");
if(criaa){
  criaa.addEventListener("click", criarEvento);
  function criarEvento(){
    Swal.fire({
      icon: 'info',
      title: 'Oops...',
      text: 'Esta página está em desenvolvimento'
  
    })
  }
}

window.addEventListener('scroll', () => {  
  const elemento = document.querySelector('.fixo'); //pego o botao
  const tabel = document.querySelector('.table');//pego o elemento q fica no final da tabela
  const num = document.querySelector('#t_organizador');//pego o elemento numero de inscritos
  const scrollPosition = window.scrollY;//pego a altura da parte mostrada na pagina
  
  let switchHeight = 0
  if(num){
    const posicaoTopnum = num.offsetTop;
    if(tabel){
      const posicaoheighttabel = tabel.offsetHeight;
      switchHeight = posicaoheighttabel - 30;
    }else{
      console.log(posicaoTopnum, scrollPosition)
      switchHeight = posicaoTopnum - 500;
    }
  }
  
  
  if(elemento){
    if (scrollPosition > switchHeight) {//quando a altura da parte mostrada for maior que meu momento de troca, faco a troca do meu css
      // define a classe CSS para tornar o elemento relativo
      elemento.classList.add('inscrever-relativo');
    } else {
      // define a classe CSS para tornar o elemento fixo
      elemento.classList.remove('inscrever-relativo');
    }
  }
  
});