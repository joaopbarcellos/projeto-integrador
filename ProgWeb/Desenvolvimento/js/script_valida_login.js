// Importando a funcao de autenticacao de campos
import * as base from "./script_base.js";

// Capturando o botao da tela e adicionando um ouvidor de clique
document.querySelector("#btnEnviar").addEventListener("click", autenticar);

// Capturando os campos de texto
const campoEmail = document.querySelector("#floatingInputGroup1");
const campoSenha = document.querySelector("#floatingInputGroup2");

document.querySelectorAll("input").forEach(input => {
    input.addEventListener("keypress", (event) => {
        if (event.key == "Enter") {
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

function autenticar() {

    // Verificando se o email esta vazio
    let verificaEmail = base.verificaCampoVazio(campoEmail, labelEmail, noEmail, noEmailCadastrado);

    if (verificaEmail) {
        // Verifica o padrao do email
        verificaEmail = base.verificaEmailForaPadrao(campoEmail, noEmail, noEmail, noEmailCadastrado);
    }

    // Verifica se o campo de senha esta vazio
    let verificaSenhaVazia = base.verificaCampoVazio(campoSenha, labelSenha, noPass, aotPass);

    // Verificando se estao todos os campos certos
    if (verificaEmail && verificaSenhaVazia) {

        // Se o usuario tiver a conta criada
        if (verificaLogin(campoEmail.value.toLowerCase(), campoSenha.value) == "certo") {
            // Passa a tela para home com a conta logada
            passaTela(campoEmail.value.toLowerCase());

        } else {
            Swal.fire({
                // Alert informando para o usuario que algo esta errado
                title: 'ERRO!',
                icon: 'error',
                text: verificaLogin(campoEmail.value.toLowerCase(), campoSenha.value),
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Confirmar',
            })
        }
    }
}

// Funcao para verificar se o login esta salvo no localStorage
function verificaLogin(email, senha) {
    // Pegando as informacoes do localStorage onde o email deveria estar cadastrado
    const dadosSalvos = localStorage.getItem(email);
    // Transformando para objeto
    const dados = JSON.parse(dadosSalvos);
    // Verificando se o email esta cadastrado
    if (!dadosSalvos) {
        noEmailCadastrado.style.display = "block"
        campoEmail.style.cssText = "border-bottom: 1px solid #f58181";
        return "Esse email não está cadastrado!";
    } else {
        // Vericando se a senha e a mesma
        if (dados.senha == senha) {
            return "certo"
        } else {
            aotPass.style.display = "block";
            campoSenha.style.cssText = "border-bottom: 1px solid #f58181";
            return "A senha está errada!";
        }
    }
}

// Funcao para levar para tela de home e setar o usuario logado no sessionStorage
function passaTela(email) {
    // Salvando o email na chave logado no sessionStorage para saber qual usuario está logado
    sessionStorage.setItem("logado", email);
    // Levando para a tela de home
    window.location.assign('home.html');
}

// Ouvidor de cliques para entrar como convidado
document.querySelector("#entrar_conv").addEventListener("click", () => {
    window.location.assign('home.html');
})


const olho = document.querySelector('#olho');
// Mostrar/ocultar senha
olho.addEventListener('click', function () {
    let input = document.querySelector('#floatingInputGroup2');
    if (input.type == 'text') {
        input.type = 'password';
        olho.src = './img/olho_aberto.png';

    } else if (input.type == 'password') {
        input.type = 'text';
        olho.src = './img/olho_fechado.png';
    }
});

// Adicionando todas as localizacoes no sessionStorage
localStorage.setItem("ifes", '{"0":-20.197329691804068, "1": -40.2170160437478}');
localStorage.setItem("aulaZico", '{"0":-20.210745686329638, "1": -40.26339017193191}');
localStorage.setItem("treinoBlack", '{"0":-20.277042066307818, "1": -40.299547001384624}');
localStorage.setItem("desafioNatacao", '{"0":-19.98934303687819, "1": -40.149159630227594}');
localStorage.setItem("marDourado", '{"0":-20.372179535206815, "1": "-40.30335365665824}');
localStorage.setItem("corridaPenha", '{"0":-20.326947780230874, "1": -40.291622531407256}');
localStorage.setItem("etapeRio", '{"0":-22.919773340159463, "1": -43.1700841452671}');
localStorage.setItem("surfItaparica", '{"0":-20.37053693311, "1": -40.30429837370785}');
localStorage.setItem("basqueteCaue", '{"0":-20.309387282525176, "1": -40.294921876227576}');
localStorage.setItem("motocrossArena", '{"0":-20.144511854276182, "1": -40.18332926312631}');