//pego todas as perguntas e crio um ouvidor de cliques
const perguntas = document.querySelectorAll('.pergunta');
perguntas.forEach(pergunta => {
  pergunta.addEventListener('click', () => {

    //atribuo como resposta o proximo elemento irmão da div pergunta
    const resposta = pergunta.nextElementSibling; 

    //caso a resposta seja visível ela desaparecerá de forma suave
    if (resposta.style.display == 'block') {
      $(resposta).slideUp('slow');

    //caso a resposta seja invisivel mostro a resposta de forma suave
    } else {
      $(resposta).slideDown('slow');
    }
  });
});

//caso o usuario clique em cima da resposta, ela desaparecerá

//seleciono todas respostas
const respostas = document.querySelectorAll('.conteudo');

respostas.forEach(rep => {

  //adiciono um ouvidor de cliques
  rep.addEventListener('click', () => {

      //ao clicar na resposta ela desaparece de forma suave
      $(rep).slideUp('slow');
    
  })
});