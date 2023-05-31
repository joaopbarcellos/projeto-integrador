// Importando a função de autenticação de campos
import * as base from "./script_base.js";

// Ouvidor de cliques no botão de cadastro
document.querySelector("#cadastro").addEventListener("click", autenticar());

// Função de autenticar o cadastro
function autenticar(){
    // Verificação cadastro se algum campo não tiver preenchido
    let autenticaRadio = true;
    let autenticaConfSenha = true;
    let autenticaSenha  = true;
    let autenticaData  = true;
    let autenticaEmail  = true; 
    let autenticaNome = true;

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
    const labelData = document.querySelector("#labelData");
    const campoData = document.querySelector("#idade");

    // Campos de senha e confirmar senha
    const campoSenha = document.querySelector("#floatingInputGroup3");
    const campoConfSenha = document.querySelector("#floatingInputGroup4");

    // Valor do nome
    let nome = campoNome.value;
    
    // Valor do email
    let email = campoEmail.value;

    // Valor da data de nascimento
    let dataNasc = campoData.value;

    // Valores de senha e confirmar senha
    let senha = campoSenha.value;
    let confSenha = campoConfSenha.value;

    // Valores e informações de jogabilidade
    let marcado = true;
    
    const labelJogador = document.querySelector(".label_joga")
    const labelsJogabilidade = document.querySelectorAll(".jogabilidades");
    const radios = document.querySelectorAll(".radio");
    
    radios.forEach(radio => {
        if (radio.children[0].checked){
            marcado = radio.children[0].id;
        }
    })

    // Autenticando o nome
    if (campoNome.value == ""){
        // Mudando as cores e visualização das caixas de texto
        campoNome.style.cssText = 'border-bottom: 1px solid #f58181';
        document.getElementById('label_nome').style.cssText = 'font-size: 20px; color: #f58181;';
        noNome.style.display = "block";
        // Variável de verificação
        autenticaNome = false;
    } else {
        // Mudando as cores e visualização das caixas de texto
        campoNome.style.cssText = 'border-bottom: 1px solid rgb(95, 201, 74)';
        document.getElementById('label_nome').style.cssText = 'transform: translateY(-35px); font-size: 15px; color: rgb(95, 201, 74);';
        noNome.style.display = "none";
        // Variável de verificação
        autenticaNome = true;
    }

    // Autenticando o email
    if (campoEmail.value == ""){
        // Mudando as cores e visualização das caixas de texto
        campoEmail.style.cssText = 'border-bottom: 1px solid #f58181;';
        document.getElementById('email_label').style.cssText = 'font-size: 20px; color: #f58181';
        noEmail.style.display = "block";
        noEmailPadrao.style.display = "none";
        // Variável de verificação
        autenticaEmail = false;

    } else if (!campoEmail.value.includes("@") || !campoEmail.value.includes(".com")){
        campoEmail.style.cssText = 'border-bottom: 1px solid #f58181';
        document.getElementById('email_label').style.cssText = 'transform: translateY(-35px);font-size: 15px; color: #f58181;';
        noEmail.style.display = "none";
        noEmailPadrao.style.display = "block";
        // Variável de verificação
        autenticaEmail = false;
    } else {
        // Mudando as cores e visualização das caixas de texto
        campoEmail.style.cssText = 'border-bottom: 1px solid rgb(95, 201, 74)';
        document.getElementById('email_label').style.cssText = 'transform: translateY(-35px);font-size: 15px; color: rgb(95, 201, 74)';
        noEmail.style.display = "none";
        noEmailPadrao.style.display = "none";
        // Variável de verificação
        autenticaEmail = true;
    }

    // Autenticando a data
    if (dataNasc == ""){
        // Mudando as cores e visualização das caixas de texto
        labelData.style.cssText = 'color: #f58181';
        campoData.style.cssText = 'color: #f58181; border-bottom: 1px solid #f58181';
        noData.style.display = "block";
        // Variável de verificação
        autenticaData = false;
    } else {
        // Mudando as cores e visualização das caixas de texto
        labelData.style.cssText = 'color: rgb(95, 201, 74)';
        campoData.style.cssText = 'color: rgb(95, 201, 74); border-bottom: 1px solid rgb(95, 201, 74)';
        noData.style.display = "none";
        // Variável de verificação
        autenticaData = true;
    }

    // Autenticando a senha
    if (senha == "") {
        // Mudando as cores e visualização das caixas de texto
        campoSenha.style.cssText = 'border-bottom: 1px solid #f58181';
        document.getElementById('senha_label').style.cssText = 'font-size: 20px; color: #f58181';
        document.getElementById('senha_label').style.cssText = 'font-size: 20px; color: #f58181';
        noPass.style.display = "block";
        aotPass.style.display = "none";
        // Variável de verificação
        autenticaSenha = false;
    } else if (senha.length < 6 || senha.length > 30) {
        // Mudando as cores e visualização das caixas de texto
        campoSenha.style.cssText = 'border-bottom: 1px solid #f58181';
        document.getElementById('senha_label').style.cssText = 'transform: translateY(-35px);font-size: 15px; color: #f58181';
        aotPass.style.display = "block";
        noPass.style.display = "none";
        // Variável de verificação
        autenticaSenha = false;
    } else {
        // Mudando as cores e visualização das caixas de texto
        campoSenha.style.cssText = 'border-bottom: 1px solid rgb(95, 201, 74)';
        document.getElementById('senha_label').style.cssText = 'transform: translateY(-35px);font-size: 15px; color: rgb(95, 201, 74)';
        noPass.style.display = "none";
        aotPass.style.display = "none";
        // Variável de verificação
        autenticaSenha = true;
    } 

    // Autenticando a confirmação da senha
    if (confSenha == "") {
        // Mudando as cores e visualização das caixas de texto
        campoConfSenha.style.cssText = 'border-bottom: 1px solid #f58181';
        document.getElementById('senha_label_confirma').style.cssText = 'font-size: 20px; color: #f58181';
        noConfPass.style.display = "block";
        aotConfPass.style.display = "none";
        passConfPass.style.display = "none";
        // Variável de verificação
        autenticaConfSenha = false;
    } else if (confSenha.length < 6 || confSenha.length > 30) {
        // Mudando as cores e visualização das caixas de texto
        campoConfSenha.style.cssText = 'border-bottom: 1px solid #f58181'
        document.getElementById('senha_label_confirma').style.cssText = 'transform: translateY(-35px);font-size: 15px; color: #f58181';
        aotConfPass.style.display = "block";
        noConfPass.style.display = "none";
        passConfPass.style.display = "none";
        // Variável de verificação  
        autenticaConfSenha = false;
    } else {
        // Mudando as cores e visualização das caixas de texto
        campoConfSenha.style.cssText = 'border-bottom: 1px solid rgb(95, 201, 74)';
        document.getElementById('senha_label_confirma').style.cssText = 'transform: translateY(-35px);font-size: 15px; color: rgb(95, 201, 74)';
        noConfPass.style.display = "none";
        passConfPass.style.display = "none";
        aotConfPass.style.display = "none";
        // Variável de verificação
        autenticaConfSenha = true;
    }

    // Autenticando a jogabilidade
    if (marcado == true){
        labelJogador.style.cssText = "color: #f58181"
        labelsJogabilidade.forEach(labelJogabilidade => {labelJogabilidade.style.color = '#f58181'});
        noJogabilidade.style.display = "block";
        autenticaRadio = false;
    } else {
        noJogabilidade.style.display = "none";
        labelJogador.style.cssText = "color: rgb(95, 201, 74)"
        labelsJogabilidade.forEach(labelJogabilidade => {labelJogabilidade.style.color = 'rgb(95, 201, 74)'});
        autenticaRadio = true;
    }

    // Autenticação final e cadastro dos dados
    if (autenticaRadio && autenticaConfSenha && autenticaSenha && autenticaData && autenticaEmail && autenticaNome){ // Verificação se todos os campos estão preenchidos
        if (senha == confSenha){ // Autenticando se a senha e a confirmação de senha são iguais
            passConfPass.style.display = "none";
            campoConfSenha.style.cssText = 'border-bottom: 1px solid rgb(95, 201, 74); font-size: 20px';
            // Arquivo JSON pra cadastrar os dados
            
            let stringJson = JSON.stringify({
                "nome": nome,
                "email": email,
                "dataNasc": dataNasc,
                "senha": senha,
                "jogabilidade": marcado,
                "eventos_inscritos": [],
                "eventos_criados": []
            });

            // Salvando os dados no local storage
            localStorage.setItem(email, stringJson)  
            // Redirecionando pra próxima pág
            window.location.assign('index.html');
        } else { // Se o confirmar senha estiver diferente, mudar a cor da caixa
            passConfPass.style.display = "block";
            campoConfSenha.style.cssText = 'border-bottom: 1px solid #f58181';
        }
    }
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------FUNÇÕES PARA MUDAR TAMNHO DAS LABELS ESTETICAMENTE-------------------------------
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
const inputNome = document.querySelector("#nome");
const labelNome = document.querySelector("#label_nome");
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
const labelEmail = document.querySelector("#email_label");
if(inputEmail){
    inputEmail.addEventListener("blur", () => {
        if (inputEmail.value != ""){
            labelEmail.classList.remove("semTexto");
            labelEmail.classList.add("focado");
        } else {
            labelEmail.classList.remove("focado");
            labelEmail.classList.add("semTexto");
        }
    })
}



const inputSenha = document.querySelector("#senha");
const labelSenha = document.querySelector("#senha_label");
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
const labelConf_Senha = document.querySelector("#senha_label_confirma");
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