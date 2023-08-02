"use strict";

var formCadastroPf = document.getElementById('form-cadastro-pf');
var inputPhone = document.getElementById('phone');
var inputCpf = document.getElementById('cpf');
var passwordInput = document.getElementById('password');
var confirmPasswordInput = document.getElementById('confirm-password');
var checkIcons = document.querySelectorAll('.check0 i');
var checkTexts = document.querySelectorAll('.check0 span');
var showPassword = document.getElementById('show-password');
var showConfirmPassword = document.getElementById('show-password-confirme');
var checkTermosSitePf = document.getElementById('accept-termos-site-pf');
var actionsSubmit = document.getElementById('actions-submit');
var siteKeyRecaptch = '6LcF890mAAAAAOIOJ6KE-ym_zj9IzVtkqdoR0pH4';
document.addEventListener('DOMContentLoaded', function () {
  var script = document.createElement('script');
  script.src = 'https://www.google.com/recaptcha/api.js';
  script.setAttribute('async', '');
  script.setAttribute('defer', '');
  document.head.appendChild(script);
  var div = document.createElement('div');
  div.classList.add('col-md-12', 'col-sm-12', 'd-flex', 'justify-content-end');
  var buttonSubmit = document.createElement('button');
  buttonSubmit.id = 'btn-submit';
  buttonSubmit.classList.add('btn', 'btn-main-primary', 'mt-4');
  buttonSubmit.setAttribute('type', 'submit');
  buttonSubmit.innerText = 'Cadastrar';
  var divRecaptcha = document.createElement('div');
  divRecaptcha.classList.add('col-md-12', 'col-sm-12', 'd-flex', 'justify-content-end', 'container-recaptcha');
  var spanRecaptcha = document.createElement('span');
  spanRecaptcha.classList.add('g-recaptcha');
  spanRecaptcha.setAttribute('data-sitekey', siteKeyRecaptch);
  divRecaptcha.appendChild(spanRecaptcha);
  div.appendChild(buttonSubmit);
  actionsSubmit.appendChild(divRecaptcha);
  actionsSubmit.appendChild(div);
});

function handleFormSubmit() {
  var htmlEmail = "\n                <h1>Ol\xE1 ".concat(formCadastroPf.nome.value, "!</h1>\n                <p> Seu cadastro foi realizado com sucesso.</p>\n                <p><strong>Seu login \xE9:</strong> ").concat(formCadastroPf.email.value, "</p>\n                <p><strong>Seu CPF \xE9:</strong> ").concat(formCadastroPf.cpf.value, "</p>\n                <p>Atenciosamente, Equipe Suporte.</p>\n            ");
  enviarEmail(formCadastroPf.email.value, 'Cadastro realizado com sucesso', htmlEmail).then(function (r) {
    var alertMessage = document.querySelector('#alerte-success');
    alertMessage.removeAttribute('hidden');
    var messageSuccess = document.querySelector('#msg-success');
    messageSuccess.innerHTML = "Uma confirma\xE7\xE3o de e-mail foi enviado para: <strong>".concat(formCadastroPf.email.value, "</strong>");
    formCadastroPf.reset();
  })["catch"](function (e) {
    var alertMessage = document.querySelector('#alerte-error');
    alertMessage.removeAttribute('hidden');
    var messageError = document.querySelector('#msg-error');
    messageError.innerHTML = "Erro ao enviar e-mail para <strong>".concat(formCadastroPj.email.value, "</strong>");
  });
}

function verificationRecaptcha() {
  var recaptchaResponse = grecaptcha.getResponse();

  if (recaptchaResponse === '') {
    alert('Por favor, marque o reCAPTCHA antes de enviar o formulário.');
  }

  if (recaptchaResponse !== '') {
    handleFormSubmit();
    grecaptcha.reset();
    window.scrollTo(0, 0);
  }
}

function enviarEmail(destinatario, assunto, corpoHTML) {
  var response, errorData;
  return regeneratorRuntime.async(function enviarEmail$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          _context.prev = 0;
          _context.next = 3;
          return regeneratorRuntime.awrap(fetch('https://api.sendinblue.com/v3/smtp/email', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'api-key': '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'
            },
            body: JSON.stringify({
              sender: {
                email: 'noreply@dogecaramelo.com.br'
              },
              to: [{
                email: destinatario
              }],
              subject: assunto,
              htmlContent: corpoHTML
            })
          }));

        case 3:
          response = _context.sent;

          if (!response.ok) {
            _context.next = 8;
            break;
          }

          console.log('Email enviado com sucesso');
          _context.next = 12;
          break;

        case 8:
          _context.next = 10;
          return regeneratorRuntime.awrap(response.json());

        case 10:
          errorData = _context.sent;
          console.log('Erro ao enviar o email: ' + errorData.message);

        case 12:
          _context.next = 17;
          break;

        case 14:
          _context.prev = 14;
          _context.t0 = _context["catch"](0);
          console.log('Erro ao enviar o email: ' + _context.t0);

        case 17:
        case "end":
          return _context.stop();
      }
    }
  }, null, null, [[0, 14]]);
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
});
var isPasswordValid = false;

