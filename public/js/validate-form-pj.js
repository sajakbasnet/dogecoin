const formCadastroPj = document.getElementById('form-cadastro-pj');
const inputCnpj = document.getElementById('cnpj');
const inputPhone = document.getElementById('phone');
const passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('confirm-password');
const checkIcons = document.querySelectorAll('.check0 i');
const checkTexts = document.querySelectorAll('.check0 span');
const showPassword = document.getElementById('show-password');
const showConfirmPassword = document.getElementById('show-password-confirme');
const checkedTermosSitesPj = document.getElementById('accept-termos-site-pj');

const actionsSubmit = document.getElementById('actions-submit');

const siteKeyRecaptch = '6LcF890mAAAAAOIOJ6KE-ym_zj9IzVtkqdoR0pH4';

document.addEventListener('DOMContentLoaded', function () {
    const script = document.createElement('script');
    script.src = 'https://www.google.com/recaptcha/api.js';
    script.setAttribute('async', '');
    script.setAttribute('defer', '');
    document.head.appendChild(script);


    const div = document.createElement('div');
    div.classList.add('col-md-12', 'col-sm-12', 'd-flex', 'justify-content-end');

    const buttonSubmit = document.createElement('button');
    buttonSubmit.id = 'btn-submit';
    buttonSubmit.classList.add('btn', 'btn-main-primary', 'mt-4');
    buttonSubmit.setAttribute('type', 'submit');
    buttonSubmit.innerText = 'Cadastrar';

    const divRecaptcha = document.createElement('div');
    divRecaptcha.classList.add('col-md-12', 'col-sm-12', 'd-flex', 'justify-content-end', 'container-recaptcha');
    const spanRecaptcha = document.createElement('span');
    spanRecaptcha.classList.add('g-recaptcha');
    spanRecaptcha.setAttribute('data-sitekey', siteKeyRecaptch);
    divRecaptcha.appendChild(spanRecaptcha);

    div.appendChild(buttonSubmit);

    actionsSubmit.appendChild(divRecaptcha);
    actionsSubmit.appendChild(div);
})


function handleFormSubmit() {
    const htmlEmail = `
                <h1>Olá ${formCadastroPj.nome.value}!</h1>
                <p> Seu cadastro foi realizado com sucesso.</p>
                <p><strong>Seu login é:</strong> ${formCadastroPj.email.value}</p>
                <p><strong>Seu CNPJ é:</strong> ${formCadastroPj.cnpj.value}</p>
                <p>Atenciosamente, Equipe Suporte.</p>
            `;


    enviarEmail(formCadastroPj.email.value, 'Cadastro realizado com sucesso', htmlEmail)
        .then(r => {
            const alertMessage = document.querySelector('#alerte-success');
            alertMessage.removeAttribute('hidden');

            const messageSuccess = document.querySelector('#msg-success');
            messageSuccess.innerHTML = `Uma confirmação de e-mail foi enviado para: <strong>${formCadastroPj.email.value}</strong>`;
            formCadastroPj.reset();
        })
        .catch(e => {
            const alertMessage = document.querySelector('#alerte-error');
            alertMessage.removeAttribute('hidden');

            const messageError = document.querySelector('#msg-error');
            messageError.innerHTML = `Erro ao enviar e-mail para <strong>${formCadastroPj.email.value}</strong>`;
        })
}


async function enviarEmail(destinatario, assunto, corpoHTML) {
    try {
        const response = await fetch('https://api.sendinblue.com/v3/smtp/email', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'api-key': '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',
            },
            body: JSON.stringify({
                sender: {email: 'noreply@dogecaramelo.com.br'},
                to: [{email: destinatario}],
                subject: assunto,
                htmlContent: corpoHTML,
            }),
        });

        if (response.ok) {
            console.log('Email enviado com sucesso');
        } else {
            const errorData = await response.json();
            console.log('Erro ao enviar o email: ' + errorData.message);
        }
    } catch (error) {
        console.log('Erro ao enviar o email: ' + error);
    }
}

showPassword.addEventListener('click', function () {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        confirmPasswordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
        confirmPasswordInput.type = 'password';
    }

    showPassword.classList.toggle('fa-eye-slash');
    showConfirmPassword.classList.toggle('fa-eye-slash');
})

function verificationRecaptcha() {
    const recaptchaResponse = grecaptcha.getResponse();
    if (recaptchaResponse === '') {
        alert('Por favor, marque o reCAPTCHA antes de enviar o formulário.');
    }
    if (recaptchaResponse !== ''){
        handleFormSubmit()
        grecaptcha.reset();
        window.scrollTo(0, 0)
    }
}



