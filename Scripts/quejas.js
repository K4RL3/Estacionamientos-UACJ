emailjs.init("kETV3kb27Fj4tAcvc");

const form = document.getElementById('contact-form');
const btnEnviar = document.querySelector(".btn-enviar");

form.addEventListener('submit', function (event) {
    event.preventDefault();

    btnEnviar.innerText = 'Enviando...';

    const serviceID = 'service_9g9a3jz';
    const templateID = 'template_7axaaxo';

    emailjs.sendForm(serviceID, templateID, this)
        .then(() => {
            btnEnviar.innerText = 'Enviar Mensaje';
            alert('¡Mensaje enviado con éxito!');
            this.reset();
            document.getElementById('wrapper').classList.remove('active'); // Esconde el form al terminar
        }, (err) => {
            btnEnviar.innerText = 'Enviar Mensaje';
            alert("Error al enviar: " + JSON.stringify(err));
        });
});