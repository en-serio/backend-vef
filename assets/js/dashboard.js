let currentStep = 1;


function navigateToStep(step) {
    // Ocultar todas las secciones y mostrar solo la del paso actual
    document.querySelectorAll('.content-container').forEach(content => content.style.display = 'none');
    document.querySelector(`.content-container[stepper-label="${step}"]`).style.display = 'block';

    // Actualizar los iconos de los pasos
    document.querySelectorAll('.step').forEach((stepElement, index) => {
        const stepNumber = index + 1;
        const iconContainer = document.getElementById(`step${stepNumber}Icon`);
        const icon = iconContainer.querySelector("i");

        // Resetear clases
        iconContainer.classList.remove("bg-primary", "bg-light", "border-primary");
        icon.classList.remove("text-primary", "text-white", "text-muted");

        if (stepNumber < step) {
            // Pasos completados
            iconContainer.classList.add("bg-primary");
            icon.classList.add("text-white");
        } else if (stepNumber === step) {
            // Paso actual
            iconContainer.classList.add("border-primary", "bg-light");
            icon.classList.add("text-primary");
        } else {
            // Pasos futuros
            iconContainer.classList.add("bg-light");
            icon.classList.add("text-muted");
        }
    });

    currentStep = step;

    // Mostrar u ocultar los botones de navegación
    document.getElementById('previousBtn').style.display = (step > 1) ? 'inline-block' : 'none';
    document.getElementById('nextBtn').style.display = (step < 4) ? 'inline-block' : 'none';
    document.getElementById('submitBtn').style.display = (step === 4) ? 'inline-block' : 'none';
}

function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const mainContent = document.getElementById("main-content");

    sidebar.classList.toggle("d-none"); // Oculta o muestra el sidebar
    sidebar.classList.toggle("sidebar-collapsed");

    if (sidebar.classList.contains("d-none")) {
        mainContent.classList.replace("col-lg-10", "col-lg-12");
        mainContent.classList.replace("col-md-9", "col-md-12");
    } else {
        mainContent.classList.replace("col-lg-12", "col-lg-10");
        mainContent.classList.replace("col-md-12", "col-md-9");
    }
}


function validateStep(step) {
    let valid = true;

    // Resetear estilos de error
    document.querySelectorAll('.form-control').forEach(input => {
        input.classList.remove('is-invalid');
        const errorMessage = input.parentNode.querySelector('.error-message');
        if (errorMessage) errorMessage.remove();
    });

    if (step === 1) {
        const selectedTrayecto = document.querySelector('input[name="trayecto"]:checked');
        if (!selectedTrayecto) {
            valid = false;
            const trayectoOptions = document.querySelectorAll('input[name="trayecto"]');
            trayectoOptions.forEach(option => option.classList.add('is-invalid'));
            showError(trayectoOptions[0].parentNode, "Selecciona un tipo de trayecto.");
        }
    } else if (step === 2) {
        const trayecto = document.querySelector('input[name="trayecto"]:checked').value;
        const fechaIda = document.getElementById("fechaIda");
        const horaIda = document.getElementById("horaIda");
        const aeropuertoOrigen = document.getElementById("aeropuertoOrigen");
        const numeroVueloIda = document.getElementById("numeroVueloIda");

        // Validación de los campos de ida
        if (!fechaIda.value) {
            valid = false;
            fechaIda.classList.add('is-invalid');
            showError(fechaIda, "Selecciona la fecha de ida.");
        }
        if (!horaIda.value) {
            valid = false;
            horaIda.classList.add('is-invalid');
            showError(horaIda, "Selecciona la hora de ida.");
        }
        if (!aeropuertoOrigen.value) {
            valid = false;
            aeropuertoOrigen.classList.add('is-invalid');
            showError(aeropuertoOrigen, "Introduce el aeropuerto de origen.");
        }
        if (!numeroVueloIda.value) {
            valid = false;
            numeroVueloIda.classList.add('is-invalid');
            showError(numeroVueloIda, "Introduce el número de vuelo.");
        }

        // Validación de los campos de vuelta
        if (trayecto === 'idaVuelta' || trayecto === 'vuelta') {
            const fechaVuelta = document.getElementById("fechaVuelta");
            const horaVuelta = document.getElementById("horaVueloVuelta");
            const horaRecogida = document.getElementById("horaRecogida");
            const numeroVueloVuelta = document.getElementById("numeroVueloVuelta");

            if (!fechaVuelta.value) {
                valid = false;
                fechaVuelta.classList.add('is-invalid');
                showError(fechaVuelta, "Selecciona la fecha de vuelta.");
            }
            if (!horaVuelta.value) {
                valid = false;
                horaVuelta.classList.add('is-invalid');
                showError(horaVuelta, "Selecciona la hora de vuelo.");
            }
            if (!horaRecogida.value) {
                valid = false;
                horaRecogida.classList.add('is-invalid');
                showError(horaRecogida, "Selecciona la hora de recogida.");
            }
            if (!numeroVueloVuelta.value) {
                valid = false;
                numeroVueloVuelta.classList.add('is-invalid');
                showError(numeroVueloVuelta, "Introduce el número de vuelo de vuelta.");
            }
        }
    } else if (step === 3) {
        const requiredFields = [
            { id: 'hotelDestino', message: 'Introduce el hotel de destino/recogida.' },
            { id: 'numeroViajeros', message: 'Introduce el número de viajeros.' },
            { id: 'direccionHotel', message: 'Introduce la dirección del hotel.' },
            { id: 'nombreCliente', message: 'Introduce tu nombre completo.' },
            { id: 'emailCliente', message: 'Introduce tu correo electrónico.' },
            { id: 'telefonoCliente', message: 'Introduce tu teléfono de contacto.' },
            { id: 'dniCliente', message: 'Introduce tu DNI/Pasaporte.' }
        ];

        requiredFields.forEach(field => {
            const inputElement = document.getElementById(field.id);
            if (!inputElement.value) {
                valid = false;
                inputElement.classList.add('is-invalid');
                showError(inputElement, field.message);
            }
        });
    }

    return valid;
}

