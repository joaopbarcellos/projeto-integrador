// Importando a funcao de autenticacao de campos
import * as base from "./base.js";

const form = document.getElementById("multistepform");
const steps = form.querySelectorAll(".step");
const nextBtns = form.querySelectorAll(".next-btn");
const prevBtns = form.querySelectorAll(".prev-btn");
let currentStep = 2;

// Pegando o email do usuario logado
const email = document.querySelector(".paragrafo").value;

if (!email) {
  base.naoEstaLogado();
}

// Validação dos campos
// Campo nome do evento
function validarNomeEvento() {
  const nomeEvento = document.querySelector("#nomeEvento");

  if (!nomeEvento.value) {
    // Adicionar a exclamação (!) antes pra funcionar
    return "nome do evento";
  }
  return true;
}

// Campo data do evento
function validarDataEvento() {
  var dataEvento = document.querySelector("#dataEvento").value;
  // Verificando se a data do evento foi escrita ou é maior que a data atual
  if (!dataEvento || !verificaseDatadoEventoeMaiordoqueaDataAtual(dataEvento)) {
    return "data";
  }
  return true;
}

function verificaseDatadoEventoeMaiordoqueaDataAtual(dataEvento) {
  var dataEvento = document.querySelector("#dataEvento").value;
  dataEvento = new Date(dataEvento);
  var dataAtual = new Date();

  // Retornando true se a data do evento for maior do que a atual
  if (dataEvento.getFullYear() > dataAtual.getFullYear()) return true;
  if (dataEvento.getFullYear() == dataAtual.getFullYear()) {
    if (dataEvento.getMonth() > dataAtual.getMonth()) return true;
    if (dataEvento.getMonth() == dataAtual.getMonth()) {
      if (dataEvento.getDate() + 1 >= dataAtual.getDate()) return true;
    }
  }
  return false;
}

function verificaseDatadoEventoeNoMesmoDia(dataEvento) {
  var dataEvento = document.querySelector("#dataEvento").value;
  dataEvento = new Date(dataEvento);
  var dataAtual = new Date();
  // Verifcando se a data do evento é no mesmo dia que o atual
  return dataEvento.getDate() + 1 == dataAtual.getDate();
}

// Campo horário início
function validarHorarioInicio() {
  var dataEvento = document.querySelector("#dataEvento").value;
  var horarioIni = document.querySelector("#horarioInicio");
  var horarioInicio = horarioIni.value;
  const horaInicio = parseInt(horarioInicio.substring(0, 2), 10);
  const minutoInicio = parseInt(horarioInicio.substring(3), 10);

  // Verificando se o horário inicial foi escrito
  if (!horarioInicio) {
    return "horário inicial";
  }
  if (verificaseDatadoEventoeNoMesmoDia(dataEvento)) {
    // Se a data do evento for a mesma que a atual
    let dataAtual = new Date();
    // Verificando se o horário inicial é maior que o atual
    if (horaInicio > dataAtual.getHours()) return true;
    if (horaInicio == dataAtual.getHours()) {
      if (minutoInicio >= dataAtual.getMinutes() + 2) return true;
    }
    return "horário inicial";
  }
  // Verificando se a data do evento é maior do que a atual
  if (verificaseDatadoEventoeMaiordoqueaDataAtual(dataEvento)) {
    return true;
  }
  return "horário inicial";
}

// Campo término estimado
function validarTerminoEstimado() {
  const horarioInicio = document.querySelector("#horarioInicio").value;
  const horaInicio = parseInt(horarioInicio.substring(0, 2), 10);
  const horarioFinal = document.querySelector("#horarioFim").value;
  const horaFinal = parseInt(horarioFinal.substring(0, 2), 10);
  const minutoFinal = parseInt(horarioFinal.substring(3), 10);
  const minutoInicio = parseInt(horarioInicio.substring(3), 10);

  // Verificando se o horário final foi escrito
  if (!horarioFinal) {
    return "término estimado";
  }

  // Verificando se o horário final é maior do que o inicial
  if (horaFinal > horaInicio) return true;
  if (horaFinal == horaInicio) {
    if (minutoFinal >= minutoInicio + 2) return true;
  }
  return "término estimado";
}

