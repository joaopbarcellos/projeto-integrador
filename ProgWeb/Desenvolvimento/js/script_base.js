function send(tag){ // tag: campo de texto do email
  // Capturando o valor escrito no campo de texto
  let email = tag.value 
  
  // Conferindo se o valor escrito tem @, verificacao simples de email
  if (email.includes("@") && email.includes(".com")){ 
    // Mensagem de sucesso
    Swal.fire({
      // Alert informando para o usuario que o email foi enviado
      title: 'EMAIL ENVIADO!',
      icon: 'success',
      text: "Em breve você receberá novidades da Time In!",
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Confirmar',
  }) 
  } else {
    // Mensagem de erro
    Swal.fire({
      // Alert informando para o usuario que algo está errado
      title: 'ERRO!',
      icon: 'error',
      text: "Email inválido!",
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Login',
  }) 
  }

  // Definindo o valor do campo como vazio
  tag.value = "" 
}

const enviaEmail = document.querySelector("#enviarEmail")
const caixa_email = document.querySelector("#email")
if(enviaEmail){
  // Enviar email do footer
  enviaEmail.addEventListener("click", () =>{
    send(document.querySelector("#email"))
  })
}
if(caixa_email){
  // Enviar email do footer
  caixa_email.addEventListener("keypress", (event) =>{
    if(event.key == "Enter"){
      send(caixa_email)
    }
  })
}


function entrarEvento(){
  // Funcao para quando o usuario entrar numa tela de evento
  // Verifica se o usuario ja foi inscrito ou nao 

  // Pegando o nome da janela
  let nomeJanela = window.location.pathname.replace("/eventos/", "").replace(".html", "");
  // Verificando se o nome se encaixa nos tamanhos possiveis para eventos
  if(nomeJanela.length < 15){
    // Pegando os dados do usuario
    let dados = JSON.parse(localStorage.getItem(sessionStorage.getItem("logado")))
    // Se ele nao estiver inscrito, acabara a funcao
    if(!dados){
      return;
    }
    // Verificando se o usuario esta inscrito no evento
    if(dados.eventos_inscritos.find(janela => janela == nomeJanela)){
      // Mudando o que esta escrito no evento
      document.querySelector(".play").textContent = "Você está inscrito!"
      document.querySelector(".now").textContent = "Prepare-se!"
    }
  }
}

function inscrever(evento){
  // Pegando o email do usuario logado
  let emailLogado = sessionStorage.getItem("logado");

  if(emailLogado){
    // Se ele nao for nulo, isto e, se ha um usuario logado
    Swal.fire({
      // Alert perguntando se o usuario deseja se inscrever
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
        ).then((result) =>{
          if (result.isConfirmed){
            // Se ele se inscreveu, ira atualizar o botao
            entrarEvento()
          }
        })
        let dados = JSON.parse(localStorage.getItem(emailLogado));
        // Percorrendo a lista de eventos salva no usuairo para saber se ele ja foi inscrito no evento
        for(let i = 0; i < dados.eventos_inscritos.length; i++){
          if(dados.eventos_inscritos[i] == evento.id){
            Swal.fire({
              // Alert informando ao usuario se ele ja foi inscrito
              title: 'Você já está inscrito!',
              icon: 'info',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK'
            })
            entrarEvento();
            return;
          }
        }
        // Pegando os dados do usuario logado e adicionando na lista de eventos inscritos o novo evento
        dados.eventos_inscritos.push(evento.id);
            
        let stringJson = JSON.stringify(dados);
        // Setando novamente no localStorage
        localStorage.setItem(emailLogado, stringJson);
      }
    })
  } else {
    // Se ele nao estiver logado, ira ser mandado para a tela de login
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
  entrarEvento();
  // Adicionando o ouvidor do evento para se inscrever
  btnInscrever.addEventListener("click", () => {
    inscrever(btnInscrever);
})
}

function verficiaSeEleNasceuNaDataCorreta(data){
  // Pegando a data atual
  let dataDoDiaDeHoje = new Date();
  // Transformando a string "data" para tipo Date
  data = new Date(data);

  // Verificando se o dia informado e menor ou nao que o dia atual
  if(data.getFullYear() < dataDoDiaDeHoje.getFullYear()){
    return true;
  }else if(data.getFullYear() == dataDoDiaDeHoje.getFullYear()){
    if(data.getMonth() < dataDoDiaDeHoje.getMonth()){
      return true;
    }else if(data.getMonth() == dataDoDiaDeHoje.getMonth()){
      return data.getDate() + 1 <= dataDoDiaDeHoje.getDate();
    }
    return false;
  }
  return false;
}

export function dataErrada(campo, label, passouData){
  if(!verficiaSeEleNasceuNaDataCorreta(campo.value)){
    // Informando ao usuario que a data informada e invalida
    // Swal.fire({
    //   icon: "error",
    //   title: "Erro!",
    //   text: "Data Inválida!"
    // })
  
    // Mudando a cor do campo de texto e da label
    campo.style.cssText = "border-bottom: 1px solid #f58181";
    passouData.style.display = "block";
    label.classList.remove("certo");
    label.classList.add("erroVazio");
    return false;
  }
  passouData.style.display = "none";
  return true;
}


