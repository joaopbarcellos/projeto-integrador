// Capturando o campo de email
const campoEmail = document.querySelector("#email_usuario_confirma");
const labelEmail = document.querySelector("#label_email_confirma");

// Capturando as labels de erro
const noEmail = document.querySelector("#noEmail");
const noEmailPadrao = document.querySelector("#noEmailPadrao"); 


// Capturando o botão de enviar
const btn = document.querySelector("#btnEnviar")

// Adicionando um ouvidor de cliques no botão
btn.addEventListener("click", () => {
    
    let dados = JSON.parse(localStorage.getItem(campoEmail.value));
    let email = campoEmail.value;

    // Mudando a cor da borda
    campoEmail.style.cssText = 'border-bottom: 1px solid #f58181';
    labelEmail.style.cssText = 'transform:TranslateY(-35); color: #f58181';
    
    // Verificando se o email está de acordo com os padrões
    if(!email){
        // Mostrando e escondendo as mensagens de erro
        noEmail.style.display = "block";
        noEmailPadrao.style.display = "none";
    } else if(!email.includes("@") || !email.includes(".com")){
        // Mostrando e escondendo as mensages de erro
        noEmail.style.display = "none";
        noEmailPadrao.style.display = "block";
    } else {
        // Mudando a cor da borda
        campoEmail.style.cssText = 'border-bottom: 1px solid rgb(95, 201, 74)';
        labelEmail.style.cssText = 'transform:TranslateY(-35); color: rgb(95, 201, 74)';
        // Escondendo as mensagens de erro
        noEmail.style.display = "none";
        noEmailPadrao.style.display = "none";
        // Dando o alert e chamando a função para verificar o email escrito

        if(!dados){
            Swal.fire({
                title: 'ERRO!',
                icon: 'error',
                text: "Email não está cadastrado!",
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Confirmar',
            })
        }else{
            Swal.fire({
                title: `Sua senha é: ${dados.senha}`,
                icon: 'info',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Confirmar',
            })
        }
    }
    
})



////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------FUNÇÕES PARA MUDAR TAMNHO DAS LABELS ESTETICAMENTE-------------------------------
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

campoEmail.addEventListener("blur", () => {
    if (campoEmail.value != ""){
        labelEmail.classList.remove("semTexto");
        labelEmail.classList.add("focado");
    } else {
        labelEmail.classList.remove("focado");
        labelEmail.classList.add("semTexto");
    }
})