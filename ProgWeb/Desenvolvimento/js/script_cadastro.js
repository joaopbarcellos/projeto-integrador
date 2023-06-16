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
    // Função para verificar se o email já foi cadastrado
    if(JSON.parse(localStorage.getItem(email))){
        // Mostrando uma mensagem de erro para o usuário
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: 'O Email já foi cadastrado!'
        });
        // Mudando a cor do campo de texto
        campoEmail.style.cssText = 'border-bottom: 1px solid #f58181'
        // Mostrando a label de email já cadastrado
        noEmailExiste.style.display = 'block'
        return false;
    }
    // Mudando a cor do campo de texto
    campoEmail.style.cssText = 'border-bottom: 1px solid rgb(95, 201, 74)'
    // Retirando a label de email já cadastradp
    noEmailExiste.style.display = 'none'
    return true;
}


function autenticar(){
    // Função para autenticar todos os campos

    // Verificando se todos os campos são válidos
    if(verificaTudo()){
        // Valor da data de nascimento
        let dataNasc = campoData.value; 
        // Verificando se a data informada for válida (< do que o dia atual)
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
        

        // Valores de senha 
        let senha = campoSenha.value;

        // Verificando se o email já foi cadastrado
        if(emailIgual(email)){
            let stringJSON = {
                "email": email,
                "nome": nome,
                "dataNasc": dataNasc,
                "senha": senha,
                "jogabilidade": jogabilidade,
                "eventos_inscritos": []
            }
            // Salvando os dados no localStorage
            salvar(email, stringJSON)
            window.location.assign("index.html");
        }
    }
}

function verificaTudo(){
    // Verificando se o campo de nome é vazio
    let verificaNome = base.verificaCampoVazio(campoNome, labelNome, noNome);

    // Verificando se o campo de email é vazio
    let verificaEmail = base.verificaCampoVazio(campoEmail, labelEmail, noEmail, noEmailPadrao, noEmailExiste);
    if(verificaEmail){
        // Verificando se o campo de email está fora dos padrões
        verificaEmail = base.verificaEmailForaPadrao(campoEmail, noEmail, noEmailPadrao, noEmailExiste);
    } 

    // Verificando se o campo de senha é vazio
    let verificaSenha = base.verificaCampoVazio(campoSenha, labelSenha, noPass, aotPass);
    if(verificaSenha){
        // Verificando se o campo de senha está fora dos padrões
        verificaSenha = base.verificaSenhaForaPadrao(campoSenha, labelSenha, aotPass);
    }
    
    // Verificando se o campo de data é vazio
    let verificaDataVazia = base.verificaCampoVazio(campoData, labelData, noData); 

    // Verificando se o campo de confirmar senha é vazio
    let verificaConfSenha = base.verificaCampoVazio(campoConfSenha, labelConf_Senha, noConfPass, aotConfPass);
    if(verificaConfSenha){
        // Verificando se o campo de confirmar senha está fora dos padrões
        verificaConfSenha = base.verificaSenhaForaPadrao(campoConfSenha, labelConf_Senha, aotConfPass);
    }


    // Verificando a jogabilidade
    let verJog = base.verificaJogabilidade(labelJogador, labelsJogabilidade, noJogabilidade);
    
    // Verificando se a senha é igual ao confirmar senha
    let senhaIgual = base.senhaIgual(campoSenha.value, campoConfSenha.value);

    let listaTudo = [verificaConfSenha, verificaDataVazia, verificaEmail, verJog, verificaNome, verificaSenha, senhaIgual]
    // Verificando se todos os elementos são válidos
    return listaTudo.every(element => element);
}

function salvar(email, stringJSON){
    // Salvando no localStorage a stringJson com a chave de email
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
