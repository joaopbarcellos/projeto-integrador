let usuarioLogado = sessionStorage.getItem("logado");
// Armazenando a informacao de qual usuario esta logado

// Verficando se um usuario esta logado
if (!usuarioLogado) {

    Swal.fire({
        // Alert informando que o usuario nao esta logado
        title: 'ERRO!',
        icon: 'error',
        text: "Você não está logado(a)!",
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Login',
    }).then(() => {
        // Enviando para a pagina de login
        window.location.assign("index.html");
    })
} else {
    // Armazenando as informacoes do usuario logado
    let dados = JSON.parse(localStorage.getItem(usuarioLogado));

    // Pegando o nome do usuario logado e colocando no label
    document.querySelector("#nome_usuario").textContent = dados["nome"];

    // Pegando o email do usuario logado e colocando no label
    document.querySelector("#email_usuario").textContent = dados["email"];

    // Pegando a data de nascimento do usuario logado e colocando no label
    let data = dados["dataNasc"].substring(8, 10) + "/" + dados["dataNasc"].substring(5, 7) + "/" + dados["dataNasc"].substring(0, 4)
    document.querySelector("#dataNasc_usuario").textContent = data
}

document.querySelector("#editar").addEventListener("click", () => {
    // Enviando o usuario para a tela de editar perfil
    window.location.assign('editar_perfil.html')
})


document.querySelector("#excluir").addEventListener("click", excluirPerfil);

// Funcao para excluir perfil
function excluirPerfil() {
    // Perguntando para o usuario se ele deseja apagar seu perfil
    Swal.fire({
        title: "Você tem certeza?",
        icon: "warning",
        text: "Você não consiguirá reverter isto!",
        confirmButtonText: 'Sim',
        confirmButtonColor: '#3085d6',
        showCancelButton: true,
        cancelButtonText: 'Não',
        cancelButtonColor: '#f27474',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Se ele confirmou
            let email = sessionStorage.getItem("logado");
            // Apagando o item do localStorage e do sessionStorage
            localStorage.removeItem(email);
            sessionStorage.removeItem("logado");
            // Informando ao usuario que sua conta foi deletada
            Swal.fire(
                'Deletada!',
                'Sua conta foi deletada.',
                'success'
            ).then(() => {
                // Enviando para a tela de login
                window.location.assign("index.html");
            })

        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // Informando ao usuario que sua conta nao foi deletada
            Swal.fire(
                'Cancelada!',
                'Sua conta não foi deletada.',
                'error'
            )
        }
    })
}