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


function jogabilidadeMarcada(){
    const radios = document.querySelectorAll(".radio");
    let marcado = false;
    
    radios.forEach(radio => {
        if (radio.children[0].checked){
            marcado = radio.children[0].id;
        }
    })
    return marcado;
}


function emailIgual(email){
    if(JSON.parse(localStorage.getItem(email))){
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: 'O Email já foi cadastrado!'
        });
        return false;
    }
    return true;
}



function autenticar(){
    if(verificaTudo()){
        // Valor do nome
        let nome = campoNome.value;

        // Valor da tipo do jogador
        let jogabilidade = jogabilidadeMarcada();

        // Valor do email
        let email = campoEmail.value;

        // Valor da data de nascimento
        let dataNasc = campoData.value;

        // Valores de senha e confirmar senha
        let senha = campoSenha.value;
        let confSenha = campoConfSenha.value;

        if(senhaIgual(senha, confSenha) && emailIgual(email)){
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

function senhaIgual(senha, confsenha){
    if(senha == confsenha){
        passConfPass.style.display = "none";
        return true;
    }
    passConfPass.style.display = "block";
    return false;
}


function verificaJogabilidade(){
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

function verificaTudo(){
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

    let verificaConfSenhaForaPadrao = false;
    let verificaConfSenhaVazia = base.verificaCampoVazio(campoConfSenha, labelConf_Senha, noConfPass, aotConfPass);
    if(verificaConfSenhaVazia){
        verificaConfSenhaForaPadrao = base.verificaSenhaForaPadrao(campoConfSenha, labelConf_Senha, aotConfPass);
    }


    // Verificando a jogabilidade
    let verJog = verificaJogabilidade();
    

    let listaTudo = [verificaConfSenhaForaPadrao, verificaConfSenhaVazia, verificaDataVazia, verificaEmailForaPadrao, verificaEmailVazio, verJog, verificaNome, verificaSenhaForaPadrao, verificaSenhaVazia]
    return listaTudo.every(element => element);
}


function salvar(email, stringJSON){
    localStorage.setItem(email, JSON.stringify(stringJSON));
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------FUNÇÕES PARA MUDAR TAMNHO DAS LABELS ESTETICAMENTE-------------------------------
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// const inputNome = document.querySelector("#nome");
// if(inputNome){
//     inputNome.addEventListener("blur", () => {
//         if (inputNome.value != ""){
//             labelNome.classList.remove("semTexto");
//             labelNome.classList.add("focado");
//         } else {
//             labelNome.classList.remove("focado");
//             labelNome.classList.add("semTexto");
//         }
//     })
// }



// const inputEmail = document.querySelector("#email");
// inputEmail.addEventListener("blur", () => {
//     if (inputEmail.value != ""){
//         labelEmail.classList.remove("semTexto");
//         labelEmail.classList.add("focado");
//     } else {
//         labelEmail.classList.remove("focado");
//         labelEmail.classList.add("semTexto");
//     }
// })




// const inputSenha = document.querySelector("#senha");
// if(inputSenha){
//     inputSenha.addEventListener("blur", () => {
//         if (inputSenha.value != ""){
//             labelSenha.classList.remove("semTexto");
//             labelSenha.classList.add("focado");
//         } else {
//             labelSenha.classList.remove("focado");
//             labelSenha.classList.add("semTexto");
//         }
//     })
// }



// const inputConf_Senha = document.querySelector("#confirmasenha");
// if(inputConf_Senha){
//     inputConf_Senha.addEventListener("blur", () => {
//         if (inputConf_Senha.value != ""){
//             labelConf_Senha.classList.remove("semTexto");
//             labelConf_Senha.classList.add("focado");
//         } else {
//             labelConf_Senha.classList.remove("focado");
//             labelConf_Senha.classList.add("semTexto");
//         }
//     })
// }


let voltar = document.querySelector(".cssbuttons-io-button");
if(voltar){
    // Adicionando o ouvidor do evento para se inscrever
    voltar.addEventListener("click", () => {
        window.history.back();
    })
}