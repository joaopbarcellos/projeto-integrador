// Importando a função de autenticação de campos
import * as base from "./script_base.js";

// Pegando os campos de senha
let campoSenhaAntiga = document.querySelector("#floatingInputGroup1");
let campoSenha = document.querySelector("#floatingInputGroup2");
let campoConfSenha = document.querySelector("#floatingInputGroup3");

// Pegando cada label
let labelSenhaAntiga = document.querySelector("#label_senhaAnti");
let labelSenha = document.querySelector("#label_senha");
let labelConfSenha = document.querySelector("#label_confSenha");

// Pegando as labels de erro
let noPassNew = document.querySelector("#noPassNew");
let aotPassNew = document.querySelector("#aotPassNew");
let passPassNew = document.querySelector("#passPassNew");
let noPass = document.querySelector("#noPass");
let aotPass = document.querySelector("#aotPass");
let noConfPass = document.querySelector("#noConfPass");
let aotConfPass = document.querySelector("#aotConfPass");
let passConfPass = document.querySelector("#passConfPass")

// Adicionando um ouvidor de evento no botão
document.querySelector("#alterar").addEventListener("click", autenticar);


function autenticar(){
    if(verificaTudo()){
        
    }
}

function senhaAntiga(senha){
    let dados = JSON.parse(localStorage.getItem(sessionStorage.getItem("logado")));
    return dados.senha == senha;
}

function verificaTudo(){
    let verificaSenhaAntiga = base.verificaCampoVazio(campoSenhaAntiga, labelSenhaAntiga, noPassNew, aotPassNew);
    if(verificaSenhaAntiga){
        verificaSenhaAntiga = base.verificaSenhaForaPadrao(campoSenhaAntiga, labelSenhaAntiga, aotPassNew);
    }

    let verificaSenhaNova = base.verificaCampoVazio(campoSenha, labelSenha, noPass, aotPass);
    if(verificaSenhaNova){
        verificaSenhaNova = base.verificaSenhaForaPadrao(campoSenha, labelSenha, aotPass);
    }

    let verificaConfSenha = base.verificaCampoVazio(campoConfSenha, labelConfSenha, noConfPass, aotConfPass);
    if(verificaConfSenha){
        verificaConfSenha = base.verificaSenhaForaPadrao(campoConfSenha, labelConfSenha, aotConfPass);
    }
    
    let lista = [verificaConfSenha, verificaSenhaAntiga, verificaSenhaNova]
    return lista.every(element => element);
}


