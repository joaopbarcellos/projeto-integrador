// Pegando todas as perguntas e criando um ouvidor de cliques
const perguntas = document.querySelectorAll(".pergunta");

perguntas.forEach((pergunta) => {
  pergunta.addEventListener("click", () => {
    // Atribuindo como resposta o proximo elemento irmao da div pergunta
    const resposta = pergunta.nextElementSibling;

    // Caso a resposta seja visivel, ela desaparecera de forma suave
    if (resposta.style.display == "block") {
      $(resposta).slideUp("slow");

      // Caso a resposta seja invisivel, mostra a resposta de forma suave
    } else {
      $(resposta).slideDown("slow");
    }
  });
});

// Caso o usuario clique em cima da resposta, ela desaparecera

// Selecionando todas respostas
const respostas = document.querySelectorAll(".conteudo");

respostas.forEach((rep) => {
  // Adicionando um ouvidor de cliques
  rep.addEventListener("click", () => {
    // Ao clicar na resposta, ela desaparece de forma suave
    $(rep).slideUp("slow");
  });
});
