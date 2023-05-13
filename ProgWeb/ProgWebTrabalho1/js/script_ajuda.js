import {send} from "./script_base.js";

// Verificação de primeiro clique nas perguntas
let primeiroClique = true;

// Capturando as divs de pergunta e resposta
const perguntasNode = document.querySelectorAll(".pergunta")
const conteudosNode = document.querySelectorAll(".conteudo")

// Transformando em Array para utilizar a função indexOf()
const perguntas = Array.from(perguntasNode) 
const conteudos = Array.from(conteudosNode)

// Adicionando um ouvidor de cliques para cada pergunta
perguntas.forEach(pergunta =>{
    pergunta.addEventListener("click", () =>{ // Captura o clique na div da pergunta
        let conteudoIndex = perguntas.indexOf(pergunta) + 1; // Armazena o index da resposta da pergunta clicada
        let divConteudo = document.querySelector(`#conteudo${conteudoIndex}`) // Seleciona a div da resposta da pergunta clicada
        conteudos.forEach(cont => { // For each pra passar por cada resposta
            if(cont.id != `conteudo${conteudoIndex}`){ // Confere se a resposta é diferente da resposta que deve ser mostrada 
                cont.style.display = "none"; // Se a resposta não deve ser mostrada, o display é none
            }

            // Se for o primeiro clique, precisamos presetar o display none
            if (primeiroClique){
                divConteudo.style.display = "none";
                primeiroClique = false;
            }

        })
        if (divConteudo.style.display == "none") { // Conferindo se a resposta já está aparecendo ou não
            divConteudo.style.display = "block" // Colocando a resposta na tela
            if(conteudoIndex == 1){ // Conferindo se é a primeira resposta
                pergunta.style.borderRadius = "10px 10px 1px 1px" // Mudando a borda da primeira pergunta
                document.querySelector(".seg").style.borderRadius = "1px 1px 10px 10px" // Mudando a bora da segunda pergunta
            }else{ // Se for a segunda resposta que irá aparecer:
                pergunta.style.borderRadius = "1px 1px 1px 1px" // Mudando a borda da segunda pergunta
            }
        } else { // Se a resposta já estiver aparecendo: 
            divConteudo.style.display = "none" // Tirando a resposta da tela
            if(conteudoIndex == 1){ // Conferindo se é a primeira resposta
                pergunta.style.borderRadius = "10px 10px 1px 1px" // Mudando a borda da primeira pergunta
            }else{ // Se for a segunda resposta:
                pergunta.style.borderRadius = "1px 1px 10px 10px" // Mudando a borda da segunda pergunta
            }
        }

    })
})

// Enviar email do footer
document.querySelector("#enviarEmail").addEventListener("click", () =>{
    send(document.querySelector("#email"))
});