// Importando a funcao de autenticacao de campos
import * as base from "./script_base.js";

document.querySelector("#alterarSenha").addEventListener("click", () => {
    // Levando para a tela de alteracao de senha
    window.location.assign("alterarSenha.html");
})


// Pegando os dados do usuario logado
var emailLogado = sessionStorage.getItem("logado");
const dadosUsuario = JSON.parse(localStorage.getItem(emailLogado));  

// Pegando os campos na tela
const campoNome = document.querySelector("#floatingInputGroup1");
const campoEmail = document.querySelector("#floatingInputGroup2");
const campoDataNasc = document.querySelector("#idade");
const radios = document.querySelectorAll(".radio");


// Pegando os labels de nome e email
const labelNome = document.querySelector("#label_nome");
const labelEmail = document.querySelector("#label_email");
const labelData = document.querySelector("#labelData");
const labelJogador = document.querySelector(".label_joga");
const labelsJogabilidade = document.querySelectorAll(".jogabilidades");


// Pegando as labels de erro
const noNome = document.querySelector("#noNome");
const noEmail = document.querySelector("#noEmail")
const noEmailPadrao = document.querySelector("#noEmailPadrao");
const noData = document.querySelector("#noData");
const noJogabilidade = document.querySelector("#noJogabilidade");
const passouData = document.querySelector("#passouData");
const noEmailExiste = document.querySelector("#noEmailExiste");

// Funcao para preencher automaticamente os campos com os dados do usuario
function preencherAuto(){
    campoNome.value = dadosUsuario.nome;
    campoEmail.value = emailLogado;
    campoDataNasc.value = dadosUsuario.dataNasc;

    let radioMarcada = dadosUsuario.jogabilidade;

    // Mudando a classe dos labels para fins estéticos
    labelNome.classList.add("focado");

    labelEmail.classList.add("focado");

    // Selecionando qual e o nivel do jogador
    radios.forEach(radio => {
        if(radio.children[0].id == radioMarcada){
            radio.children[0].checked = true;
        }
    })
}

// chamando a funcao
preencherAuto();


function verificaTudo(){
    // Verificando se o campo de nome e vazio
    let verificaNome = base.verificaCampoVazio(campoNome, labelNome, noNome);
    
    // Verificando se o campo de email e vazio
    let verificaEmail = base.verificaCampoVazio(campoEmail, labelEmail, noEmail, noEmailPadrao, noEmailExiste);
    if(verificaEmail){
        // Verificando se o campo de email esta fora dos padroes
        verificaEmail = base.verificaEmailForaPadrao(campoEmail, noEmail, noEmailPadrao, noEmailExiste)
    }
    
    if(verificaEmail){
        // Verificando se o email ja foi cadastrado antes
        verificaEmail = base.emailIgual(campoEmail, noEmailExiste);
    }
    // Verificando se o campo de data e vazio
    let verDataNasc = base.verificaCampoVazio(campoDataNasc, labelData, noData, passouData); 
    if(verDataNasc){
        // Verificando se a data informada for valida (< do que o dia atual)
        verDataNasc = base.dataErrada(campoDataNasc, labelData, passouData)
    }

    // Verificando se uma jogabilidade foi marcada
    let verjog = base.verificaJogabilidade(labelJogador, labelsJogabilidade, noJogabilidade);

    let lista = [verificaNome, verificaEmail, verDataNasc, verjog];
    // Verificando se todos os elementos sao true
    return lista.every(element => element);
}

// Pegando o botao de editar
const btnEditar = document.querySelector("#alterar");

btnEditar.addEventListener("click", autenticar);

document.querySelectorAll("input").forEach(input => {
    input.addEventListener("keypress", (event) => {
        if(event.key == "Enter"){
            // Chamando a funcao quando o usuario apertar enter em qualquer campo
            autenticar();
        }
    })
});

function autenticar(){
    // Verificando se todos os campos estao preenchidos corretamente
    if(verificaTudo()){
        Swal.fire({
            // Perguntando para o usuario se ele deseja editar suas informacoes
            icon: 'question',
            text: 'Deseja editar suas informações?',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Sim',
            cancelButtonColor: '#d33',
            showCancelButton: true,
            cancelButtonText: 'Não'
        }).then((result) =>{
            if(result.isConfirmed){
                // Alterando os dados no localStorage
                dadosUsuario.nome = campoNome.value;
                dadosUsuario.dataNasc = campoDataNasc.value;
                dadosUsuario.jogabilidade = base.jogabilidadeMarcada();
                dadosUsuario.email = campoEmail.value;
                // Colocando tudo no dicionario/mapa de dadosUsuario

                let stringJson = JSON.stringify(dadosUsuario);

                localStorage.removeItem(emailLogado);
                // Removendo o item antigo
                emailLogado = campoEmail.value;

                sessionStorage.setItem("logado", emailLogado);
                // Setando o novo item no sessionStorage

                localStorage.setItem(campoEmail.value, stringJson);
                // Setando o novo item no localStorage
                Swal.fire({
                    icon: 'success',
                    title: 'Perfil atualizado'
                }).then(() => {
                    // Enviando para a pagina de perfil
                    window.location.assign("perfil.html")
                })
            }
        })
    }
}

let voltar = document.querySelector(".cssbuttons-io-button");
if(voltar){
    // Adicionando o ouvidor do evento para se inscrever
    voltar.addEventListener("click", () => {
    window.location.assign("perfil.html")
})
}
