// Importando a função de autenticação de campos
import * as base from "./script_base.js";

// Ouvidor de cliques no botão de cadastro
document.querySelector("#cadastro").addEventListener("click", autenticar);

// Labels de erro
const noNome = document.querySelector("#noNome");
const noPass = document.querySelector("#noPass");
const noConfPass = document.querySelector("#noConfPass");
const noData = document.querySelector("#noData");
const noEmail = document.querySelector("#noEmail");
const passConfPass = document.querySelector("#passConfPass");
const aotPass = document.querySelector("#aotPass");
const aotConfPass = document.querySelector("#aotConfPass");
const noEmailPadrao = document.querySelector("#noEmailPadrao");
const noEmailExiste = document.querySelector("#noEmailExiste")

// Campo de nome
const campoNome = document.querySelector("#floatingInputGroup1");

// Campo de email
const campoEmail = document.querySelector("#floatingInputGroup2");

// Campos da data
const campoData = document.querySelector("#idade");

// Campos de senha e confirmar senha
const campoSenha = document.querySelector("#floatingInputGroup3");
const campoConfSenha = document.querySelector("#floatingInputGroup4");

campoConfSenha.addEventListener("keypress", (event) => {
    if(event.key == "Enter"){
        autenticar();
    }
})
// Labels
const labelEmail = document.querySelector("#email_label")
const labelJogador = document.querySelector(".label_joga")
const labelsJogabilidade = document.querySelectorAll(".jogabilidades");
const labelConf_Senha = document.querySelector("#senha_label_confirma");
const labelSenha = document.querySelector("#senha_label");
const labelNome = document.querySelector("#label_nome");
const labelData = document.querySelector("#labelData");


function emailIgual(email){
    if(JSON.parse(localStorage.getItem(email))){
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: 'O Email já foi cadastrado!'
        });
        campoEmail.style.cssText = 'border-bottom: 1px solid #f58181'
        noEmailExiste.style.display = 'block'
        return false;
    }
    campoEmail.style.cssText = 'border-bottom: 1px solid rgb(95, 201, 74)'
    noEmailExiste.style.display = 'none'
    return true;
}


function autenticar(){
    if(verificaTudo()){
        // Valor da data de nascimento
        let dataNasc = campoData.value; 
        if(base.verficiaSeEleNasceuNaDataCorreta(dataNasc)){
            base.dataErrada(campoData, labelData);
            return;
        }

        // Valor do nome
        let nome = campoNome.value;
        // Valor da tipo do jogador
        let jogabilidade = base.jogabilidadeMarcada();

        // Valor do email
        let email = campoEmail.value.toLowerCase();
        

        // Valores de senha e confirmar senha
        let senha = campoSenha.value;
        let confSenha = campoConfSenha.value;

        if(base.senhaIgual(senha, confSenha) && emailIgual(email)){
            let stringJSON = {
                "email": email,
                "nome": nome,
                "dataNasc": dataNasc,
                "senha": senha,
                "jogabilidade": jogabilidade,
                "eventos_inscritos": []
            }
            salvar(email, stringJSON)
            window.location.assign("index.html");
        }
    }
}

function verificaTudo(){
    let verificaNome = base.verificaCampoVazio(campoNome, labelNome, noNome);
    let verificaEmail = base.verificaCampoVazio(campoEmail, labelEmail, noEmail, noEmailPadrao, noEmailExiste);
    if(verificaEmail){
        verificaEmail = base.verificaEmailForaPadrao(campoEmail, noEmail, noEmailPadrao, noEmailExiste);
    }

    let verificaSenha = base.verificaCampoVazio(campoSenha, labelSenha, noPass, aotPass);
    if(verificaSenha){
        verificaSenha = base.verificaSenhaForaPadrao(campoSenha, labelSenha, aotPass);
    }
    
    let verificaDataVazia = base.verificaCampoVazio(campoData, labelData, noData); 

    let verificaConfSenha = base.verificaCampoVazio(campoConfSenha, labelConf_Senha, noConfPass, aotConfPass);
    if(verificaConfSenha){
        verificaConfSenha = base.verificaSenhaForaPadrao(campoConfSenha, labelConf_Senha, aotConfPass);
    }


    // Verificando a jogabilidade
    let verJog = base.verificaJogabilidade(labelJogador, labelsJogabilidade, noJogabilidade);
    

    let listaTudo = [verificaConfSenha, verificaDataVazia, verificaEmail, verJog, verificaNome, verificaSenha]
    return listaTudo.every(element => element);
}

function salvar(email, stringJSON){
    localStorage.setItem(email, JSON.stringify(stringJSON));
}

let voltar = document.querySelector(".cssbuttons-io-button");
if(voltar){
    // Adicionando o ouvidor do evento para se inscrever
    voltar.addEventListener("click", () => {
        window.history.back();
    })
}


const olho1 = document.querySelector("#olho");
// Mostrar/ocultar senha
olho1.addEventListener('click', function() {
    let input = document.querySelector('#floatingInputGroup3')
    if(input.type == 'text'){
        input.type = 'password';
        olho1.src = './img/olho_aberto.png';
        
    } else if (input.type == 'password'){
        input.type = 'text';
        olho1.src = './img/olho_fechado.png';
    }
});

const olho2 = document.querySelector("#olho2");

// Mostrar/ocultar senha
olho2.addEventListener('click', function() {
    let input = document.querySelector('#floatingInputGroup4');
    if(input.type == 'text'){
        input.type = 'password';
        olho2.src = './img/olho_aberto.png';
        
    } else if (input.type == 'password'){
        input.type = 'text';
        olho2.src = './img/olho_fechado.png';
    }
});
