let usuarioLogado = document.querySelector("#nome_usuario").innerText;
// Armazenando a informacao de qual usuario esta logado

// Verficando se um usuario esta logado
if (!usuarioLogado) {
  Swal.fire({
    // Alert informando que o usuario nao esta logado
    title: "ERRO!",
    icon: "error",
    text: "Você não está logado(a)!",
    confirmButtonColor: "#3085d6",
    confirmButtonText: "Login",
  }).then(() => {
    // Enviando para a pagina de login
    window.location.assign("login.php");
  });
}

document.querySelector("#editar").addEventListener("click", () => {
  // Enviando o usuario para a tela de editar perfil
  window.location.assign("editar_perfil.php");
});

document.querySelector("#excluir").addEventListener("click", excluirPerfil);

// Funcao para excluir perfil
function excluirPerfil() {
  // Perguntando para o usuario se ele deseja apagar seu perfil
  Swal.fire({
    title: "Você tem certeza?",
    icon: "warning",
    text: "Você não conseguirá reverter isto!",
    confirmButtonText: "Sim",
    confirmButtonColor: "#3085d6",
    showCancelButton: true,
    cancelButtonText: "Não",
    cancelButtonColor: "#f27474",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      // Se ele confirmou
      let email = usuarioLogado;
      // Apagando o item do localStorage e do sessionStorage
      localStorage.removeItem(email);
      // Informando ao usuario que sua conta foi deletada
      Swal.fire("Deletada!", "Sua conta foi deletada.", "success").then(() => {
        // Enviando para a tela de login
        window.location.assign("sairConta.php");
      });
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      // Informando ao usuario que sua conta nao foi deletada
      Swal.fire("Cancelada!", "Sua conta não foi deletada.", "error");
    }
  });
}
