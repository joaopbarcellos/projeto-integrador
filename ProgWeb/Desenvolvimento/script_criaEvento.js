const form = document.getElementById('multi-step-form');
const steps = form.querySelectorAll('.step');
const nextBtns = form.querySelectorAll('.next-btn');
const prevBtns = form.querySelectorAll('.prev-btn');

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
