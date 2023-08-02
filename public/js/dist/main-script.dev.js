"use strict";

var optionLogout = document.querySelector('.options-logout-user');
var btnLoginUser = document.querySelector('.btn-login-user');

function carregarDadosUser() {
  var nome = document.querySelector('.nome-user-dog');
  var email = document.querySelector('.email-user-doc');
  var avatar = document.querySelector('.main-img-user img');
  var profileUser = document.querySelector('.profile-user img');
  var dataUser = JSON.parse(localStorage.getItem('dataUser'));
  nome.innerHTML = dataUser.name;
  email.innerHTML = dataUser.email;
  avatar.setAttribute('src', dataUser.picture);
  profileUser.setAttribute('src', dataUser.picture);
}

window.onload = carregarDadosUser;
btnLoginUser.addEventListener('click', function () {
  localStorage.setItem('isLogado', true);
});
optionLogout.addEventListener('click', function () {
  localStorage.clear();
  localStorage.setItem('isLogado', false);
  localStorage.setItem('dataUser', null);
  window.location.href = "two-factor-auth.html";
});