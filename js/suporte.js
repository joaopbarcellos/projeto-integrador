emailjs.init("YRjJaUin8dDwinRGs");

// Importando a funcao de autenticacao de campos
import * as base from "./base.js";

// Capturando os elementos HTML
const btn = document.querySelector("#envio");
const noEmail = document.querySelector("#noEmail");
const noEmailPadrao = document.querySelector("#noEmailPadrao");
const noMsg = document.querySelector("#noMsg");
const campoEmail = document.querySelector("#floatingInputGrid");
const nomeremetente = document.querySelector("#nome_usuario");

function suporte() {
    // Verificando se o campo de email está vazio ou fora dos padrões
    let verificaEmail = base.verificaCampoVazio(
        campoEmail,
        false,
        noEmail,
        noEmailPadrao
    );
    if (verificaEmail) {
        verificaEmail = base.verificaEmailForaPadrao(
            campoEmail,
            noEmail,
            noEmailPadrao
        );
    }

    // Verificando se o campo de mensagem está vazio
    let verificaMsg = base.verificaCampoVazio(
        document.querySelector("#floatingTextarea1"),
        false,
        noMsg,
        false
    );

    // Verificando se ambos os campos estão preenchidos
    if (verificaMsg && verificaEmail) {
        // Exibindo alerta
        Swal.fire({
            title: "Aguarde...",
            icon: "info",
            text: "Enviando mensagem...",
            showConfirmButton: false,
        });

        const emailData = {
            service_id: 'service_hetcj3j',
            template_id: 'template_b2794in',
            user_id: 'YRjJaUin8dDwinRGs',
            template_params: {
                'email': campoEmail.value,
                'mensagem': document.querySelector("#floatingTextarea1").value,
                'nome': nomeremetente.innerHTML
            }
        };

        // Envia o email
        emailjs.send(emailData.service_id, emailData.template_id, emailData.template_params, emailData.user_id)
            .then((response) => {
                Swal.fire({
                    title: "Obrigado!",
                    icon: "success",
                    text: "Sua mensagem foi enviada!",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK",
                }).then(() => {
                    // Redireciona após o envio bem-sucedido
                    window.location.assign("ajuda.php");
                });
            })
            .catch((error) => {
                // Trate o erro conforme necessário
                Swal.fire({
                    title: "Erro",
                    icon: "error",
                    text: "Ocorreu um erro ao enviar a mensagem. Por favor, tente novamente.",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK",
                });
            });
    }
}

// Adicionando o evento de clique ao botão
btn.addEventListener("click", suporte);
