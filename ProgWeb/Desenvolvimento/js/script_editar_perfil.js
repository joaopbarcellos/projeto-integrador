// Pegando os dados do usuário logado
var emailLogado = sessionStorage.getItem("logado");
const dadosUsuario = JSON.parse(localStorage.getItem(emailLogado));  

// Pegando os campos na tela
const campoNome = document.querySelector("#nome");
const campoEmail = document.querySelector("#email");
const campoDataNasc = document.querySelector("#idade");
const radios = document.querySelectorAll(".radio");

// Variável para verificação futura
let marcado = true;

// Pegando os labels de nome e email
const labelNome = document.querySelector("#label_nome");
const labelEmail = document.querySelector("#label_email");


// Função para preencher automaticamente os campos com os dados do usuário
function preencherAuto(){
    campoNome.value = dadosUsuario.nome;
    campoEmail.value = emailLogado;
    campoDataNasc.value = dadosUsuario.dataNasc;

    let radioMarcada = dadosUsuario.jogabilidade;

    // Mudando a classe dos labels para fins estéticos
    labelNome.classList.add("focado");

    labelEmail.classList.add("focado");

    // Selecionando qual é o nível do jogador
    radios.forEach(radio => {
        if(radio.children[0].id == radioMarcada){
            radio.children[0].checked = true;
        }
    })
}

// chamando a função
preencherAuto();


// Pegando o botão de editar
const btnEditar = document.querySelector("#alterar");

btnEditar.addEventListener("click", () => {
    // Pegando o nome, email e data de nascimento que o usuário deseja alterar
    let nome = campoNome.value;
    let email = campoEmail.value;
    let dataNasc = campoDataNasc.value; 

    radios.forEach(radio => {
        if(radio.children[0].checked){
            marcado = radio.children[0].id;
            // Pegando qual é o nível do jogador
        }
    });

    dadosUsuario.nome = nome;
    dadosUsuario.dataNasc = dataNasc;
    dadosUsuario.jogabilidade = marcado;
    dadosUsuario.email = email;
    // Colocando tudo no dicionário/mapa de dadosUsuario

    let stringJson = JSON.stringify(dadosUsuario);

    localStorage.removeItem(emailLogado);
    // Removendo o item antigo
    emailLogado = email;

    sessionStorage.setItem("logado", emailLogado);
    // Setando o novo item no sessionStorage

    localStorage.setItem(email, stringJson);
    // Setando o novo item no localStorage
    Swal.fire({
        icon: 'success',
        title: 'Perfil atualizado'
      }).then(() => {
        // Enviando para a página de login
        window.location.assign("perfil.html")
      })
    // Enviando o usuário de volta para a tela de perfil
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------FUNÇÕES PARA MUDAR TAMNHO DAS LABELS ESTETICAMENTE-------------------------------
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
campoNome.addEventListener("blur", () => {
    if (campoNome.value != ""){
        labelNome.classList.remove("semTexto");
        labelNome.classList.add("focado");
    } else {
        labelNome.classList.remove("focado");
        labelNome.classList.add("semTexto");
    }
})
  

campoEmail.addEventListener("blur", () => {
    if (campoEmail.value != ""){
        labelEmail.classList.remove("semTexto");
        labelEmail.classList.add("focado");
    } else {
        labelEmail.classList.remove("focado");
        labelEmail.classList.add("semTexto");
    }
})
  