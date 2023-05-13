// Botão de cadastro
const btn = document.querySelector("#cadastro");

btn.addEventListener("click", () =>{
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
    const campoNome = document.querySelector("#nome");

    // Campo de email
    const campoEmail = document.querySelector("#email");

    // Campos da data
    const labelData = document.querySelector("#labelData");
    const campoData = document.querySelector("#idade");

    // Campos de senha e confirmar senha
    const campoSenha = document.querySelector("#senha");
    const campoConfSenha = document.querySelector("#confirmasenha");

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
        if (radio.children[0].checked == true){
            marcado = radio.children[0].id;
        }
    })

    // Autenticando o nome
    if (campoNome.value == ""){
        // Mudando as cores e visualização das caixas de texto
        campoNome.style.cssText = 'border: 2px solid #f58181';
        noNome.style.display = "block";
        // Variável de verificação
        autenticaNome = false;
    } else {
        // Mudando as cores e visualização das caixas de texto
        campoNome.style.cssText = 'border: 2px solid rgb(95, 201, 74)';
        noNome.style.display = "none";
        // Variável de verificação
        autenticaNome = true;
    }

    // Autenticando o email
    if (campoEmail.value == ""){
        // Mudando as cores e visualização das caixas de texto
        campoEmail.style.cssText = 'border: 2px solid #f58181';
        noEmail.style.display = "block";
        noEmailPadrao.style.display = "none";
        // Variável de verificação
        autenticaEmail = false;
    } else if (!campoEmail.value.includes("@") || !campoEmail.value.includes(".com")){
        campoEmail.style.cssText = 'border: 2px solid #f58181';
        noEmail.style.display = "none";
        noEmailPadrao.style.display = "block";
    } else {
        // Mudando as cores e visualização das caixas de texto
        campoEmail.style.cssText = 'border: 2px solid rgb(95, 201, 74)';
        noEmail.style.display = "none";
        noEmailPadrao.style.display = "none";
        // Variável de verificação
        autenticaEmail = true;
    }

    // Autenticando a data
    if (dataNasc == ""){
        // Mudando as cores e visualização das caixas de texto
        labelData.style.cssText = 'color: #f58181';
        campoData.style.cssText = 'color: #f58181; border: 2px solid #f58181';
        noData.style.display = "block";
        // Variável de verificação
        autenticaData = false;
    } else {
        // Mudando as cores e visualização das caixas de texto
        labelData.style.cssText = 'color: rgb(95, 201, 74)';
        campoData.style.cssText = 'color: rgb(95, 201, 74); border: 2px solid rgb(95, 201, 74)';
        noData.style.display = "none";
        // Variável de verificação
        autenticaData = true;
    }

    // Autenticando a senha
    if (senha == "") {
        // Mudando as cores e visualização das caixas de texto
        campoSenha.style.cssText = 'border: 2px solid #f58181';
        noPass.style.display = "block";
        aotPass.style.display = "none";
        // Variável de verificação
        autenticaSenha = false;
    } else if (senha.length < 6 || senha.length > 30) {
        // Mudando as cores e visualização das caixas de texto
        campoSenha.style.cssText = 'border: 2px solid #f58181';
        aotPass.style.display = "block";
        noPass.style.display = "none";
        // Variável de verificação
        autenticaSenha = false;
    } else {
        // Mudando as cores e visualização das caixas de texto
        campoSenha.style.cssText = 'border: 2px solid rgb(95, 201, 74)';
        noPass.style.display = "none";
        aotPass.style.display = "none";
        // Variável de verificação
        autenticaSenha = true;
    } 

    // Autenticando a confirmação da senha
    if (confSenha == "") {
        // Mudando as cores e visualização das caixas de texto
        campoConfSenha.style.cssText = 'border: 2px solid #f58181';
        noConfPass.style.display = "block";
        aotConfPass.style.display = "none";
        passConfPass.style.display = "none";
        // Variável de verificação
        autenticaConfSenha = false;
    } else if (confSenha.length < 6 || confSenha.length > 30) {
        // Mudando as cores e visualização das caixas de texto
        campoConfSenha.style.cssText = 'border: 2px solid #f58181'
        aotConfPass.style.display = "block";
        noConfPass.style.display = "none";
        passConfPass.style.display = "none";
        // Variável de verificação  
        autenticaConfSenha = false;
    } else {
        // Mudando as cores e visualização das caixas de texto
        campoConfSenha.style.cssText = 'border: 2px solid rgb(95, 201, 74)';
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
            campoConfSenha.style.cssText = 'border: 2px solid rgb(95, 201, 74)';
            // Arquivo JSON pra cadastrar os dados
            
            let stringJson = JSON.stringify({
                "nome": nome,
                "email": email,
                "dataNasc": dataNasc,
                "senha": senha,
                "jogabilidade": marcado
            });

            // Salvando os dados no local storage
            localStorage.setItem(email, stringJson)  
            // Redirecionando pra próxima pág
            window.location.assign('login.html');
        } else { // Se o confirmar senha estiver diferente, mudar a cor da caixa
            passConfPass.style.display = "block";
            campoConfSenha.style.cssText = 'border: 2px solid #f58181';
        }
    }
})
