// form contacto
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

// modal

function showAppointmentForm() {
    document.getElementById("modal").style.display = "block";
}


 
let selectedEmployee = '';
let selectedServices = [];

function showAppointmentForm() {
    document.getElementById("modal").style.display = "block";
}

document.addEventListener("DOMContentLoaded", function () {
    appointmentBtn = document.getElementById("appointmentBtn");
    appointmentBtn.addEventListener("click", showAppointmentForm);

    
});




// função para serviço selecionado

function handleServiceSelection(event) {

    let indexOf = selectedServices.indexOf(event.target.dataset.service_id)
    console.log(event.target.dataset.service_id);
    if( indexOf === -1 ) {
        selectedServices.push(event.target.dataset.service_id)

    }
    else {
        selectedServices.splice(indexOf, 1)
    } 
    console.log(selectedServices);
}



//botoes
let currentTab = 0;
showTab(currentTab);

function showTab(n) {
    
    let tabs = document.getElementsByClassName("tab_reservation");
    tabs[n].style.display = "block";

  
    let steps = document.getElementsByClassName("step");
    steps[n].className += " active";

    if (n === 0) {
        document.getElementById("prevBtn").style.display = "none";
        document.getElementById("submitBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }

    if (n === (tabs.length - 1)) {
        document.getElementById("nextBtn").style.display = "none";
        document.getElementById("submitBtn").style.display = "inline";

    } else {
        document.getElementById("nextBtn").innerHTML = "Próximo";
    }
    
    
}

function nextPrev(n) {
    let tabs = document.getElementsByClassName("tab_reservation");

    if (n === 1 && !validateForm()) {
        return false;
    }

    tabs[currentTab].style.display = "none";

    currentTab += n;

    if (currentTab >= tabs.length) {
        console.log('Selected Employee:', selectedEmployee);
        console.log('Selected Services:', selectedServices);
        document.getElementById("appointment_form").submit();
        return false;
    }

    showTab(currentTab);

    if (currentTab === 1) {
        const selectedEmployeeRadio = document.querySelector('input[name="selected_employee"]:checked');
        if (selectedEmployeeRadio) {
            selectedEmployee = selectedEmployeeRadio.value;
            console.log('Selected Employee:', selectedEmployee);
        }
    }
}


// validação form

function validateForm() {
    
    return true;
}

$('.service_label').click(function() 
{
    $(this).button('toggle');
}); 




  
  
  
  


