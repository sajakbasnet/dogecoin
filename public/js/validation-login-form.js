const formLogin = document.getElementById('form-login-dogcaramelo');
const username = document.getElementById('login-user-dog');
const password = document.getElementById('senha-user-dog');

formLogin.addEventListener('submit', async (e) => {
    e.preventDefault();
    await fetch('http://localhost:3000/auth/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            username: username.value,
            password: password.value
        })
    })
        .then((response) => response.json())
        .then((response) => {
            if (response.success) {
                localStorage.setItem('dataUser', JSON.stringify(response.dataUser))
                localStorage.setItem('isLogado', true);
                localStorage.setItem('qrcodeElement', response.qrcode_element)

            }
    })
        .catch((error) => {
            console.error(error)
        })

    setTimeout(() => {
        window.location.href = "two-factor-auth.html";
    }, 1000);
})

function handleCredentialResponse(response) {
    const data = jwt_decode(response.credential)
    localStorage.setItem("tokenGoogle", response.credential)
    localStorage.setItem("dataUser", JSON.stringify(data))
    localStorage.setItem('isLogado', true);
    if (data.email_verified) {
        window.location.href = "index.html";
    }
}

window.onload = function () {
    google.accounts.id.initialize({
        client_id: "994049457020-f78l8mvcs2qe19kr21498r12vd132p4k.apps.googleusercontent.com",
        callback: handleCredentialResponse
    });
    google.accounts.id.renderButton(
        document.getElementById("buttonDiv"),
        {
            theme: "filled_blue",
            size: "large",
            type: "standard",
            shape: "pill",
            text: "continue_with",
            locale: "pt-BR",
            logo_alignment: "left",
            width: "300"
        }  // customization attributes
    );
    google.accounts.id.prompt(); // also display the One Tap dialog
}
