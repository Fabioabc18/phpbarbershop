document.addEventListener("DOMContentLoaded", () => {
    const contactForm = document.getElementById("contact_form");
    const statusMessage = document.getElementById("contact_status_message");

    contactForm.addEventListener("submit", (e) => {
        e.preventDefault();



        fetch("/contact", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `name=${contactForm.name.value}&email=${contactForm.email.value}&subject=${contactForm.subject.value}&message=${contactForm.message.value}&send`


        })
            .then(response => response.json())
            .then(result => {

                if (result.status === "OK") {
                    contactForm.style.display = "none";
                    statusMessage.textContent = "Mensagem enviada com sucesso";
                } else {
                    statusMessage.textContent = "Erro no envio, verifique novamente";
                }
            });
    });
});