function validateForm(event) {
  event.preventDefault(); // Evita o envio automático do formulário

  var inputs = formCadastroPf.getElementsByTagName('input');
  var isValid = true;
  var senhaNaoConfere = false;
  var passwordValue = passwordInput.value;
  var confirmPasswordValue = confirmPasswordInput.value;

  if (passwordValue !== confirmPasswordValue) {
    event.preventDefault();
    senhaNaoConfere = true;
  } // Percorre todos os inputs do formulário


  for (var i = 0; i < inputs.length; i++) {
    var input = inputs[i];
    var ulError = document.querySelector("#valid-".concat(input.name));
    var liError = document.querySelector("#valid-".concat(input.name, " li.parsley-required")); // Valida o CPF

    if (input === inputCpf) {
      if (!validaCpf(input.value)) {
        event.preventDefault();
      } else {
        input.classList.remove('parsley-error');
      }
    } // Outras validações para os demais inputs...


    if (input.value === '' && input.name !== 'phone' && input.name !== 'wallet') {
      input.classList.add('parsley-error');
      ulError.removeAttribute('hidden');
      liError.innerText = 'Campo é obrigatório';
      isValid = false;
    } else {
      input.classList.remove('parsley-error');
      ulError.setAttribute('hidden', '');
    }

    if (input === confirmPasswordInput && senhaNaoConfere && isValid) {
      input.classList.add('parsley-error');
      ulError.removeAttribute('hidden');
      liError.innerText = 'As senhas não conferem';
      isValid = false;
    }

    if (input === passwordInput && !isPasswordValid) {
      input.classList.add('parsley-error');
      ulError.removeAttribute('hidden');
      liError.innerText = 'Senha não atende aos critérios de segurança';
      isValid = false;
      console.log(ulError, liError);
    }

    if (input === checkTermosSitePf && !input.checked) {
      input.classList.add('parsley-error');
      ulError.removeAttribute('hidden');
      liError.innerText = 'É necessário aceitar os termos de uso';
      isValid = false;
    }
  }

  if (!isValid) {
    event.preventDefault();
  } else {
    verificationRecaptcha();
  }
}

if (formCadastroPf) {
  formCadastroPf.addEventListener('submit', validateForm);
}

inputPhone.addEventListener('input', function () {
  var phoneValue = inputPhone.value;
  var numericPhoneValue = phoneValue.replace(/\D/g, '');
  var maxLength = 11;

  if (numericPhoneValue.length > maxLength) {
    numericPhoneValue = numericPhoneValue.slice(0, maxLength);
  }

  phoneValue = numericPhoneValue.replace(/^(\d{2})(\d{4,5})(\d{4}).*/, '($1) $2-$3');
  inputPhone.value = phoneValue;
});
passwordInput.addEventListener('input', function () {
  var passwordValue = passwordInput.value;
  var hasMinLength = passwordValue.length >= 8;
  var hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(passwordValue);
  var hasUppercase = /[A-Z]/.test(passwordValue);
  var hasNumber = /[0-9]/.test(passwordValue);
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
inputCpf.addEventListener('input', function (e) {
  e.preventDefault();
  var cpf = inputCpf.value;
  cpf = cpf.slice(0, 14);
  cpf = cpf.replace(/\D/g, ''); // Remove todos os caracteres não numéricos

  cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona ponto após o terceiro dígito

  cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona ponto após o sexto dígito

  cpf = cpf.replace(/(\d{3})(\d{2})$/, '$1-$2'); // Adiciona hífen antes dos dois últimos dígitos

  inputCpf.value = cpf;
});

function validaCpf(cpf) {
  var ulError = document.getElementById('valid-cpf');
  var liError = document.querySelector('#valid-cpf li.parsley-required');

  if (cpf === '') {
    inputCpf.classList.add('parsley-error');
    ulError.removeAttribute('hidden');
    liError.innerText = 'CPF obrigatório';
    return false;
  }

  if (cpf.length < 14) {
    inputCpf.classList.add('parsley-error');
    ulError.removeAttribute('hidden');
    liError.innerText = 'CPF inválido';
    return false;
  }

  var cpfRegex = /^\d{3}\.\d{3}\.\d{3}\-\d{2}$/;

  if (!cpfRegex.test(cpf)) {
    inputCpf.classList.add('parsley-error');
    ulError.removeAttribute('hidden');
    return false;
  }

  inputCpf.classList.remove('parsley-error');
  ulError.setAttribute('hidden', '');
  return true;
}