function showError(inputElement, message) {
    const errorMessage = document.createElement('small');
    errorMessage.classList.add('error-message', 'text-danger');
    errorMessage.innerText = message;
    inputElement.parentNode.appendChild(errorMessage);
}

function nextStep() {
    if (validateStep(currentStep)) {
        if (currentStep < 4) {
            navigateToStep(currentStep + 1);
        }
        if (currentStep === 4) {
            fillSummary();
        }
    }
}

function previousStep() {
    if (currentStep > 1) {
        navigateToStep(currentStep - 1);
    }
}

function loadTransferModal() {
    fetch('createTransfer.php')
        .then(response => response.text())
        .then(html => {
            const modalContainer = document.createElement('div');
            modalContainer.innerHTML = html;
            document.body.appendChild(modalContainer);
            const modal = new bootstrap.Modal(modalContainer.querySelector('#addReservaModal'));
            modal.show();
        })
        .catch(error => console.error('Error cargando el modal:', error));
}

//Resetear el modal stepper cada vez que se cierra
document.getElementById('addReservaModal').addEventListener('show.bs.modal', resetStepper);


function resetStepper() {
    currentStep = 1;
    navigateToStep(1);

    // Limpiar los campos de entrada en todos los pasos
    document.querySelectorAll('.form-control').forEach(input => {
        input.value = '';
        input.classList.remove('is-invalid');
    });

    // Remover mensajes de error
    document.querySelectorAll('.error-message').forEach(error => error.remove());

    // Resetear el estado de los iconos del stepper
    document.querySelectorAll('.step .p-3').forEach((icon, index) => {
        if (index === 0) {
            icon.classList.add("border-primary", "bg-primary", "text-white");
            icon.classList.remove("text-muted");
        } else {
            icon.classList.remove("border-primary", "bg-primary", "text-white");
            icon.classList.add("text-muted");
        }
    });

    // Mostrar/ocultar los botones de navegación
    document.getElementById('previousBtn').style.display = 'none';
    document.getElementById('nextBtn').style.display = 'inline-block';
    document.getElementById('submitBtn').style.display = 'none';

    // Ocultar secciones condicionales
    document.getElementById('trayectoIda').style.display = 'none';
    document.getElementById('trayectoVuelta').style.display = 'none';
    document.getElementById('summaryVueltaSection').style.display = 'none';
}

function submitTransfer() {
    alert('Transfer reservado con éxito!');
    
}

function updateDateTimeFields() {
    const trayecto = document.querySelector('input[name="trayecto"]:checked').value;

    if (trayecto === 'ida') {
        document.getElementById('trayectoIda').style.display = 'block';
        document.getElementById('trayectoVuelta').style.display = 'none';
    } else if (trayecto === 'vuelta') {
        document.getElementById('trayectoIda').style.display = 'none';
        document.getElementById('trayectoVuelta').style.display = 'block';
    } else if (trayecto === 'idaVuelta') {
        document.getElementById('trayectoIda').style.display = 'block';
        document.getElementById('trayectoVuelta').style.display = 'block';
    }
}

