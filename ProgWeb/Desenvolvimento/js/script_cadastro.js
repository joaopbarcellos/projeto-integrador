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

// Campo de nome
const campoNome = document.querySelector("#floatingInputGroup1");

// Campo de email
const campoEmail = document.querySelector("#floatingInputGroup2");

// Campos da data
const campoData = document.querySelector("#idade");

// Campos de senha e confirmar senha
const campoSenha = document.querySelector("#floatingInputGroup3");
const campoConfSenha = document.querySelector("#floatingInputGroup4");

// Labels
const labelEmail = document.querySelector("#label_email")
const labelJogador = document.querySelector(".label_joga")
const labelsJogabilidade = document.querySelectorAll(".jogabilidades");
const labelConf_Senha = document.querySelector("#senha_label_confirma");
const labelSenha = document.querySelector("#senha_label");
const labelNome = document.querySelector("#label_nome");
const labelData = document.querySelector("#labelData");

function autenticar(){
    // Valor do nome
    let nome = campoNome.value;

    // Valor do email
    let email = campoEmail.value;

    // Valor da data de nascimento
    let dataNasc = campoData.value;

    // Valores de senha e confirmar senha
    let senha = campoSenha.value;
    let confSenha = campoConfSenha.value;

    let verificaNome = base.verificaCampoVazio(campoNome, labelNome, noNome);
    let verificaEmailVazio = base.verificaCampoVazio(campoEmail, labelEmail, noEmail, noEmailPadrao);
    let verificaEmailForaPadrao = false;
    if(verificaEmailVazio){
        verificaEmailForaPadrao = base.verificaEmailForaPadrao(campoEmail, noEmail, noEmailPadrao);
    }

    let verificaSenhaVazia = base.verificaCampoVazio(campoSenha, labelSenha, noPass, aotPass);
    let verificaSenhaForaPadrao = false;
    if(verificaSenhaVazia){
        verificaSenhaForaPadrao = base.verificaSenhaForaPadrao(campoSenha, labelSenha, aotPass);
    }
    
    let verificaDataVazia = base.verificaCampoVazio(campoData, labelData, noData);

    let verificaConfSenhaForaPadrao
    let verificaConfSenhaVazia = base.verificaCampoVazio(campoConfSenha, labelConf_Senha, noConfPass, aotConfPass);
    if(verificaConfSenhaVazia){
        verificaConfSenhaForaPadrao = base.verificaEmailForaPadrao(campoConfSenha, labelConf_Senha, aotConfPass);
    }


    // Verificando a jogabilidade
    let verificaJogabilidade = verificaJogabilidade();
    

    listaTudo = [verificaConfSenhaForaPadrao, verificaConfSenhaVazia, verificaDataVazia, verificaEmailForaPadrao, verificaEmailVazio, verificaJogabilidade, verificaNome, verificaSenhaForaPadrao, verificaSenhaVazia]
    if(every(listaTudo)){
        base.campoCorreto(campoNome, labelNome, noNome)
    }

}    

function verificaJogabilidade(){
    let marcado = jogabilidadeMarcada();

    if (!marcado){
        labelJogador.classList.add("erroVazio");
        labelsJogabilidade.forEach(labelJogabilidade => {labelJogabilidade.classList.add("errroVazio")});
        noJogabilidade.style.display = "block";
        return false;
    }
    noJogabilidade.style.display = "none";
    labelJogador.classList.add("certo")
    labelsJogabilidade.forEach(labelJogabilidade => {labelJogabilidade.classList.add("certo")});
    return true;
}

function jogabilidadeMarcada(){
    const radios = document.querySelectorAll(".radio");
    let marcado = true;
    
    radios.forEach(radio => {
        if (radio.children[0].checked){
            marcado = radio.children[0].id;
        }
    })
    return marcado;
}

function salvar(email, stringJSON){
    localStorage.setItem(email, stringJSON);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------FUNÇÕES PARA MUDAR TAMNHO DAS LABELS ESTETICAMENTE-------------------------------
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
const inputNome = document.querySelector("#nome");
if(inputNome){
    inputNome.addEventListener("blur", () => {
        if (inputNome.value != ""){
            labelNome.classList.remove("semTexto");
            labelNome.classList.add("focado");
        } else {
            labelNome.classList.remove("focado");
            labelNome.classList.add("semTexto");
        }
    })
}



const inputEmail = document.querySelector("#email");
inputEmail.addEventListener("blur", () => {
    if (inputEmail.value != ""){
        labelEmail.classList.remove("semTexto");
        labelEmail.classList.add("focado");
    } else {
        labelEmail.classList.remove("focado");
        labelEmail.classList.add("semTexto");
    }
})




const inputSenha = document.querySelector("#senha");
if(inputSenha){
    inputSenha.addEventListener("blur", () => {
        if (inputSenha.value != ""){
            labelSenha.classList.remove("semTexto");
            labelSenha.classList.add("focado");
        } else {
            labelSenha.classList.remove("focado");
            labelSenha.classList.add("semTexto");
        }
    })
}



const inputConf_Senha = document.querySelector("#confirmasenha");
if(inputConf_Senha){
    inputConf_Senha.addEventListener("blur", () => {
        if (inputConf_Senha.value != ""){
            labelConf_Senha.classList.remove("semTexto");
            labelConf_Senha.classList.add("focado");
        } else {
            labelConf_Senha.classList.remove("focado");
            labelConf_Senha.classList.add("semTexto");
        }
    })
}


let voltar = document.querySelector(".cssbuttons-io-button");
if(voltar){
    // Adicionando o ouvidor do evento para se inscrever
    voltar.addEventListener("click", () => {
        window.location.assign('index.html');
    })
}