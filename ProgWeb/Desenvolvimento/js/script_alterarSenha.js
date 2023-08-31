// Importando a funcao de autenticacao de campos
import * as base from "./script_base.js";

// Pegando os campos de senha
let campoSenhaAntiga = document.querySelector("#floatingInputGroup1");
let campoSenha = document.querySelector("#floatingInputGroup2");
let campoConfSenha = document.querySelector("#floatingInputGroup3");

// Pegando cada label
let labelSenhaAntiga = document.querySelector("#label_senhaAnti");
let labelSenha = document.querySelector("#label_senha");
let labelConfSenha = document.querySelector("#label_confSenha");

// Pegando as labels de erro
let noPassNew = document.querySelector("#noPassNew");
let aotPassNew = document.querySelector("#aotPassNew");
let passPassNew = document.querySelector("#passPassNew");
let noPass = document.querySelector("#noPass");
let aotPass = document.querySelector("#aotPass");
let noConfPass = document.querySelector("#noConfPass");
let aotConfPass = document.querySelector("#aotConfPass");
let passConfPass = document.querySelector("#passConfPass");

// Adicionando um ouvidor de evento no botao e no campo de texto de confirmar senha
document.querySelector("#alterar").addEventListener("click", autenticar);
document.querySelectorAll("input").forEach((input) => {
  input.addEventListener("keypress", (event) => {
    if (event.key == "Enter") {
      // Chamando a funcao quando o usuario apertar enter em qualquer campo
      autenticar();
    }
  });
});

// Funcao para autenticar as entradas do usuario
function autenticar() {
  // Chamando a funcao que verifica todos os campos
  if (verificaTudo()) {
    Swal.fire({
      // Perguntando para o usuario se ele deseja editar suas informacoes
      icon: "question",
      text: "Deseja alterar sua senha?",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "Sim",
      cancelButtonColor: "#d33",
      showCancelButton: true,
      cancelButtonText: "Não",
    }).then((result) => {
      if (result.isConfirmed) {
        // Recebendo o valor de senha
        let senhaNova = campoSenha.value;

        // Pegando os dados salvos
        let dados = JSON.parse(
          localStorage.getItem(sessionStorage.getItem("logado"))
        );

        dados.senha = senhaNova;
        // Trocando a senha no localStorage
        let string = JSON.stringify(dados);
        localStorage.removeItem(dados.email);
        localStorage.setItem(dados.email, string);

        Swal.fire({
          icon: "success",
          title: "Senha atualizada",
        }).then(() => {
          // Enviando para a pagina de perfil
          window.location.assign("perfil.php");
        });
      }
    });
  }
}

function verificaTudo() {
  // Verificando se o campo de senha antiga e vazio
  let verificaSenhaAntiga = base.verificaCampoVazio(
    campoSenhaAntiga,
    labelSenhaAntiga,
    noPassNew,
    aotPassNew,
    passPassNew
  );
  if (verificaSenhaAntiga) {
    // Verificando se o campo de senha antiga esta fora dos padroes
    verificaSenhaAntiga = base.verificaSenhaForaPadrao(
      campoSenhaAntiga,
      labelSenhaAntiga,
      aotPassNew,
      passPassNew
    );
  }
  if (verificaSenhaAntiga) {
    verificaSenhaAntiga = base.verificaSenhaSalva(
      campoSenhaAntiga,
      false,
      labelSenhaAntiga,
      false,
      passPassNew
    );
  }

  // Verificando se o campo de senha nova e vazio
  let verificaSenhaNova = base.verificaCampoVazio(
    campoSenha,
    labelSenha,
    noPass,
    aotPass
  );
  if (verificaSenhaNova) {
    // Verificando se o campo de senha nova esta fora dos padroes
    verificaSenhaNova = base.verificaSenhaForaPadrao(
      campoSenha,
      labelSenha,
      aotPass
    );
  }

  // Verificando se o campo de confirmar senha e vazio
  let verificaConfSenha = base.verificaCampoVazio(
    campoConfSenha,
    labelConfSenha,
    noConfPass,
    aotConfPass
  );
  if (verificaConfSenha) {
    // Verificando se o campo de confirmar senha esta fora dos padroes
    verificaConfSenha = base.verificaSenhaForaPadrao(
      campoConfSenha,
      labelConfSenha,
      aotConfPass,
      passConfPass
    );
  }
  if (verificaConfSenha) {
    // Verificando se a senha nova e igual ao confimar senha
    verificaConfSenha = base.verificaSenhaSalva(
      campoSenha,
      campoConfSenha,
      labelConfSenha,
      labelSenha,
      passConfPass
    );
  }

  // Verificando se a senha antiga e a nova sao validas
  if (verificaSenhaAntiga && verificaSenhaNova) {
    // Verificando se a senha antiga e nova sao iguais
    if (campoSenhaAntiga.value == campoSenha.value) {
      // Avisando o erro se estiver igual
      Swal.fire({
        title: "Erro!",
        icon: "error",
        text: "A nova senha tem que ser diferente da senha antiga!",
      });
      // Mudando a estetica dos campos
      verificaSenhaAntiga = campoIncorreto(campoSenhaAntiga, labelSenhaAntiga);
      verificaSenhaNova = campoIncorreto(campoSenha, labelSenha);
      verificaConfSenha = campoIncorreto(campoConfSenha, labelConfSenha);
    }
  }

  let lista = [verificaConfSenha, verificaSenhaAntiga, verificaSenhaNova];
  // Verificando se todos os elementos sao validos
  return lista.every((element) => element);
}

// Funcao estetica para alterar um campo de texto
function campoIncorreto(campo, label) {
  campo.style.cssText = "border-bottom: 1px solid #f58181";
  label.classList.add("erroPadrao");
  label.classList.remove("erroVazio");
  label.classList.remove("certo");
  return false;
}

const olho1 = document.querySelector("#olho");
// Mostrar/ocultar senha
olho1.addEventListener("click", function () {
  let input = document.querySelector("#floatingInputGroup1");
  if (input.type == "text") {
    input.type = "password";
    olho1.src = "./img/olho_aberto.png";
  } else if (input.type == "password") {
    input.type = "text";
    olho1.src = "./img/olho_fechado.png";
  }
});

const olho2 = document.querySelector("#olho2");
// Mostrar/ocultar senha
olho2.addEventListener("click", function () {
  let input = document.querySelector("#floatingInputGroup2");
  if (input.type == "text") {
    input.type = "password";
    olho2.src = "./img/olho_aberto.png";
  } else if (input.type == "password") {
    input.type = "text";
    olho2.src = "./img/olho_fechado.png";
  }
});

const olho3 = document.querySelector("#olho3");
// Mostrar/ocultar senha
olho3.addEventListener("click", function () {
  let input = document.querySelector("#floatingInputGroup3");
  if (input.type == "text") {
    input.type = "password";
    olho3.src = "./img/olho_aberto.png";
  } else if (input.type == "password") {
    input.type = "text";
    olho3.src = "./img/olho_fechado.png";
  }
});
