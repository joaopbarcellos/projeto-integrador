const btnEnviar = document.querySelector("#btnEnviar").addEventListener("click", autenticar);
// Pegando o botão da tela e adicionando um EventListerner de click

function autenticar(){
    // Declarando variáveis
    let verificaEmail = false;
    let verificaSenha = false;

    // Capturando os campos de texto e os labels de mensagem de erro
    const campoEmail = document.querySelector("#email_usuario");
    const campoSenha = document.querySelector("#senha_usuario");
    const noEmail = document.querySelector("#noEmail");
    const noPass = document.querySelector("#noPass");
    const aotPass = document.querySelector("#aotPass");
    const noEmailPadrao = document.querySelector("#noEmailPadrao");
    
    // Verificando se o campo de email está vazio
    if(campoEmail.value == ""){
        // Mudando a borda do campo
        campoEmail.style.cssText = 'border: 2px solid #f58181';
        // Mostrando a mensagem de erro;
        noEmail.style.display = "block";
        // Escondendo a mensagem de erro;
        noEmailPadrao.style.display = "none";
        // Variável de verificação
        verificaEmail = false;
    } if(!campoEmail.value.includes("@") || !campoEmail.value.includes(".com")){
        // Mudando a borda do campo
        campoEmail.style.cssText = 'border: 2px solid #f58181';
        // Escondendo a mensagem de erro
        noEmail.style.display = "none";
        // Mostrando a mensagem de erro;
        noEmailPadrao.style.display = "block";
        // Variável de verificação
        verificaEmail = false;
    } else {
        // Mudando a borda do campo
        campoEmail.style.cssText = 'border: 2px solid rgb(95, 201, 74)';
        // Escondendo as mensagens de erro
        noEmail.style.display = "none";
        noEmailPadrao.style.display = "none";
        // Variável de verificação
        verificaEmail = true;
    }

    if (campoSenha.value == "") {
        // Mudando a borda do campo
        campoSenha.style.cssText = 'border: 2px solid #f58181';
        // Mostrando a mensagem de erro;
        noPass.style.display = "block";
        // Escondendo a mensagem de erro;
        aotPass.style.display = "none";
         // Variável de verificação
        verificaSenha = false;
    } else if (campoSenha.value.length < 6 || campoSenha.value.length > 30) {
        // Mudando a borda do campo
        campoSenha.style.cssText = 'border: 2px solid #f58181';
        // Mostrando a mensagem de erro;
        aotPass.style.display = "block";
        // Escondendo a mensagem de erro;
        noPass.style.display = "none";
         // Variável de verificação
        verificaSenha = false;
    } else {
        // Mudando a borda do campo
        campoSenha.style.cssText = 'border: 2px solid rgb(95, 201, 74)';

        // Escondendo as mensagens de erro;
        noPass.style.display = "none";
        aotPass.style.display = "none";
         // Variável de verificação
        verificaSenha = true;
    }

    // Verificando se um dos campos estíver errado
    if(!verificaEmail || !verificaSenha){
        return;
    }

    // Verificando se o usuário está cadastrado
    if(verificaLogin(campoEmail.value, campoSenha.value) == "certo"){
        passaTela(campoEmail.value);
    } else {
        alert(verificaLogin(campoEmail.value, campoSenha.value));
    }
}

function verificaLogin(email, senha){
    // Pegando as informações do localStorage onde o email deveria estar cadastrado
    const dadosSalvos = localStorage.getItem(email);
    // Transformando para objeto
    const dados = JSON.parse(dadosSalvos);

    // Verificando se o email está cadastrado
    if (dadosSalvos == null){
        return "Esse email não está cadastrado!"
    } else {
        // Vericando se a senha é a mesma
        if (dados.senha == senha){
            return "certo"
        } else {
            return "A senha está errada!";
        }
    }
}

function passaTela(email){
    // Salvando o email na chave logado no session storage para saber qual usuário está logado
    sessionStorage.setItem("logado", email);
    // levando para a tela de home
    window.location.assign('home.html');
}

// Enviar email do footer
document.querySelector("#entrar_conv").addEventListener("click", () =>{
    window.location.assign('home.html');
})