export function jogabilidadeMarcada(){
  // Funcao para saber qual jogabilidade foi marcada 
  const radios = document.querySelectorAll(".radio");
  let marcado = false;
  
  // Percorrendo todos os radios para saber qual e o marcado
  radios.forEach(radio => {
      if (radio.children[0].checked){
        marcado = radio.children[0].id;
      }
  })
  // Retornando o id do radio marcado
  return marcado;
}

export function verificaJogabilidade(labelJogador, labelsJogabilidade, noJogabilidade){
  // Funcao para verificar se a jogabilidade foi marcada
  let marcado = jogabilidadeMarcada();

  if (!marcado){
    // Se nao foi marcado, ira mudar as cores da label e dos radios
    labelJogador.classList.remove("certo")
    labelsJogabilidade.forEach(labelJogabilidade => {labelJogabilidade.classList.remove("certo")});
    labelJogador.classList.add("erroVazio");
    labelsJogabilidade.forEach(labelJogabilidade => {labelJogabilidade.classList.add("erroVazio")});
    noJogabilidade.style.display = "block";
    return false;
  }
  // Mudando as cores da label e dos radios
  noJogabilidade.style.display = "none";
  labelJogador.classList.add("certo")
  labelsJogabilidade.forEach(labelJogabilidade => {labelJogabilidade.classList.add("certo")});
  labelJogador.classList.remove("erroVazio");
  labelsJogabilidade.forEach(labelJogabilidade => {labelJogabilidade.classList.remove("erroVazio")});
  return true;
}

export function verificaCampoVazio(campo, label=false, noTexto, noTextoPadrao=false, noEmailExiste=false){
  // Funcao para verificar se o campo esta vazio
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

    if(noEmailExiste){
      // Escondendo a mensagem de erro;
      noEmailExiste.style.display = "none";
    }
      
    // Retorno da função
    return false;
  }
  // Escondendo a mensagem de erro;
  noTexto.style.display = "none";

  // Mudando a borda do campo
  campo.style.cssText = 'border-bottom: 1px solid rgb(95, 201, 74)';
  if(label){
    // Alterando a label
    label.classList.add("certo");
  }
  // Retorno da função
  return true;
}

// Função para autenticar se o email está dentro dos padrões
export function verificaEmailForaPadrao(campo, noEmail, noEmailPadrao, noEmailExiste=false) {
  if(noEmailExiste){
    // Escondendo a mensagem de erro;
    noEmailExiste.style.display = "none";
  }
  if(!campo.value.includes("@") || !campo.value.includes(".com")){
    // Mudando a borda do campo
    campo.style.cssText = 'border-bottom: 1px solid #f58181';
    // Mostrando a label de erro e escondendo a outra
    noEmail.style.display = "none";
    noEmailPadrao.style.display = "block";
    return false;
  }
  // Mudando a borda do campo
  campo.style.cssText = 'border-bottom: 1px solid rgb(95, 201, 74)';
  // Escondendo as labels de erro
  noEmail.style.display = "none";
  noEmailPadrao.style.display = "none";
  return true;
}

// Funcao para autenticar se a senha esta dentro dos padroes
export function verificaSenhaForaPadrao(campo, label, aotPass, passPassNew=false){
  if (campo.value.length < 6 || campo.value.length > 30) {
    // Mudando a borda do campo
    campo.style.cssText = 'border-bottom: 1px solid #f58181';

    if(passPassNew){
      // Escondendo uma label de erro
      passPassNew.style.display = "none";
    }
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
    label.classList.remove("erroVazio");
    label.classList.add("certo");

    // Mostrando a mensagem de erro;
    aotPass.style.display = "none";
    // Retorno da função
    return true;
  }
}

export function verificaSenhaSalva(campoSenha, outroCampo=false, label, label2=false, erro){
  if(outroCampo){
    if(campoSenha.value != outroCampo.value){
      campoSenha.style.cssText = 'border-bottom: 1px solid #f58181';
      outroCampo.style.cssText = 'border-bottom: 1px solid #f58181';
      erro.style.display = "block";
      // Mudando as classes da label de senha
      label.classList.add("erroPadrao");
      label.classList.remove("erroVazio");
      label.classList.remove("certo");
      label2.classList.add("erroPadrao");
      label2.classList.remove("erroVazio");
      label2.classList.remove("certo");
      return false;
    }
    campoSenha.style.cssText = 'border-bottom: 1px solid rgb(95, 201, 74';
    outroCampo.style.cssText = 'border-bottom: 1px solid rgb(95, 201, 74';
    erro.style.display = "none";
    // Mudando as classes da label de senha
    label.classList.remove("erroPadrao");
    label.classList.remove("erroVazio");
    label.classList.add("certo");
    label2.classList.add("erroPadrao");
    label2.classList.remove("erroVazio");
    label2.classList.remove("certo");
    return true;
  }else{
    if(campoSenha.value != JSON.parse(localStorage.getItem(sessionStorage.getItem("logado"))).senha){
      campoSenha.style.cssText = 'border-bottom: 1px solid #f58181';
      erro.style.display = "block";
      // Mudando as classes da label de senha
      label.classList.add("erroPadrao");
      label.classList.remove("erroVazio");
      label.classList.remove("certo");
      return false;
    }
    campoSenha.style.cssText = 'border-bottom: 1px solid rgb(95, 201, 74';
    erro.style.display = "none";
    // Mudando as classes da label de senha
    label.classList.remove("erroPadrao");
    label.classList.remove("erroVazio");
    label.classList.add("certo");
    return true;
  }
}

