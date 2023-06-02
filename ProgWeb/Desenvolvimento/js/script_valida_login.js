// Importando a função de autenticação de campos
import * as base from "./script_base.js";

// Capturando o botão da tela e adicionando um ouvidor de clique
document.querySelector("#btnEnviar").addEventListener("click", autenticar);

// Capturando os campos de texto
const campoEmail = document.querySelector("#floatingInputGroup1");
const campoSenha = document.querySelector("#floatingInputGroup2");


// Capturando as labels com mensagem de erro
const noEmail = document.querySelector("#noEmail");
const noPass = document.querySelector("#noPass");
const aotPass = document.querySelector("#aotPass");
const noEmailPadrao = document.querySelector("#noEmailPadrao");

// Capturando a label de email e senha
const labelEmail = document.querySelector("#label_email");
const labelSenha = document.querySelector("#label_senha");

// Função para autenticar as informacoes de login e senha
function autenticar(){
    // Declarando variaveis de verificacao
    let verificaEmail = false;
    let verificaSenha = false;
    
    // Verificando se o campo de email esta vazio
    let verificaEmailVazio = base.verificaCampoVazio(campoEmail, labelEmail, noEmail, noEmailPadrao);
    verificaEmail = autenticarCampoEmail(verificaEmailVazio, campoEmail, noEmail, noEmailPadrao, labelEmail)

    // Verifica se o campo de senha está vazio
    let verificaSenhaVazia = base.verificaCampoVazio(campoSenha, labelSenha, noPass, aotPass);

    if (verificaSenhaVazia) {
        // Verifica o tamanho da senha inserida
        verificaSenha = base.verificaSenhaForaPadrao(campoSenha, labelSenha, aotPass);

        if (!verificaSenha){
            // Mudando a borda do campo
            campoSenha.style.cssText = 'border-bottom: 1px solid #f58181';
        } else {
            // Chamando função estética
            campoCorreto(campoSenha, labelSenha, noPass, aotPass);
        }
    } else {
        verificaSenha = false;
    }

    // Verificando se um dos campos estíver errado
    if(!verificaEmail || !verificaSenha){
        return;
    }

    // Verificando se o usuário está cadastrado
    if(verificaLogin(campoEmail.value, campoSenha.value) == "certo"){
        passaTela(campoEmail.value);
    } else {
        Swal.fire({
            // Alert informando para o usuário que algo está errado
            title: 'ERRO!',
            icon: 'error',
            text: verificaLogin(campoEmail.value, campoSenha.value),
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Confirmar',
        })
    }
}

// Função para verificar se o login está salvo no localStorage
function verificaLogin(email, senha){
    // Pegando as informações do localStorage onde o email deveria estar cadastrado
    const dadosSalvos = localStorage.getItem(email);
    // Transformando para objeto
    const dados = JSON.parse(dadosSalvos);

    // Verificando se o email está cadastrado
    if (!dadosSalvos){
        return "Esse email não está cadastrado!";
    } else {
        // Vericando se a senha é a mesma
        if (dados.senha == senha){
            return "certo"
        } else {
            return "A senha está errada!";
        }
    }
}

// Funcao para verificar se o campo de email está correto
function autenticarCampoEmail(verificaEmailVazio, campoEmail, noEmail, noEmailPadrao, labelEmail){
    if (verificaEmailVazio) {
            // Verificando se o campo de email esta dentro dos padroes
            verificaEmail = base.verificaEmailForaPadrao(campoEmail, noEmail, noEmailPadrao);

            if (!verificaEmail){
                // Mudando a borda do campo
                campoEmail.style.cssText = 'border-bottom: 1px solid #f58181';
                
                return false;
            } else{
                // Chamando funcao estetica
                campoCorreto(campoEmail, labelEmail, noEmail, noEmailPadrao);
                return true;
            }
        } else {
            return false;
        }
}


// Funcao para deixar o campo e label com aparencia de correto
function campoCorreto(campo, label, noTexto, noTextoPadrao){
    // Mudando a borda do campo
    campo.style.cssText = 'border-bottom: 1px solid rgb(95, 201, 74)';

    // Alterando a label
    label.classList.add("certo");    
    
    // Escondendo as mensagens de erro
    noTexto.style.display = "none";
    noTextoPadrao.style.display = "none";
}

// Funcao para levar para tela de home e setar o usuário logado no sessionStorage
function passaTela(email){
    // Salvando o email na chave logado no session storage para saber qual usuário está logado
    sessionStorage.setItem("logado", email);
    // levando para a tela de home
    window.location.assign('home.html');
}

// Ouvidor de cliques para entrar como convidado
document.querySelector("#entrar_conv").addEventListener("click", () =>{
    window.location.assign('home.html');
})

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------FUNÇÕES PARA MUDAR TAMNHO DAS LABELS ESTETICAMENTE-------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Ouvidor para quando o campo de texto de email perde o foco
campoEmail.addEventListener("blur", () => {
    if (campoEmail.value){
        // Mudando a label de email
        labelEmail.classList.remove("semTexto");
        labelEmail.classList.add("focado");
    } else {
        // Chamando a função para autenticar os campos
        autenticar();
        
        // Mudando a label de email
        labelEmail.classList.remove("focado");
        labelEmail.classList.add("semTexto");
    }
})

campoEmail.addEventListener("focus", () => {
    labelEmail.classList.remove("semTexto");
})

// Ouvidor para quando o campo de texto de senha perde o foco
campoSenha.addEventListener("blur", () => {
    if (campoSenha.value){
        // Mudando a label de senha
        labelSenha.classList.remove("semTexto");
        labelSenha.classList.add("focado");
    } else {
        // Chamando a função de autenticar os campos    
        autenticar();

        // Mudando a label de senha
        labelSenha.classList.remove("focado");
        labelSenha.classList.add("semTexto");
    }
})