"use strict";

var divQrCode = document.getElementById('qrcode-auth');
var userData = JSON.parse(localStorage.getItem('dataUser')); // aletas de erro e sucesso

var alertDanger = document.getElementById('alert-error-dog');
var alertSuccess = document.getElementById('alert-success-dog'); // formulário de autenticação

var formTwo2fa = document.getElementById('form-two-2fa');

function generateSecret(length) {
  var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
  var secret = '';

  for (var i = 0; i < length; i++) {
    var randomIndex = Math.floor(Math.random() * characters.length);
    secret += characters.charAt(randomIndex);
  }

  return secret;
}

function loadingQRCode() {
  var qrContainer = document.getElementById('qr-container');
  qrContainer.innerHTML = JSON.stringify(localStorage.getItem('qrcodeElement'));
}

function hideAlerts() {
  if (!alertDanger.classList.contains('d-none')) {
    alertDanger.classList.add('d-none');
  }

  if (!alertSuccess.classList.contains('d-none')) {
    alertSuccess.classList.add('d-none');
  }
}

formTwo2fa.addEventListener('submit', function (event) {
  event.preventDefault();
  hideAlerts();
  var inputCode = document.getElementById('input-code');
  var code = inputCode.value;
  fetch('http://localhost:3000/auth/verify', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      username: userData.username,
      password: userData.password,
      token: code
    })
  }).then(function (response) {
    return response.json();
  }).then(function (data) {
    if (!data.success) {
      alertDanger.classList.remove('d-none');
      alertSuccess.classList.add('d-none');
      alertDanger.innerText = data.message;
      return;
    }

    alertSuccess.classList.remove('d-none');
    alertDanger.classList.add('d-none');
    alertSuccess.innerText = data.message;
    setTimeout(function () {
      window.location.href = "index.html";
    });
  })["catch"](function (error) {
    alertDanger.classList.remove('d-none');
    alertSuccess.classList.add('d-none');
    alertDanger.innerText = 'Erro ao verificar o código de autenticação.';
  });
}); // Instancia o objeto Qrious com o elemento canvas

window.onload = function () {
  loadingQRCode();
};