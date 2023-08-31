const form = document.getElementById('multi-step-form');
const steps = form.querySelectorAll('.step');
const nextBtns = form.querySelectorAll('.next-btn');
const prevBtns = form.querySelectorAll('.prev-btn');
const input2 = document.getElementById("preco");

// Validação dos campos
// Campo nome do evento
function validarNomeEvento(){
    console.log("Nomeevento")
    const nomeEvento = document.querySelector("#nomeEvento"); 

    if (!nomeEvento.value){ // Adicionar a exclamação (!) antes pra funcionar
        return "nome do evento";
    } return true;
}    


const dataEvento = document.querySelector("#dataEvento").value;
// Campo data do evento
function validarDataEvento(){
    if(!dataEvento || !verificaseDatadoEventoeMaiordoqueaDataAtual(dataEvento)){
        return "data do evento";
    }
    return true;
}


function verificaseDatadoEventoeMaiordoqueaDataAtual(dataEvento){
    dataEvento = new Date(dataEvento);
    dataAtual = new Date();
    
    if(dataEvento.getFullYear() > dataAtual.getFullYear()) return true;
    if(dataEvento.getFullYear == dataAtual.getFullYear()){
        if(dataEvento.getMonth() > dataAtual.getMonth()) return true;
        if(dataEvento.getMonth() == dataAtual.getMonth()){
            if(dataEvento.getDate() + 1 >= dataAtual.getDate()) return true;
        }
    }
    return false;

}

function verificaseDatadoEventoeNoMesmoDia(dataEvento){
    dataEvento = new Date(dataEvento);
    dataAtual = new Date();
    return dataEvento.getDate() + 1 == dataAtual.getDate();
}

const horarioInicio = document.querySelector("#horarioInicio").value;
const horarioFinal = document.querySelector("#horarioFim").value;

const horaInicio = parseInt(horarioInicio.substring(0, 2));
const minutoInicio = parseInt(horarioInicio.substring(2));
// Campo horário início
function validarHorarioInicio(){

    if(!horarioInicio){
        return "horário inicial do evento";
    }
    if(verificaseDatadoEventoeNoMesmoDia(dataEvento)){
        let dataAtual = new Date();
        if(horaInicio > dataAtual.getHours()) return true;
        if(horaInicio == dataAtual.getHours()){
            if(minutoInicio >= dataAtual.getMinutes() + 2) return true;
        }
        return "horário inicial do evento";
    }
}


// Campo término estimado
function validarTerminoEstimado(){
    let horaFinal = parseInt(horarioFinal.substring(0, 2));
    let minutoFinal = parseInt(horarioFinal.substring(2));

    if(!horarioFinal){
        return "horário final do evento";
    }
    if(horaFinal > horaInicio) return true;
    if(horaFinal == horaInicio){
        if(minutoFinal >= minutoInicio + 2) return true;
    }
    return "horário final do evento";
}

function validarPrecoEvento(){
    const precoEvento = document.querySelector("#preco");
    
    if(!precoEvento || precoEvento.isNan()){
        return "preço do evento";
    }
    return true;
}
// Step 1
function verificaStep1(currentStep){
    let validarNomeEvento1 = validarNomeEvento();
    let validarDataEvento1 = validarDataEvento();
    let validarHorarioInicio1 = validarHorarioInicio();
    let validarTerminoEstimado1 = validarTerminoEstimado();
    let validarPrecoEvento1 = validarPrecoEvento();
    let listaVerifica = [validarNomeEvento1, validarDataEvento1, validarHorarioInicio1, validarTerminoEstimado1, validarPrecoEvento1];
    let listaNova = [];
    if (listaVerifica.every((element) => element === true)){
        showStep(currentStep);
    } else {
        listaVerifica.forEach(elemento => {
            if(elemento !== true){
                listaNova.append(elemento);
            }
        })
        Swal.fire({
            title: "ERRO!",
            icon: "error",
            text: `Os campos ${listaNova} estão inválidos!`
        })
    }

}
// Step 2
// Calllback CEP
const listaEstados = [0, "AC", "AL", "AP", "AM", "BA", "CE", "DF", "ES", "GO", 'MA', 'MT',
'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO']					
function callbackDaPaginaQueEnviaremosOCEPDoEventoCadastradoPeloClienteNaPaginaDeCriarEventoNovo(conteudoRetornadoPelaPagina){
    if (!("erro" in conteudoRetornadoPelaPagina)) {
        //Atualiza os campos com os valores.
        document.getElementById('logradouroEvento').value=(conteudoRetornadoPelaPagina.logradouro);
        document.getElementById('bairroEvento').value=(conteudoRetornadoPelaPagina.bairro);
        document.getElementById('cidadeEvento').value=(conteudoRetornadoPelaPagina.localidade);
        for(let i = 0; i < listaEstados.length; i++){
            if(listaEstados[i] == (conteudoRetornadoPelaPagina.uf)){
                document.getElementById('estadoEvento').value = i;
            }
        }
        
    } else {
        //CEP não Encontrado.
        Swal.fire({
            title: "ERRO!",
            icon: "error",
            text: `O CEP não foi encontrado!`
        })   
    }
}

// Script validar CEP
function validarCEPnoSiteViaCep(cep){
    //Cria um elemento javascript.
    var script = document.createElement('script');
    //Sincroniza com o callback.
    script.src = `https://viacep.com.br/ws/${cep}/json/?callback=callbackDaPaginaQueEnviaremosOCEPDoEventoCadastradoPeloClienteNaPaginaDeCriarEventoNovo`;
    //Insere script no documento e carrega o conteúdo.
    document.body.appendChild(script);
}

function verificaFormatacaoCep(){
    const campoCep = document.querySelector("#cepEvento");
    var cep = campoCep.value;
    
    // Verifica se existe um valor no CEP
    if (!cep) {
        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {
            validarCEPnoSiteViaCep(cep);
        }
    } else {
        Swal.fire({
            title: "ERRO!",
            icon: "error",
            text: `O CEP está em formato inválido!`
        })
    }
}











    // Campo logradouro


    // Campo cidade
    
    
    // Campo bairro
    
    
    // Campo cep
    
    
    
    // Campo número
    
    
    // Campo estado
    
    
    // Campo complemento

    
input2.addEventListener("input", (e) => {
    const { value } = e.target;

    const len = value.length;
    const dolarIndex = value.indexOf("R$");
    const number = value.substring(0, len - 1);

    console.log(dolarIndex === -1);

    if (dolarIndex !== len - 1 || dolarIndex === -1 || isNaN(number)) {
        e.target.value = "R$";
        e.target.setSelectionRange(dolarIndex, dolarIndex);
    }
});


let currentStep = 0;

const showStep = (stepIndex) => {
    steps.forEach((step, index) => {
        step.style.display = index === stepIndex ? 'block' : 'none';
    });
};

const nextStep = () => {
    if (currentStep < steps.length - 1) {
        currentStep++;
        if (currentStep == 1) {
            verificaStep1(currentStep);
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

nextBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        nextStep();
    });
});

prevBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        prevStep();
    });
});


// Inicialização
showStep(currentStep);

verificaStep1(currentStep);