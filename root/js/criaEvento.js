// Importando a funcao de autenticacao de campos
import * as base from "./base.js";

const form = document.getElementById("multistepform");
const steps = form.querySelectorAll(".step");
const nextBtns = form.querySelectorAll(".next-btn");
const prevBtns = form.querySelectorAll(".prev-btn");
let currentStep = 0;

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
  if (!dataEvento || !verificaseDatadoEventoeMaiordoqueaDataAtual(dataEvento)) {
    return "data";
  }
  return true;
}

function verificaseDatadoEventoeMaiordoqueaDataAtual(dataEvento) {
  var dataEvento = document.querySelector("#dataEvento").value;
  dataEvento = new Date(dataEvento);
  var dataAtual = new Date();
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
  return dataEvento.getDate() + 1 == dataAtual.getDate();
}

// Campo horário início
function validarHorarioInicio() {
  var dataEvento = document.querySelector("#dataEvento").value;
  var horarioIni = document.querySelector("#horarioInicio");
  var horarioInicio = horarioIni.value;
  const horaInicio = parseInt(horarioInicio.substring(0, 2), 10);
  const minutoInicio = parseInt(horarioInicio.substring(3), 10);
  if (!horarioInicio) {
    return "horário inicial";
  }
  if (verificaseDatadoEventoeNoMesmoDia(dataEvento)) {
    let dataAtual = new Date();
    if (horaInicio > dataAtual.getHours()) return true;
    if (horaInicio == dataAtual.getHours()) {
      if (minutoInicio >= dataAtual.getMinutes() + 2) return true;
    }
    return "horário inicial";
  }
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

  if (!horarioFinal) {
    return "término estimado";
  }
  if (horaFinal > horaInicio) return true;
  if (horaFinal == horaInicio) {
    if (minutoFinal >= minutoInicio + 2) return true;
  }
  return "término estimado";
}

function validarNumero(valorCampo, mensagemErro) {
  if (!valorCampo || isNaN(valorCampo)) {
    return mensagemErro;
  }
  return true;
}

// Step 1
function verificaStep1() {
  let validarNomeEvento1 = validarNomeEvento();
  let validarDataEvento1 = validarDataEvento();
  let validarHorarioInicio1 = validarHorarioInicio();
  let validarTerminoEstimado1 = validarTerminoEstimado();
  let validarPrecoEvento1 = validarNumero(
    document.querySelector("#preco").value,
    "preço"
  );

  let listaVerifica = [
    validarNomeEvento1,
    validarDataEvento1,
    validarHorarioInicio1,
    validarTerminoEstimado1,
    validarPrecoEvento1,
  ];
  let strErros = "";
  listaVerifica.forEach((elemento) => {
    if (elemento !== true) {
      if (elemento == listaVerifica[listaVerifica.length - 1]) {
        strErros += `${elemento}`;
      } else {
        strErros += `${elemento}, `;
      }
    }
  });

  if (!strErros.length > 0) {
    currentStep++;
    showStep(currentStep);
  } else {
    Swal.fire({
      title: "ERRO!",
      icon: "error",
      text: `Os campos ${strErros} estão inválidos!`,
    });
  }
}

// Ouvidor de input do campo de cep
const campoCep = document.querySelector("#cepEvento");
campoCep.addEventListener("input", (e) => {
  formatCEP(campoCep);
});

// Calllback CEP
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
  var url = 'https://viacep.com.br/ws/' + cep +'/json/';
  var request = new XMLHttpRequest();

  request.open('GET', url);
  request.onerror = function (e){
    document.getElementById('return').innerHTML = 'API offline ou Cep Inválido'
  }

  request.onload = () => {
    var response = JSON.parse(request.responseText);

    if(response.erro == true){
      Swal.fire({
              title: "ERRO!",
              icon: "error",
              text: `O CEP está em formato inválido!`,
      });
    }else{
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
  if (!valorCampo | !isNaN(valorCampo)) {
    return mensagemErro;
  }
  return true;
}

// Step 2
function verificaStep2() {
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
  let validaComplemento = verificaSeTaEscritoNoFormulario(
    document.querySelector("#complementoEvento").value,
    "complemento"
  );
  let validaNumero = verificaSeTaEscritoNoFormulario(
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

  listaVerifica.forEach((elemento) => {
    if (elemento !== true) {
      if (elemento == listaVerifica[listaVerifica.length - 1]) {
        strErros += `${elemento}`;
      } else {
        strErros += `${elemento}, `;
      }
    }
  });

  if (!strErros.length > 0) {
    currentStep++;
    showStep(currentStep);
  } else {
    Swal.fire({
      title: "ERRO!",
      icon: "error",
      text: `Os campos ${strErros} estão inválidos!`,
    });
  }
}

function verificaStep3() {
  let validaQtdMin = validarNumero(
    document.querySelector("#capMinima").value,
    "quantidade mínima"
  );
  let validaQtdMax = validarNumero(
    document.querySelector("#capMaxima").value,
    "quantidade máxima"
  );

  let listaVerifica = [validaQtdMin, validaQtdMax];
  let strErros = "";

  listaVerifica.forEach((elemento) => {
    if (elemento !== true) {
      strErros += `${elemento}, `;
    }
  });

  if (!strErros.length > 0) {
    alert("Seu evento foi criado!")
    currentStep++;
    document.querySelector("form").submit();
  } else {
    Swal.fire({
      title: "ERRO!",
      icon: "error",
      text: `Os campos ${strErros} estão inválidos!`,
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