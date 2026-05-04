
 
emailjs.init("kETV3kb27Fj4tAcvc");

const btn = document.querySelector(".btn-enviar"); // Usamos la clase del nuevo botón
const form = document.getElementById('contact-form');

form.addEventListener('submit', function(event) {
    event.preventDefault();

    // Feedback visual
    const textoOriginal = btn.innerText;
    btn.innerText = 'Enviando...';
    btn.disabled = true; // Evita múltiples clics

    const serviceID = 'service_9g9a3jz';
    const templateID = 'template_7axaaxo';

    emailjs.sendForm(serviceID, templateID, this)
        .then(() => {
            btn.innerText = textoOriginal;
            btn.disabled = false;
            alert('¡Mensaje enviado con éxito! Gracias por tu retroalimentación.');
            
            this.reset(); // Limpia los campos

            // Opcional: Cerrar el formulario automáticamente después de enviar
            document.getElementById('wrapper').classList.remove('active');
            
        }, (err) => {
            btn.innerText = textoOriginal;
            btn.disabled = false;
            alert("Hubo un error al enviar el mensaje: " + JSON.stringify(err));
        });
});