// Step 1
function verificaStep1() {
  // Verificando todos os campos do PASSO 1
  let validarNomeEvento1 = validarNomeEvento();
  let validarDataEvento1 = validarDataEvento();
  let validarHorarioInicio1 = validarHorarioInicio();
  let validarTerminoEstimado1 = validarTerminoEstimado();
  let validarDesc = verificaSeTaEscritoNoFormulario(document.querySelector("#desc").value, "descrição");

  let listaVerifica = [
    validarNomeEvento1,
    validarDataEvento1,
    validarHorarioInicio1,
    validarTerminoEstimado1,
    validarDesc
  ];
  let strErros = "";
  // Verificando se todos os campos estao validos, se nao, escritos em uma string
  listaVerifica.forEach((elemento) => {
    if (elemento !== true) {
      if (elemento == listaVerifica[listaVerifica.length - 1]) {
        strErros += `${elemento}`;
      } else {
        strErros += `${elemento}, `;
      }
    }
  });

  // Se a string nao apresentar erros
  if (!strErros.length > 0) {
    currentStep++;
    showStep(currentStep);
  } else {
    Swal.fire({
      title: "ERRO!",
      icon: "error",
      // Mostrando um alert com os campos errados
      text: `O(s) campo(s) ${strErros} está(ão) inválido(s)!`,
    });
  }
}

// Ouvidor de input do campo de cep
const campoCep = document.querySelector("#cepEvento");
campoCep.addEventListener("input", (e) => {
  formatCEP(campoCep);
});

// Lista com todos os estados
const listaEstados = [
  0,
  "AC",
  "AL",
  "AP",
  "AM",
  "BA",
  "CE",
  "DF",
  "ES",
  "GO",
  "MA",
  "MT",
  "MS",
  "MG",
  "PA",
  "PB",
  "PR",
  "PE",
  "PI",
  "RJ",
  "RN",
  "RS",
  "RO",
  "RR",
  "SC",
  "SP",
  "SE",
  "TO",
];

function consultaCep(cep){
  // URL do site da API
  var url = 'https://viacep.com.br/ws/' + cep +'/json/';
  
  // Request HMLHttp para acessar a API
  var request = new XMLHttpRequest();
  
  // Tentando acessar a API
  request.open('GET', url);

  // Caso aconteca erro, informar que a API ou CEP deram erro
  request.onerror = function (e){
    document.getElementById('return').innerHTML = 'API offline ou Cep Inválido'
  }

  // Caso carregue o request na API
  request.onload = () => {
    // Resposta da request
    var response = JSON.parse(request.responseText);

    // Se a resposta contém um erro
    if(response.erro == true){
      // Alert de erro 
      Swal.fire({
              title: "ERRO!",
              icon: "error",
              text: `O CEP está em formato inválido!`,
      });
    }else{ // Se deu certo
      // Adiciona as informacoes nos campos
      document.getElementById("logradouroEvento").value = response.logradouro;
      document.getElementById("bairroEvento").value = response.bairro;
      document.getElementById("cidadeEvento").value = response.localidade;
      for (let i = 0; i < listaEstados.length; i++) {
        if (listaEstados[i] == response.uf) {
          document.getElementById("estadoEvento").value = i;
        }
      }
    }
  }
  // Envia a request pra API
  request.send();
}


// Script validar CEP
function validarCEPnoSiteViaCep(cep) {
  //Cria um elemento javascript.
  var script = document.createElement("script");
  //Sincroniza com o callback.
  script.src = `https://viacep.com.br/ws/${cep}/json/?callback=callbackCEP`;
  //Insere script no documento e carrega o conteúdo.
  document.body.appendChild(script);
}

function formatCEP(input) {
  // Remove todos os caracteres não numéricos
  var cep = input.value.replace(/\D/g, "");

  // Limita o CEP a 8 dígitos
  cep = cep.slice(0, 8);

  // Formata o CEP com o traço apenas quando tiver mais de 5 números
  if (cep.length > 5) {
    cep = cep.slice(0, 5) + "-" + cep.slice(5);
  }
  if (cep.length == 9) {
    consultaCep(cep);
  }
  input.value = cep;
}

function verificaSeTaEscritoNoFormulario(valorCampo, mensagemErro) {
  // Verificando se o valor foi escrito ou se o valor e um numero
  if (!valorCampo | !isNaN(valorCampo)) {
    return mensagemErro;
  }
  return true;
}