function validateForm(event) {
    event.preventDefault(); // Evita o envio automático do formulário

    let inputs = formCadastroPj.getElementsByTagName('input');
    let isValid = true;
    let senhaNaoConfere = false;

    const passwordValue = passwordInput.value;
    const confirmPasswordValue = confirmPasswordInput.value;

    if (passwordValue !== confirmPasswordValue) {
        event.preventDefault();
        senhaNaoConfere = true;
    }


    for (let i = 0; i < inputs.length; i++) {
        let input = inputs[i];
        const ulError = document.querySelector(`#valid-${input.name}`)
        const liError = document.querySelector(`#valid-${input.name} li.parsley-required`)


        if (input === inputCnpj) {
            if (!validaCnpj(input.value)) {
                event.preventDefault();
            } else {
                input.classList.remove('parsley-error');
            }
        }


        if (input.value === '' && input.name !== 'phone' && input.name !== 'wallet') {
            input.classList.add('parsley-error');
            ulError.removeAttribute('hidden')
            liError.innerText = 'Campo é obrigatório'
            isValid = false;
        } else {
            input.classList.remove('parsley-error');
            ulError.setAttribute('hidden', '')
        }
        if (input === confirmPasswordInput && senhaNaoConfere && isValid) {
            input.classList.add('parsley-error');
            ulError.removeAttribute('hidden')
            liError.innerText = 'As senhas não conferem'
            isValid = false;
        }

        if (input === passwordInput && !isPasswordValid && input.value !== '') {
            input.classList.add('parsley-error');
            ulError.removeAttribute('hidden')
            liError.innerText = 'Senha não atende aos critérios de segurança'
            isValid = false;
        }

        if(input === checkedTermosSitesPj && !input.checked){
            input.classList.add('parsley-error');
            ulError.removeAttribute('hidden')
            liError.innerText = 'Você precisa aceitar os termos do site'
            isValid = false;
        }

    }


    if (!isValid) {
        event.preventDefault();
    } else {
        verificationRecaptcha()
    }

}

var isPasswordValid = false;

if (formCadastroPj) {
    formCadastroPj.addEventListener('submit', validateForm);
}

inputPhone.addEventListener('input', function () {
    let phoneValue = inputPhone.value;

    // Remove todos os caracteres não numéricos do valor do telefone
    let numericPhoneValue = phoneValue.replace(/\D/g, '');

    // Limita a quantidade de dígitos numéricos ao máximo necessário para um número de telefone válido
    const maxLength = 11;
    if (numericPhoneValue.length > maxLength) {
        numericPhoneValue = numericPhoneValue.slice(0, maxLength);
    }

    // Aplica a máscara
    phoneValue = numericPhoneValue.replace(/^(\d{2})(\d{4,5})(\d{4}).*/, '($1) $2-$3');

    // Atualiza o valor do campo de entrada com a máscara
    inputPhone.value = phoneValue;
});

passwordInput.addEventListener('input', function () {
    const passwordValue = passwordInput.value;

    const hasMinLength = passwordValue.length >= 8;
    const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(passwordValue);
    const hasUppercase = /[A-Z]/.test(passwordValue);
    const hasNumber = /[0-9]/.test(passwordValue);

    checkIcons[0].className = hasMinLength ? 'fas fa-check-circle' : 'far fa-check-circle';
    checkIcons[0].style.color = hasMinLength ? 'green' : '';
    checkTexts[0].style.color = hasMinLength ? 'green' : '';

    checkIcons[1].className = hasSpecialChar ? 'fas fa-check-circle' : 'far fa-check-circle';
    checkIcons[1].style.color = hasSpecialChar ? 'green' : '';
    checkTexts[1].style.color = hasSpecialChar ? 'green' : '';

    checkIcons[2].className = hasUppercase ? 'fas fa-check-circle' : 'far fa-check-circle';
    checkIcons[2].style.color = hasUppercase ? 'green' : '';
    checkTexts[2].style.color = hasUppercase ? 'green' : '';

    checkIcons[3].className = hasNumber ? 'fas fa-check-circle' : 'far fa-check-circle';
    checkIcons[3].style.color = hasNumber ? 'green' : '';
    checkTexts[3].style.color = hasNumber ? 'green' : '';

    isPasswordValid = hasMinLength && hasSpecialChar && hasUppercase && hasNumber;
});

inputCnpj.addEventListener('input', function (e) {
    e.preventDefault();
    let cnpj = inputCnpj.value;

    cnpj = cnpj.slice(0, 18);

    cnpj = cnpj.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
    cnpj = cnpj.replace(/^(\d{2})(\d)/, '$1.$2'); // Adiciona ponto após o segundo dígito
    cnpj = cnpj.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3'); // Adiciona ponto após o quinto dígito
    cnpj = cnpj.replace(/\.(\d{3})(\d)/, '.$1/$2'); // Adiciona barra após o oitavo dígito
    cnpj = cnpj.replace(/(\d{4})(\d)/, '$1-$2'); // Adiciona hífen antes dos dois últimos dígitos
    inputCnpj.value = cnpj;
});

function validaCnpj(cnpj) {
    const ulError = document.getElementById('valid-cnpj');
    const liError = document.querySelector('#valid-cnpj li.parsley-required');
    if (cnpj === '') {
        inputCnpj.classList.add('parsley-error');
        ulError.removeAttribute('hidden');
        liError.innerText = 'CNPJ obrigatório';
        return false;
    }
    if (cnpj.length < 18) {
        inputCnpj.classList.add('parsley-error');
        ulError.removeAttribute('hidden');
        liError.innerText = 'CNPJ inválido';
        return false;
    }
    let cnpjRegex = /^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/;
    if (!cnpjRegex.test(cnpj)) {
        inputCnpj.classList.add('parsley-error');
        ulError.removeAttribute('hidden');
        return false;
    }
    inputCnpj.classList.remove('parsley-error');
    ulError.setAttribute('hidden', '');
    return true;
}
