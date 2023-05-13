export function send(tag){ // tag: campo de texto do email
    let email = tag.value // Capturando o valor escrito no campo de texto
  
    if (email.includes("@") && email.includes(".com")){ // Conferindo se o valor escrito tem @, verificação simples de email
      alert("Email enviado! Em breve você receberá novidades da Time In!") // Mensagem de sucesso
    } else {
      alert("Email inválido!") // Mensagem de erro
    }
    tag.value = "" // Definindo o valor do campo como vazio
}