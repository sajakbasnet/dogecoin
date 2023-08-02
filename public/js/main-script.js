const optionLogout = document.querySelector('.options-logout-user');
const btnLoginUser = document.querySelector('.btn-login-user');

function carregarDadosUser() {
    const nome = document.querySelector('.nome-user-dog');
    const email = document.querySelector('.email-user-doc');
    const avatar = document.querySelector('.main-img-user img');
    const profileUser = document.querySelector('.profile-user img')

    const dataUser = JSON.parse(localStorage.getItem('dataUser'));

    nome.innerHTML = dataUser.name;
    email.innerHTML = dataUser.email;
    avatar.setAttribute('src', dataUser.picture)
    profileUser.setAttribute('src', dataUser.picture)
}
window.onload = carregarDadosUser;

btnLoginUser.addEventListener('click', () => {
    localStorage.setItem('isLogado', true);
})

optionLogout.addEventListener('click', () => {
    localStorage.clear();
    localStorage.setItem('isLogado', false);
    localStorage.setItem('dataUser', null);
    window.location.href = "two-factor-auth.html";
})
