const divQrCode = document.getElementById('qrcode-auth');
const userData = JSON.parse(localStorage.getItem('dataUser'));
// aletas de erro e sucesso
const alertDanger = document.getElementById('alert-error-dog');
const alertSuccess = document.getElementById('alert-success-dog');
// formulário de autenticação
const formTwo2fa = document.getElementById('form-two-2fa');

function generateSecret(length) {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    let secret = '';

    for (let i = 0; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * characters.length);
        secret += characters.charAt(randomIndex);
    }

    return secret;
}
function loadingQRCode() {
    const qrContainer = document.getElementById('qr-container');
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

formTwo2fa.addEventListener('submit', (event) => {
    event.preventDefault();
    hideAlerts();
    const inputCode = document.getElementById('input-code');
    const code = inputCode.value;
    fetch('http://localhost:3000/auth/verify', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            username: userData.username,
            password: userData.password,
            token: code,
        })
    })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                alertDanger.classList.remove('d-none');
                alertSuccess.classList.add('d-none');
                alertDanger.innerText = data.message;
                return
            }

            alertSuccess.classList.remove('d-none');
            alertDanger.classList.add('d-none');
            alertSuccess.innerText = data.message;
            setTimeout(() => {
                window.location.href = "index.html";
            })

        })
        .catch(error => {
            alertDanger.classList.remove('d-none');
            alertSuccess.classList.add('d-none');
            alertDanger.innerText = 'Erro ao verificar o código de autenticação.';
        })
})

// Instancia o objeto Qrious com o elemento canvas
window.onload = () => {
    loadingQRCode();
}
