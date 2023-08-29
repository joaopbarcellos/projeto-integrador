const form = document.getElementById('multi-step-form');
const steps = form.querySelectorAll('.step');
const nextBtns = form.querySelectorAll('.next-btn');
const prevBtns = form.querySelectorAll('.prev-btn');
const input2 = document.getElementById("preco");

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
        showStep(currentStep);
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
        // if(!verificaCampos(btn.parentElement)){
        //     return;
        // }
        nextStep();
    });
    console.log(steps)
});

prevBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        prevStep();
    });
});


// Inicialização
showStep(currentStep);

// Validação dos campos

function verificaCampos(divPai){
    divPai.children.forEach(filho => {
        if(filho.type == "select"){
            
        }
    })
}


// Step 1
    // Campo nome do evento
    function validarNomeEvento(currentStep){
        const nomeEvento = document.querySelector("#nomeEvento"); 

        if (nomeEvento.value){
            console.log("vgsges")
            Swal.fire({
                title: "ERRO!",
                icon: "error",
                text: `O campo de nome de evento não pode ser vazio`
            })   
        }
        
    }

    // Campo data do evento


    // Campo horário início


    // Campo término estimado


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