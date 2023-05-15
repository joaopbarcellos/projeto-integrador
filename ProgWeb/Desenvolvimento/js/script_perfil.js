let usuarioLogado = sessionStorage.getItem("logado");
// Armazenando a informação de qual usuário está logado

// Verficando se um usuário está logado
if(!usuarioLogado){

    Swal.fire({
        // Alert informando que o usuário não está logado
        title: 'ERRO!',
        icon: 'error',
        text: "Você não está logado(a)!",
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Confirmar',
    }).then(() => {
        // Enviando para a página de login
        window.location.assign("index.html");
    })
} else {
    // Armazenando as informações do usuário logado
    let dados = JSON.parse(localStorage.getItem(usuarioLogado));

    // Pegando o nome do usuário logado e colocando no label
    document.querySelector("#nome_usuario").textContent = dados["nome"];

    // Pegando o email do usuário logado e colocando no label
    document.querySelector("#email_usuario").textContent = dados["email"];

    // Pegando a data de nascimento do usuário logado e colocando no label
    let data = dados["dataNasc"].substring(8, 10) + "/" + dados["dataNasc"].substring(5, 7) + "/" + dados["dataNasc"].substring(0, 4)
    document.querySelector("#dataNasc_usuario").textContent = data
}

document.querySelector("#editar").addEventListener("click", () =>{
    window.location.assign('editar_perfil.html')})