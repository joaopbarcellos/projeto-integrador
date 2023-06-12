function send(tag){ // tag: campo de texto do email
  // Capturando o valor escrito no campo de texto
  let email = tag.value 
  
  // Conferindo se o valor escrito tem @, verificação simples de email
  if (email.includes("@") && email.includes(".com")){ 
    // Mensagem de sucesso
    Swal.fire({
      // Alert informando para o usuário que o email foi enviado
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

function entrarEvento(){
  let nomeJanela = window.location.pathname.replace("/eventos/", "").replace(".html", "");
  if(nomeJanela.length < 15){
    let dados = JSON.parse(localStorage.getItem(sessionStorage.getItem("logado")))
    if(!dados){
      return;
    }
    if(dados.eventos_inscritos.find(janela => janela == nomeJanela)){
      document.querySelector(".play").textContent = "Você está inscrito!"
      document.querySelector(".now").textContent = "Prepare-se!"
    }
  }
}

function inscrever(evento){
  // Pegando o email do usuário logado
  let emailLogado = sessionStorage.getItem("logado");

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
        ).then((result) =>{
          if (result.isConfirmed){
            entrarEvento()
          }
        })
        let dados = JSON.parse(localStorage.getItem(emailLogado));
        for(let i = 0; i < dados.eventos_inscritos.length; i++){
          if(dados.eventos_inscritos[i] == evento.id){
            Swal.fire({
              // Alert perguntando se o usuário deseja se inscrever
              title: 'Você já está inscrito!',
              icon: 'info',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK'
            })
            entrarEvento();
            return;
          }
        }
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
  entrarEvento();
  // Adicionando o ouvidor do evento para se inscrever
  btnInscrever.addEventListener("click", () => {
    inscrever(btnInscrever);
})
}

export function verficiaSeEleNasceuNaDataCorreta(data){
    let dataDoDiaDeHoje = new Date();
    data = new Date(data);
    
    return data.getFullYear() >= dataDoDiaDeHoje.getFullYear() && dataDoDiaDeHoje.getMonth() + 1 <= data.getMonth() + 1 && dataDoDiaDeHoje.getDate() <= data.getDate();
}

export function dataErrada(campo, label){
  Swal.fire({
    icon: "error",
    title: "Erro!",
    text: "Data Inválida!"
  })

  campo.style.cssText = "border-bottom: 1px solid #f58181";
  label.classList.remove("certo");
  label.classList.add("erroVazio");
}



export function verificaCampoVazio(campo, label=false, noTexto, noTextoPadrao=false, noEmailExiste=false){
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

export function jogabilidadeMarcada(){
  const radios = document.querySelectorAll(".radio");
  let marcado = false;
  
  radios.forEach(radio => {
      if (radio.children[0].checked){
          marcado = radio.children[0].id;
      }
  })
  return marcado;
}

export function verificaJogabilidade(labelJogador, labelsJogabilidade, noJogabilidade){
  let marcado = jogabilidadeMarcada();

  if (!marcado){
      labelJogador.classList.remove("certo")
      labelsJogabilidade.forEach(labelJogabilidade => {labelJogabilidade.classList.remove("certo")});
      labelJogador.classList.add("erroVazio");
      labelsJogabilidade.forEach(labelJogabilidade => {labelJogabilidade.classList.add("erroVazio")});
      noJogabilidade.style.display = "block";
      return false;
  }
  noJogabilidade.style.display = "none";
  labelJogador.classList.add("certo")
  labelsJogabilidade.forEach(labelJogabilidade => {labelJogabilidade.classList.add("certo")});
  labelJogador.classList.remove("erroVazio");
  labelsJogabilidade.forEach(labelJogabilidade => {labelJogabilidade.classList.remove("erroVazio")});
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
    noEmail.style.display = "none";
    noEmailPadrao.style.display = "block";
    return false;
  }
  campo.style.cssText = 'border-bottom: 1px solid rgb(95, 201, 74)';
  noEmail.style.display = "none";
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
    label.classList.remove("erroVazio");
    label.classList.add("certo");

    // Mostrando a mensagem de erro;
    aotPass.style.display = "none";
    // Retorno da função
    return true;
  }
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


export function barraVazia(lista_conteudo, home=false){
  if(home){
    let divSlides = document.querySelector(".carousel-inner");
    let divDots = document.querySelector(".carousel-indicators");
    divSlides.style.display = "block";
    divDots.style.display = "flex";
  }
  lista_conteudo.forEach(conteudo => {
    conteudo.style.display = "block";
  })
  naoAchou.style.display = "none"
}

export function pesquisar(lista_conteudo, barra_pesquisa, home=false){
  let naoAchou = document.querySelector("#naoAchou");
  let contAchou = 0;

  if(!barra_pesquisa.value){
    barraVazia(lista_conteudo, home);
  } else {
    if(home){
      let divSlides = document.querySelector(".carousel-inner");
      let divDots = document.querySelector(".carousel-indicators");
      divSlides.style.display = "none";
      divDots.style.display = "none";
    }
    // Percorrendo por todos os eventos
    lista_conteudo.forEach(conteudo =>{
      // Pegando o título do evento
      let titulo = conteudo.children[0].children[0].children[1].children[0].textContent.toUpperCase();

      // Verificando se o texto pesquisado é o mesmo que o título
      if(titulo.includes(barra_pesquisa.value.toUpperCase())){
        // Mostrando todos os conteúdos que tiverem o texto pesquisado como título
        conteudo.style.display = "block";
        contAchou += 1;
      }else{
        // Escondendo todos os conteúdos que não tiverem o texto pesquisado como título
        conteudo.style.display = "none";
      }

      if(contAchou > 0){
        naoAchou.style.display = "none"
      } else {
        naoAchou.textContent = `Nenhum resultado para "${barra_pesquisa.value}" encontrado!`
        naoAchou.style.display = "block"
      }
    });
  }
}

const sair = document.querySelector("#logout");

if(sair){
  sair.addEventListener("click", () => {
    window.location.assign('../index.html');
    sessionStorage.clear();
  })
}


let criaevento = document.querySelector("#criaa");
if(criaevento){
    criaevento.addEventListener("click", () => {
        Swal.fire({
            // Alert avisando ao usuário que o email não está cadastrado no banco
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
  // Adicionando o ouvidor do evento para se inscrever
  voltar.addEventListener("click", () => {
    window.history.back();
})
}
