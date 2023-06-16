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
campoConfSenha.addEventListener("keypress", (event) => {
    if(event.key == "Enter"){
        autenticar();
    }
})

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

        if(base.senhaIgual(senhaAntiga, dados.senha) && base.senhaIgual(senhaNova, confSenha)){
            dados.senha = senhaNova;
            // Trocando a senha no localStorage
            let string = JSON.stringify(dados)
            localStorage.removeItem(dados.email);
            localStorage.setItem(dados.email, string)
            // Mudando de tela para a tela de perfil
            window.location.assign("perfil.html")
        }
    }
}

function verificaSenhaSalva(campoSenha, outroCampo=false, label, label2=false, erro){
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

function verificaTudo(){

    // Verificando se o campo de senha antiga e vazio
    let verificaSenhaAntiga = base.verificaCampoVazio(campoSenhaAntiga, labelSenhaAntiga, noPassNew, aotPassNew, passPassNew);
    if(verificaSenhaAntiga){
        // Verificando se o campo de senha antiga esta fora dos padroes
        verificaSenhaAntiga = base.verificaSenhaForaPadrao(campoSenhaAntiga, labelSenhaAntiga, aotPassNew, passPassNew);
    }
    if(verificaSenhaAntiga){
        verificaSenhaAntiga = verificaSenhaSalva(campoSenhaAntiga, false, labelSenhaAntiga, false, passPassNew);
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
        verificaConfSenha = verificaSenhaSalva(campoSenha, campoConfSenha, labelConfSenha, labelSenha, passConfPass);
    }
    // let senhaIgual = base.senhaIgual(JSON.parse(localStorage.getItem(sessionStorage.getItem("logado"))).senha, campoSenhaAntiga.value)
    // tira(senhaIgual, noPassNew, aotPassNew, passPassNew, campoSenhaAntiga);
    // let confSenhaIgual = base.senhaIgual(campoSenha, campoConfSenha, campoSenha.value, campoConfSenha.value, passConfPass)

    let lista = [verificaConfSenha, verificaSenhaAntiga, verificaSenhaNova]
    // Verificando se todos os elementos sao validos
    return lista.every(element => element);
}