export function emailIgual(campoEmail, noEmailExiste){
  // Funcao para verificar se o email ja foi cadastrado
  if(JSON.parse(localStorage.getItem(campoEmail.value))){
    // Mostrando uma mensagem de erro para o usuario
    // Swal.fire({
    //   icon: 'error',
    //   title: 'Erro!',
    //   text: 'O Email já foi cadastrado!'
    // });
    // Mudando a cor do campo de texto
    campoEmail.style.cssText = 'border-bottom: 1px solid #f58181'
    // Mostrando a label de email ja cadastrado
    noEmailExiste.style.display = 'block'
    return false;
  }
  // Mudando a cor do campo de texto
  campoEmail.style.cssText = 'border-bottom: 1px solid rgb(95, 201, 74)'
  // Retirando a label de email ja cadastrado
  noEmailExiste.style.display = 'none'
  return true;
}

export function barraVazia(lista_conteudo, home=false){
  // Funcao chamada quando a barra de pesquisa ficar vazia
  if(home){
    // Se a funcao foi chamada na tela principal
    let divSlides = document.querySelector(".carousel-inner");
    let divDots = document.querySelector(".carousel-indicators");
    // Mostrando os slides e seus complementos
    divSlides.style.display = "block";
    divDots.style.display = "flex";
  }
  // Mostrando todos os eventos
  lista_conteudo.forEach(conteudo => {
    conteudo.style.display = "block";
  })
  // Escondendo mensagem de erro
  naoAchou.style.display = "none"
}

export function pesquisar(lista_conteudo, barra_pesquisa, home=false){
  // Funcao para pesquisar evento
  let naoAchou = document.querySelector("#naoAchou");
  let contAchou = 0;

  // Se o valor da barra de pesquisa for vazio, ira chamar a funcao
  if(!barra_pesquisa.value){
    barraVazia(lista_conteudo, home);
  } else {
    // Se o valor nao for vazio
    if(home){
      // Se essa funcao foi chamada na tela principal
      let divSlides = document.querySelector(".carousel-inner");
      let divDots = document.querySelector(".carousel-indicators");
      // Escondendo os slides e seus complementos
      divSlides.style.display = "none";
      divDots.style.display = "none";
    }
    // Percorrendo por todos os eventos
    lista_conteudo.forEach(conteudo =>{
      // Pegando o titulo do evento
      let titulo = conteudo.children[0].children[0].children[1].children[0].textContent.toUpperCase();

      // Verificando se o texto pesquisado e o mesmo que o titulo
      if(titulo.includes(barra_pesquisa.value.toUpperCase())){
        // Mostrando todos os conteudos que tiverem o texto pesquisado como titulo
        conteudo.style.display = "block";
        contAchou += 1;
      }else{
        // Escondendo todos os conteudos que nao tiverem o texto pesquisado como titulo
        conteudo.style.display = "none";
      }

      if(contAchou > 0){
        // Se achou pelo menos 1 evento, ira esconder mensagem de erro
        naoAchou.style.display = "none"
      } else {
        // Caso nao ache nenhum evento, escreve mensagem na tela informando que a pesquisa feita nao foi encontrada
        naoAchou.textContent = `Nenhum resultado para "${barra_pesquisa.value}" encontrado!`
        naoAchou.style.display = "block"
      }
    });
  }
}

const sair = document.querySelector("#logout");

if(sair){
  // Se existir um botao de sair na tela, ira adicionar esse ouvidor de evento
  sair.addEventListener("click", () => {
    // Se a tela for de evento, tera seu URL diferente
    if(window.location.pathname.includes("eventos")){
      // Mandando para a tela de login
      window.location.assign('../index.html');
    }else{
      // Mandando para a tela de login
      window.location.assign('./index.html');
    }
    // Apagando quem esta logado
    sessionStorage.clear();
  })
}


let criaevento = document.querySelector("#criaa");
if(criaevento){
  // Se existir o botao de criar evento
  criaevento.addEventListener("click", () => {
    // Caso o usuario clique
    Swal.fire({
      // Alert avisando ao usuario que a pagina ainda esta em desenvolvimento
      title: 'Página em desenvolvimento!',
      icon: 'info',
      text: 'Em breve, será disponibilizada.',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'OK'
    })
  })
}

let voltar = document.querySelector(".cssbuttons-io-button");
if(voltar){
  // Se exitir o botao voltar
  voltar.addEventListener("click", () => {
    // Enviando o usuario para a tela passada
    window.history.back();
})
}


// Funcao do Tema