function verificaComplemento(valorCampo, mensagemErro){
  // Verificando se o valor foi escrito e se o valor e um numero
  if (valorCampo && !isNaN(valorCampo)) {
    return mensagemErro;
  }
  return true;
}

// Step 2
function verificaStep2() {
  // Verificando todos os campos do PASSO 2
  let validaCidade = verificaSeTaEscritoNoFormulario(
    document.querySelector("#cidadeEvento").value,
    "cidade"
  );
  let validaLogradouro = verificaSeTaEscritoNoFormulario(
    document.querySelector("#logradouroEvento").value,
    "logradouro"
  );
  let validaBairro = verificaSeTaEscritoNoFormulario(
    document.querySelector("#bairroEvento").value,
    "bairro"
  );
  let validaComplemento = verificaComplemento(
    document.querySelector("#complementoEvento").value,
    "complemento"
  );
  let validaNumero = base.validarNumeroEndereco(
    document.querySelector("#numeroEvento").value,
    "número"
  );

  let listaVerifica = [
    validaCidade,
    validaLogradouro,
    validaBairro,
    validaComplemento,
    validaNumero,
  ];
  let strErros = "";
  // Verificando se todos os campos estao validos, se nao, escritos em uma string
  listaVerifica.forEach((elemento) => {
    if (elemento !== true) {
      if (elemento == listaVerifica[listaVerifica.length - 1]) {
        strErros += `${elemento}`;
      } else {
        strErros += `${elemento}, `;
      }
    }
  });

  // Se a string nao apresentar erros
  if (!strErros.length > 0) {
    currentStep++;
    showStep(currentStep);
  } else {
    Swal.fire({
      title: "ERRO!",
      icon: "error",
      // Mostrando um alert com todos os erros
      text: `O(s) campo(s) ${strErros} está(ão) inválido(s)!`,
    });
  }
}

function verificaStep3() {
  // Verificando todos os campos do PASSO 3
  let validaQtdMin = base.validarNumero(
    document.querySelector("#capMinima").value,
    "quantidade mínima"
  );
  let validaQtdMax = base.validarNumero(
    document.querySelector("#capMaxima").value,
    "quantidade máxima"
  );
  let validarPrecoEvento1 = base.validarNumero(
    document.querySelector("#preco").value,
    "preço"
  );

  let listaVerifica = [validaQtdMin, validaQtdMax, validarPrecoEvento1];
  let strErros = "";

  // Verificando se todos os campos estao validos, se nao, escritos em uma string
  listaVerifica.forEach((elemento) => {
    if (elemento !== true) {
      if (elemento == listaVerifica[listaVerifica.length - 1]) {
        strErros += `${elemento}`;
      }else{
        strErros += `${elemento}, `;
      }
    }
  });
  if(document.querySelector("#capMinima").value >= document.querySelector("#capMaxima").value){
    strErros = "quantidade mínima e quantidade máxima";
  }
  if (validarPrecoEvento1 != true) strErros += ", " + validarPrecoEvento1;
  if (!strErros.length > 0) {
    alert("Seu evento foi criado!")
    currentStep++;
    document.querySelector("form").submit();
  } else {
    Swal.fire({
      title: "ERRO!",
      icon: "error",
      text: `O(s) campo(s) ${strErros} está(ão) inválido(s)!`,
    });
  }
}

const showStep = (stepIndex) => {
  steps.forEach((step, index) => {
    step.style.display = index === stepIndex ? "block" : "none";
  });
};

const nextStep = () => {
  if (currentStep < steps.length - 1) {
    if (currentStep === 0) {
      verificaStep1();
    } else if (currentStep === 1) {
      verificaStep2();
    } else {
      showStep(currentStep);
    }
  }
};

const prevStep = () => {
  if (currentStep > 0) {
    currentStep--;
    showStep(currentStep);
  }
};

nextBtns.forEach((btn) => {
  btn.addEventListener("click", (e) => {
    e.preventDefault();
    nextStep();
  });
});

prevBtns.forEach((btn) => {
  btn.addEventListener("click", (e) => {
    e.preventDefault();
    prevStep();
  });
});

// Inicialização
showStep(currentStep);

document.querySelector("#btnFINALIZAR").addEventListener("click", () => {
  verificaStep3();
});

// Repeticao de dias