function fillSummary() {
    document.getElementById('summaryTrayecto').innerText = document.querySelector('input[name="trayecto"]:checked').nextSibling.textContent.trim();
    document.getElementById('summaryFechaIda').innerText = document.getElementById('fechaIda').value;
    document.getElementById('summaryHoraIda').innerText = document.getElementById('horaIda').value;
    document.getElementById('summaryAeropuertoOrigen').innerText = document.getElementById('aeropuertoOrigen').value;
    document.getElementById('summaryNumeroVueloIda').innerText = document.getElementById('numeroVueloIda').value;

    const trayecto = document.querySelector('input[name="trayecto"]:checked').value;
    if (trayecto === 'idaVuelta' || trayecto === 'vuelta') {
        document.getElementById('summaryVueltaSection').style.display = 'block';
        document.getElementById('summaryFechaVuelta').innerText = document.getElementById('fechaVuelta').value || 'N/A';
        document.getElementById('summaryHoraVueloVuelta').innerText = document.getElementById('horaVueloVuelta').value || 'N/A';
        document.getElementById('summaryHoraRecogida').innerText = document.getElementById('horaRecogida').value || 'N/A';
        document.getElementById('summaryNumeroVueloVuelta').innerText = document.getElementById('numeroVueloVuelta').value || 'N/A';
    } else {
        document.getElementById('summaryVueltaSection').style.display = 'none';
    }

    document.getElementById('summaryHotelDestino').innerText = document.getElementById('hotelDestino').value;
    document.getElementById('summaryNumeroViajeros').innerText = document.getElementById('numeroViajeros').value;
    document.getElementById('summaryNombreCliente').innerText = document.getElementById('nombreCliente').value;
    document.getElementById('summaryEmailCliente').innerText = document.getElementById('emailCliente').value;
    document.getElementById('summaryTelefonoCliente').innerText = document.getElementById('telefonoCliente').value;
    document.getElementById('summaryDniCliente').innerText = document.getElementById('dniCliente').value;
}

function loadView(viewUrl) {
    fetch(viewUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al cargar el contenido: ' + response.statusText);
            }
            return response.text();
        })
        .then(html => {
            document.getElementById('dynamicContent').innerHTML = html;
            initializeCalendar();
        })
        .catch(error => console.error(error));
}

function openAddReservaModal() {
    resetStepper();
    const addReservaModal = new bootstrap.Modal(document.getElementById('addReservaModal'), {
        backdrop: 'static'
    });
    addReservaModal.show();
}


function initializeCalendar() {
    var calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'es',
            initialView: 'timeGridWeek', 
            height: '100%', 
            contentHeight: 'auto', 
            editable: false,
            selectable: true,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title', // Título del mes o semana
                right: 'dayGridMonth,timeGridWeek'
            },
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                day: 'Día',
                list: 'Agenda'
            },
            events: [
                {
                    title: 'Transfer 1',
                    start: '2024-10-15T08:00:00',
                    end: '2024-10-15T10:00:00'
                },
                {
                    title: 'Transfer 2',
                    start: '2024-10-20T12:00:00',
                    end: '2024-10-20T14:00:00'
                }
                // Agrega más eventos aquí si es necesario
            ]
        });
        calendar.render();
    }
}



// Añade un listener para el enlace de "Panel de vistas"
document.addEventListener('DOMContentLoaded', function () {
    const vistaPanelLink = document.getElementById('vistaPanelLink');
    if (vistaPanelLink) {
        vistaPanelLink.addEventListener('click', function (e) {
            e.preventDefault(); // Previene el recargo de página
            loadView('views.php'); // Carga views.php en #dynamicContent
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const gestionTransferPanelLink = document.getElementById('gestionTransferPanelLink');
    if (gestionTransferPanelLink) {
        gestionTransferPanelLink.addEventListener('click', function (e) {
            e.preventDefault(); // Previene el recargo de página
            loadView('gestionTransfers.php'); // Carga views.php en #dynamicContent
        });
    }
});


document.addEventListener('DOMContentLoaded', function () {
    const vistaPanelLink = document.getElementById('vistaPanelLink');
    const dynamicContent = document.getElementById('dynamicContent');

    // Función para cargar contenido dinámico en `dynamicContent`
    function loadView(viewUrl) {
        fetch(viewUrl)
            .then(response => response.text())
            .then(html => {
                dynamicContent.innerHTML = html;
                initializeCalendar(); // Inicializar el calendario después de cargar la vista
            })
            .catch(error => console.error('Error al cargar el contenido:', error));
    }

    // Evento para cargar `views.php` al hacer clic en "Panel de vistas"
    if (vistaPanelLink) {
        vistaPanelLink.addEventListener('click', function (e) {
            e.preventDefault(); // Evita que se recargue la página
            loadView('views.php'); // Ruta relativa al archivo `views.php`
        });
    }

});
