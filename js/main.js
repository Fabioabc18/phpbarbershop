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

$('.service_label').click(function() 
{
    $(this).button('toggle');
}); 

 
let selectedEmployee = '';
let selectedServices = [];

function showAppointmentForm() {
    document.getElementById("modal").style.display = "block";
}

document.addEventListener("DOMContentLoaded", function () {
    appointmentBtn = document.getElementById("appointmentBtn");
    appointmentBtn.addEventListener("click", showAppointmentForm);
});

let checkboxes = document.querySelectorAll('input[name="selected_services[]"]');

function handleServiceSelection(event) {
    const selectedServices = document.querySelectorAll('input[name="selected_services[]"]:checked');
    const selectedServiceIds = Array.from(selectedServices).map(service => service.value);
    console.log('Selected Services:', selectedServiceIds);

    checkboxes.forEach((checkbox) => {
        console.log('Checkbox Value:', checkbox.value);
        console.log('Checkbox Checked:', checkbox.checked);
    });
}

checkboxes.forEach((checkbox) => {
    checkbox.addEventListener('change', handleServiceSelection);
});


let currentTab = 0;
showTab(currentTab);

function showTab(n) {
    
    let tabs = document.getElementsByClassName("tab_reservation");
    tabs[n].style.display = "block";

  
    let steps = document.getElementsByClassName("step");
    steps[n].className += " active";

    if (n === 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }

    if (n === (tabs.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
        document.getElementById("nextBtn").innerHTML = "Next";
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
        document.getElementById("appointment_form").submit();
        return false;
    }

    showTab(currentTab);

    if (currentTab === 1) {
        document.querySelector(`input[value="${selectedEmployee}"]`).checked = true;
    }


    if (currentTab === 0) {
        selectedServices.forEach(service => {
            document.querySelector(`input[value="${service}"]`).checked = true;
        });
    }
}

function validateForm() {
    
    return true;
}






/* document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("appointment_form");
    const openModalButton = document.getElementById("openModalButton");
  
    openModalButton.addEventListener("click", () => {
      modal.style.display = "block";
    });
  }); */