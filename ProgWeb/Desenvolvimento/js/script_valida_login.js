// Importando a função de autenticação de campos
import * as base from "./script_base.js";

// Capturando o botão da tela e adicionando um ouvidor de clique
document.querySelector("#btnEnviar").addEventListener("click", autenticar);

// Capturando os campos de texto
const campoEmail = document.querySelector("#floatingInputGroup1");
const campoSenha = document.querySelector("#floatingInputGroup2");

document.querySelectorAll("input").forEach(input => {
    input.addEventListener("keypress", (event) => {
        if(event.key == "Enter"){
            autenticar();
        }
    })
})


// Capturando as labels com mensagem de erro
const noEmail = document.querySelector("#noEmail");
const noEmailCadastrado = document.querySelector("#noEmailCadastrado")
const noPass = document.querySelector("#noPass");
const aotPass = document.querySelector("#aotPass");

// Capturando a label de email e senha
const labelEmail = document.querySelector("#label_email");  
const labelSenha = document.querySelector("#label_senha");

function autenticar(){

    // Verificando se o email está vazio
    let verificaEmail = base.verificaCampoVazio(campoEmail, labelEmail, noEmail, noEmailCadastrado);

    if(verificaEmail){
        // Verifica o padrão do email
        verificaEmail = base.verificaEmailForaPadrao(campoEmail, noEmail, noEmail, noEmailCadastrado);
    }
    
    // Verifica se o campo de senha está vazio
    let verificaSenhaVazia = base.verificaCampoVazio(campoSenha, labelSenha, noPass, aotPass);

    // Verificando se estão todos os campos certos
    if(verificaEmail && verificaSenhaVazia){    
        // Arrumando a estética com a função
        //base.campoCorreto(campoEmail, labelEmail, noEmail, noEmailCadastrado);
        //base.campoCorreto(campoSenha, labelSenha, noPass, aotPass);
        
        // Se o usuário tiver a conta criada
        if(verificaLogin(campoEmail.value.toLowerCase(), campoSenha.value) == "certo"){
            // Passa a tela para home com a conta logada
            passaTela(campoEmail.value.toLowerCase());
        
        } else {
            Swal.fire({
                // Alert informando para o usuário que algo está errado
                title: 'ERRO!',
                icon: 'error',
                text: verificaLogin(campoEmail.value.toLowerCase(), campoSenha.value),
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Confirmar',
            })
        }
    }
}

// Função para verificar se o login está salvo no localStorage
export function verificaLogin(email, senha){
    // Pegando as informações do localStorage onde o email deveria estar cadastrado
    const dadosSalvos = localStorage.getItem(email);
    // Transformando para objeto
    const dados = JSON.parse(dadosSalvos);
    // Verificando se o email está cadastrado
    if (!dadosSalvos){
        noEmailCadastrado.style.display = "block"
        campoEmail.style.cssText = "border-bottom: 1px solid #f58181";
        return "Esse email não está cadastrado!";
    } else {
        // Vericando se a senha é a mesma
        if (dados.senha == senha){
            return "certo"
        } else {
            aotPass.style.display = "block";
            campoSenha.style.cssText = "border-bottom: 1px solid #f58181";
            return "A senha está errada!";
        }
    }
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


const olho = document.querySelector('#olho');
// Mostrar/ocultar senha
olho.addEventListener('click', function() {
    let input = document.querySelector('#floatingInputGroup2');
    if(input.type == 'text'){
        input.type = 'password';
        olho.src = './img/olho_aberto.png';
        
    } else if (input.type == 'password'){
        input.type = 'text';
        olho.src = './img/olho_fechado.png';
    }
});