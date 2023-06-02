// Capturando o campo de email
const campoEmail = document.querySelector("#email_usuario");

// Capturando as labels de erro
const noEmail = document.querySelector("#noEmail");
const noEmailPadrao = document.querySelector("#noEmailPadrao");

// Capturando o botão de enviar
const btn = document.querySelector("#btnEnviar")

// Adicionando um ouvidor de cliques no botão
btn.addEventListener("click", () => {
    let email = campoEmail.value
    
    // Verificando se o email está de acordo com os padrões
    if(email == ""){
        // Mudando a cor da borda
        campoEmail.style.cssText = 'border: 2px solid #f58181';
        // Mostrando e escondendo as mensagens de erro
        noEmail.style.display = "block";
        noEmailPadrao.style.display = "none";
    } else if(!email.includes("@") || !email.includes(".com")){
        // Mudando a cor da borda
        campoEmail.style.cssText = 'border: 2px solid #f58181';
        // Mostrando e escondendo as mensages de erro
        noEmail.style.display = "none";
        noEmailPadrao.style.display = "block";
        // Resetando o valor escrito na caixa de texto
        email = ""
    } else {
        // Mudando a cor da borda
        campoEmail.style.cssText = 'border: 2px solid #fffff';
        // Escondendo as mensagens de erro
        noEmail.style.display = "none";
        noEmailPadrao.style.display = "none";
        // Resetando o valor escrito na caixa de texto
        email = ""
        // Dando o alert e chamando a função para verificar o email escrito
        alert(verificaEmail(campoEmail.value));
    }
    
})


function verificaEmail(email){
    // Pegando as informações do localStorage onde o email deveria estar cadastrado
    const dadosSalvos = localStorage.getItem(email);
    // Transformando para objeto
    const dados = JSON.parse(dadosSalvos);

    // Verificando se o email está cadastrado
    if (dadosSalvos == null){
        return "Esse email não está cadastrado!"
    } 
    return `Sua senha é: ${dados.senha}`;
}