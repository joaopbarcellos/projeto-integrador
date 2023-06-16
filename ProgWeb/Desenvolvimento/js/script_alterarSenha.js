// Importando a funcao de autenticacao de campos
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

// Adicionando um ouvidor de evento no botao e no campo de texto de confirmar senha
document.querySelector("#alterar").addEventListener("click", autenticar);
document.querySelectorAll("input").forEach(input => {
    input.addEventListener("keypress", (event) => {
        if(event.key == "Enter"){
            // Chamando a funcao quando o usuario apertar enter em qualquer campo
            autenticar();
        }
    })
});

// Funcao para autenticar as entradas do usuario 
function autenticar(){
    // Chamando a funcao que verifica todos os campos
    if(verificaTudo()){
        // Recebendo o valor de senha
        let senhaAntiga = campoSenhaAntiga.value;
        let senhaNova = campoSenha.value;
        let confSenha = campoConfSenha.value;

        // Pegando os dados salvos
        let dados = JSON.parse(localStorage.getItem(sessionStorage.getItem("logado")));

        dados.senha = senhaNova;
        // Trocando a senha no localStorage
        let string = JSON.stringify(dados)
        localStorage.removeItem(dados.email);
        localStorage.setItem(dados.email, string)
        // Mudando de tela para a tela de perfil
        window.location.assign("perfil.html")
    }
}


function verificaTudo(){

    // Verificando se o campo de senha antiga e vazio
    let verificaSenhaAntiga = base.verificaCampoVazio(campoSenhaAntiga, labelSenhaAntiga, noPassNew, aotPassNew, passPassNew);
    if(verificaSenhaAntiga){
        // Verificando se o campo de senha antiga esta fora dos padroes
        verificaSenhaAntiga = base.verificaSenhaForaPadrao(campoSenhaAntiga, labelSenhaAntiga, aotPassNew, passPassNew);
    }
    if(verificaSenhaAntiga){
        verificaSenhaAntiga = base.verificaSenhaSalva(campoSenhaAntiga, false, labelSenhaAntiga, false, passPassNew);
    }

    // Verificando se o campo de senha nova e vazio
    let verificaSenhaNova = base.verificaCampoVazio(campoSenha, labelSenha, noPass, aotPass);
    if(verificaSenhaNova){
        // Verificando se o campo de senha nova esta fora dos padroes
        verificaSenhaNova = base.verificaSenhaForaPadrao(campoSenha, labelSenha, aotPass);
    }

    // Verificando se o campo de confirmar senha e vazio
    let verificaConfSenha = base.verificaCampoVazio(campoConfSenha, labelConfSenha, noConfPass, aotConfPass);
    if(verificaConfSenha){
        // Verificando se o campo de confirmar senha esta fora dos padroes
        verificaConfSenha = base.verificaSenhaForaPadrao(campoConfSenha, labelConfSenha, aotConfPass, passConfPass);
    }
    if(verificaConfSenha){
        verificaConfSenha = base.verificaSenhaSalva(campoSenha, campoConfSenha, labelConfSenha, labelSenha, passConfPass);
    }
    let lista = [verificaConfSenha, verificaSenhaAntiga, verificaSenhaNova]
    // Verificando se todos os elementos sao validos
    return lista.every(element => element);
}
