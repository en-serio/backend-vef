class Dashboard 
{
    constructor()
    {

    }
}

function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');

    // Alternar la clase que mueve el sidebar fuera de la vista
    sidebar.classList.toggle('hidden');

    // Alternar el padding-left del main-content para moverlo
    mainContent.classList.toggle('sidebar-collapsed');
}


    let currentStep = 1;

    function navigateToStep(step) {
        document.querySelectorAll('.content-container').forEach(content => content.style.display = 'none');
        document.querySelector(`.content-container[stepper-label="${step}"]`).style.display = 'block';

        document.querySelectorAll('.step').forEach((stepElement, index) => {
            const stepNumber = index + 1;
            const iconContainer = document.getElementById(`step${stepNumber}Icon`);
            const icon = iconContainer.querySelector("i");

            iconContainer.classList.remove("bg-primary", "bg-light", "border-primary");
            icon.classList.remove("text-primary", "text-white", "text-muted");

            if (stepNumber < step) {
                iconContainer.classList.add("bg-primary");
                icon.classList.add("text-white");
            } else if (stepNumber === step) {
                iconContainer.classList.add("border-primary", "bg-light");
                icon.classList.add("text-primary");
            } else {
                iconContainer.classList.add("bg-light");
                icon.classList.add("text-muted");
            }
        });

        currentStep = step;
        document.getElementById('previousBtn').style.display = (step > 1) ? 'inline-block' : 'none';
        document.getElementById('nextBtn').style.display = (step < 4) ? 'inline-block' : 'none';
        document.getElementById('submitBtn').style.display = (step === 4) ? 'inline-block' : 'none';
    }

    function nextStep() 
    {
        
        if (validateStep(currentStep)) {
            
                currentStep++;
                if (currentStep == 4) {
                    resumenDatosTransfer(); 
                }
            navigateToStep(currentStep);
            
        } 
    }
        
    function validateStep(step) {
        let valid = true;

        // Remover errores previos
        document.querySelectorAll('.form-control').forEach(input => {
            input.classList.remove('is-invalid');
            const errorMessage = input.parentNode.querySelector('.error-message');
            if (errorMessage) errorMessage.remove(); // Eliminar mensaje de error específico
        });

        if (step === 1) {
            const selectedTrayecto = document.querySelector('input[name="trayecto"]:checked');
            if (!selectedTrayecto) {
                valid = false;
                const trayectoOptions = document.querySelectorAll('input[name="trayecto"]');
                trayectoOptions.forEach(option => option.classList.add('is-invalid'));
                this.showError(trayectoOptions[0].parentNode, "Selecciona un tipo de trayecto.");
            }
        } else if (step === 2) {
            const requiredFields = [
                { id: 'fechaIda', message: "Selecciona la fecha de ida." },
                { id: 'horaIda', message: "Selecciona la hora de ida." },
                { id: 'aeropuertoOrigen', message: "Introduce el aeropuerto de origen." },
                { id: 'numeroVueloIda', message: "Introduce el número de vuelo." }
            ];

            requiredFields.forEach(field => {
                const input = document.getElementById(field.id);
                if (!input?.value) {
                    valid = false;
                    input.classList.add('is-invalid');
                    this.showError(input, field.message);
                }
            });

            const fechaEntradaInput = document.getElementById('fechaIda');
            if (fechaEntradaInput) {
                const errorMessage = fechaEntradaInput.parentNode.querySelector('.error-message');
                if (errorMessage) errorMessage.remove(); 
                
                const fechaEntrada = new Date(fechaEntradaInput.value); 
                const hoy = new Date(); 
                
                hoy.setHours(0, 0, 0, 0);
                
                if (fechaEntrada < hoy) {
                    valid = false;
                    fechaEntradaInput.classList.add('is-invalid');
                    this.showError(fechaEntradaInput, "La fecha no puede ser anterior a hoy.");
                    console.warn("La fecha no puede ser anterior a hoy.");
                }
            }

            const fechaVueltaInput = document.getElementById('fechaVuelta');
            if (fechaVueltaInput) {
                const errorMessage = fechaVueltaInput.parentNode.querySelector('.error-message');
                if (errorMessage) errorMessage.remove(); 
                
                const fechaSalida = new Date(fechaVueltaInput.value); 
                const hoy = new Date(); 
                
                hoy.setHours(0, 0, 0, 0);
                
                if (fechaSalida < hoy) {
                    valid = false;
                    fechaVueltaInput.classList.add('is-invalid');
                    this.showError(fechaVueltaInput, "La fecha no puede ser anterior a hoy.");
                    console.warn("La fecha no puede ser anterior a hoy.");
                }
            }

            validateTransferDates()

            const trayecto = document.querySelector('input[name="trayecto"]:checked')?.value;
            if (trayecto === 'idaVuelta' || trayecto === 'vuelta') {
                const vueltaFields = [
                    { id: 'fechaVuelta', message: "Selecciona la fecha de vuelta." },
                    { id: 'horaVueloVuelta', message: "Selecciona la hora de vuelo." },
                    { id: 'horaRecogida', message: "Selecciona la hora de recogida." },
                    { id: 'numeroVueloVuelta', message: "Introduce el número de vuelo de vuelta." }
                ];
                vueltaFields.forEach(field => {
                    const input = document.getElementById(field.id);
                    if (!input?.value) {
                        valid = false;
                        input.classList.add('is-invalid');
                        this.showError(input, field.message);
                    }
                });
            }
        } else if (step === 3) {
            const requiredFields = [
                { id: 'hotelDestino', message: "Campo obligatorio." },
                { id: 'numeroViajeros', message: "Campo obligatorio." },
                { id: 'direccionHotel', message: "Campo obligatorio." },
                { id: 'nombreCliente', message: "Campo obligatorio." },
                { id: 'apellido1', message: "Campo obligatorio." },
                { id: 'apellido2', message: "Campo obligatorio." },
                { id: 'emailCliente', message: "Campo obligatorio." },
                { id: 'telefonoCliente', message: "Campo obligatorio." },
                { id: 'dniCliente', message: "Campo obligatorio." }
            ];
        
            requiredFields.forEach(field => {
                const input = document.getElementById(field.id);
                const errorMessage = input?.parentNode.querySelector('.error-message');
                if (errorMessage) errorMessage.remove(); // Remueve mensaje anterior
        
                if (!input?.value) {
                    valid = false;
                    input?.classList.add('is-invalid');
                    this.showError(input, field.message);
                }                     
                
        });
        
            // Validación de correo electrónico
            const emailInput = document.getElementById('emailCliente');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regex básico para correos
            if (emailInput) {
                const errorMessage = emailInput.parentNode.querySelector('.error-message');
                if (errorMessage) errorMessage.remove(); // Remueve mensaje anterior
        
                if (!emailRegex.test(emailInput.value)) {
                    valid = false;
                    emailInput.classList.add('is-invalid');
                    this.showError(emailInput, "Introduce un correo válido.");
                    console.warn("Validación fallida: el email no es válido.");
                }
            }
        
            // Validación de número de teléfono (entero)
            const telefonoInput = document.getElementById('telefonoCliente');
            if (telefonoInput) {
                const errorMessage = telefonoInput.parentNode.querySelector('.error-message');
                if (errorMessage) errorMessage.remove(); // Remueve mensaje anterior
        
                if (!/^\d+$/.test(telefonoInput.value) || telefonoInput.value.length < 9) {
                    valid = false;
                    telefonoInput.classList.add('is-invalid');
                    this.showError(telefonoInput, "Introduce un número de teléfono válido.");
                    console.warn("Validación fallida: el teléfono no es válido.");
                }
            }

        }


        return valid;
    }

    function validateTransferDates() {
        const horaVueloVueltaInput = document.getElementById('horaVueloVuelta');
        const horaRecogidaInput = document.getElementById('horaRecogida');
        let valid = true;
    
        // Eliminar mensajes de error previos
        const errorVueloMessage = horaVueloVueltaInput.parentNode.querySelector('.error-message');
        if (errorVueloMessage) errorVueloMessage.remove();
        
        const errorRecogidaMessage = horaRecogidaInput.parentNode.querySelector('.error-message');
        if (errorRecogidaMessage) errorRecogidaMessage.remove();
    
        // Verificamos si ambos campos tienen valor
        if (horaVueloVueltaInput.value && horaRecogidaInput.value) {
            // Convertir las horas a objetos Date para comparación
            const fechaActual = new Date();
            const horaVuelo = new Date(fechaActual.toDateString() + ' ' + horaVueloVueltaInput.value);
            const horaRecogida = new Date(fechaActual.toDateString() + ' ' + horaRecogidaInput.value);
    

            if (horaRecogida >= horaVuelo) {
                valid = false;
                horaRecogidaInput.classList.add('is-invalid');
                this.showError(horaRecogidaInput, "La hora de recogida no puede ser igual a la del vuelo.");
            }    
            
            const tresHorasEnMilisegundos = 3 * 60 * 60 * 1000; // 3 horas en milisegundos
            if (horaRecogida - horaVuelo > tresHorasEnMilisegundos) {
                valid = false;
                horaRecogidaInput.classList.add('is-invalid');
                this.showError(horaRecogidaInput, "La hora de recogida debe ser al menos 3 horas anterior a la del vuelo.");
            }
        } else {
            valid = false;
            if (!horaVueloVueltaInput.value) {
                horaVueloVueltaInput.classList.add('is-invalid');
                this.showError(horaVueloVueltaInput, "Selecciona la hora del vuelo.");
            }
            if (!horaRecogidaInput.value) {
                horaRecogidaInput.classList.add('is-invalid');
                this.showError(horaRecogidaInput, "Selecciona la hora de recogida.");
            }
        }
    
        return valid;
    }

    function showError(inputElement, message) {
        const errorMessage = document.createElement('small');
        errorMessage.classList.add('error-message', 'text-danger');
        errorMessage.innerText = message;
        inputElement.parentNode.appendChild(errorMessage);
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
        /*document.getElementById('trayectoIda').style.display = 'none';
        document.getElementById('trayectoVuelta').style.display = 'none';
        document.getElementById('summaryVueltaSection').style.display = 'none';*/
    }


    function submitTransfer() {        
        var transferData = {
            trayecto: $('#summaryTrayecto').text(),
            fechaIda: $('#summaryFechaIda').text(),
            horaIda: $('#summaryHoraIda').text(),
            hotelIda: $('#summaryHotelDestino').text(),
            direccionIda: $('#summaryDireccionHotel').text(),

            hotelVuelta: $('#summaryHotelDestino').text(),
            direccionVuelta: $('#summaryDireccionHotel').text(),
            aeropuertoOrigen: $('#summaryAeropuertoOrigen').text(),
            numeroVueloIda: $('#summaryNumeroVueloIda').text(),
            numeroViajeros: $('#summaryNumeroViajeros').text(),
            nombreCliente: $('#summaryNombreCliente').text(),
            emailCliente: $('#summaryEmailCliente').text(),
            apellido1: $('#summaryApellido1').text(),
            apellido2: $('#summaryApellido2').text(),
            telefonoCliente: $('#summaryTelefonoCliente').text(),
            dniCliente: $('#summaryDniCliente').text(),
            fechaVuelta: $('#summaryFechaVuelta').text(),
            horaVueloVuelta: $('#summaryHoraVueloVuelta').text(),
            horaRecogida: $('#summaryHoraRecogida').text(),
            numeroVueloVuelta: $('#summaryNumeroVueloVuelta').text()
            
        };
        var transfer = JSON.stringify(transferData)
    
        $.post("../class/controller/transferCtrl.php", {controller: "transferCtrl", action: "createTransfer", transfer}, function (data) {
            try {
                var d = JSON.parse(data);
    
                if (!d.error) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: d.message +"Localizador de la reserva: "+ d.localizador +". "
                        + "PRECIO: "+ d.precio,
                        didClose: () => {

                            $('#addReservaModal').modal('hide');
                            $('.modal-backdrop').remove();
                            resetStepper();

                        }
                    });
                    
    
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: d.message,
                    });
                }
            } catch (e) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: e.message,
                });
            }
        });
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

    function resumenDatosTransfer() 
    {

        const trayectoInput = document.querySelector('input[name="trayecto"]:checked');
        const trayecto = trayectoInput?.value;
        const trayectoText = trayectoInput?.nextSibling?.textContent?.trim();

        // Mostrar el trayecto seleccionado
        document.getElementById('summaryTrayecto').innerText = trayecto;

        // Mostrar/Ocultar campos dependiendo del trayecto
        const vueltaSection = document.getElementById('summaryVueltaSection');

        if (trayecto == 'ida') {
            vueltaSection.style.display = 'none'; 
            // Asegúrate de procesar los datos del hotel
            document.getElementById('summaryHotelDestino').innerText;
            document.getElementById('summaryDireccionHotel').innerText;
        } else if (trayecto == 'vuelta') {

            vueltaSection.style.display = 'block'; 

            document.getElementById('summaryFechaIda').innerText = 'N/A';
            document.getElementById('summaryHoraIda').innerText = 'N/A';
            document.getElementById('summaryAeropuertoOrigen').innerText = 'N/A';
            document.getElementById('summaryNumeroVueloIda').innerText = 'N/A';
            document.getElementById('summaryHotelDestino').innerText = 'N/A';
            document.getElementById('summaryDireccionHotel').innerText = 'N/A';
        } else if (trayecto == 'idaVuelta') {

            vueltaSection.style.display = 'block'; 
        }direccionHotel

        const fieldsToFill = [
            { id: 'fechaIda', summaryId: 'summaryFechaIda' },
            { id: 'horaIda', summaryId: 'summaryHoraIda' },
            { id: 'aeropuertoOrigen', summaryId: 'summaryAeropuertoOrigen' },
            { id: 'numeroVueloIda', summaryId: 'summaryNumeroVueloIda' },
            { id: 'hotelDestino', summaryId: 'summaryHotelDestino' },
            { id: 'direccionHotel', summaryId: 'summaryDireccionHotel' },
            { id: 'numeroViajeros', summaryId: 'summaryNumeroViajeros' },
            { id: 'nombreCliente', summaryId: 'summaryNombreCliente' },
            { id: 'apellido1', summaryId: 'summaryApellido1' },
            { id: 'apellido2', summaryId: 'summaryApellido2' },
            { id: 'emailCliente', summaryId: 'summaryEmailCliente' },
            { id: 'telefonoCliente', summaryId: 'summaryTelefonoCliente' },
            { id: 'dniCliente', summaryId: 'summaryDniCliente' }
        ];

        fieldsToFill.forEach(field => {
            const input = document.getElementById(field.id);
            const summaryElement = document.getElementById(field.summaryId);
            if (input && summaryElement) {
                summaryElement.innerText = input.value || 'N/A';
            }
        });

        if (trayecto == 'idaVuelta' || trayecto === 'vuelta') {
            const vueltaFields = [
                { id: 'fechaVuelta', summaryId: 'summaryFechaVuelta' },
                { id: 'horaVueloVuelta', summaryId: 'summaryHoraVueloVuelta' },
                { id: 'horaRecogida', summaryId: 'summaryHoraRecogida' },
                { id: 'numeroVueloVuelta', summaryId: 'summaryNumeroVueloVuelta' }
            ];

            vueltaFields.forEach(field => {
                const input = document.getElementById(field.id);
                const summaryElement = document.getElementById(field.summaryId);
                if (input && summaryElement) {
                    summaryElement.innerText = input.value || 'N/A';
                }
            });
        }
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

    function callbackTransfer()
    {

        $("#dynamicContent .editTransferBtn").off().click(function () {

            const idTransfer = $(this).attr('data-id');
            const type = $(this).attr('data-target');
            gestionTransfer(idTransfer, type);

        });

        $("#dynamicContent .deleteTransferBtn").off().click(function () {

            const idTransfer = $(this).attr('data-id');
            const type = $(this).attr('data-target');
            deleteTransfer(idTransfer, type);
        });
        

    }

    function callbackSaveData()
    {
        $("#modalEditBody .saveEditBtn").off().click(function () {

            const idTransfer = $(this).attr('data-id');
            saveEditData(idTransfer);
        });
        
    }

    function saveEditData(idTransfer){

        data = {
            telefono: $('.telefonoCLiente').val(),
            tipoTrayecto: $('.tipoTrayecto').val(),

            fechaEntrada: $('.fechaEntrada').val(),
            horaIda: $('.horaIda').val(),
            aeropuertoIda: $('.aeropuertoIda').val(),
            numVueloEntr: $('.numVueloEntr').val(),
            
            fechaVuelta: $('.fechaVuelta').val(),
            horaRecogida: $('.horaRecogida').val(),
            horaVueloVuelta: $('.horaVueloVuelta').val(),
            numVueloVuelta: $('.numVueloVuelta').val(),
            aeropuertoVuelta: $('.aeropuertoVuelta').val(),

            nombreHotel: $('.nombreHotel').val(),
            direccionHotel: $('.direccionHotel').val(),
            numViajeros: $('.numViajeros').val(),        
        };

        var transfer = JSON.stringify(data)


        $.post("../class/controller/transferCtrl.php", {controller: "transferCtrl", action: "saveEditData",transfer:transfer, idTransfer:idTransfer}, function (data) {
            try {
                var d= JSON.parse(data);

                if (!d.error) {
                    
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: d.message,
                    }).then(() => {
                        $('#editTransferModal').modal('hide');
                        $('.modal-backdrop').remove();
                    });

                } else {

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: d.message, 
                    });
                    
                    
                }
            } catch (e) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: e.message,
                    });
            }
        }); 
}


    function logout(){

                $.post("../class/controller/loginCtrl.php", {controller: "loginCtrl", action: "logout"}, function (data) {
                    try {
 
                        var d= JSON.parse(data);
        
                        if (!d.error) {
                            
                            Swal.fire({
                                icon: 'success',
                                title: '¡Éxito!',
                                text: d.message,
                            }).then(() => {
                                window.location.href = 'dashboard.php'; 
                            });
    
                        } else {
    
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: d.message, 
                            });
                            
                            
                        }
                    } catch (e) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: e.message,
                            });
                    }
                }); 
        }

        function loadTransfers(){

            $.post("../class/controller/transferCtrl.php", {controller: "transferCtrl", action: "loadTransfer"}, function (data) {
                try {
                        
                    var d= JSON.parse(data);
    
                    if (!d.error) {
                        $('#dynamicContent').html(d);
                        callbackTransfer();

                    } else {
                        Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: d.message, 
                    });
                    }
                } catch (e) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: e.message,
                        });
                }
            }); 
    }

    function deleteTransfer(idTransfer, type){            

        $.post("../class/controller/transferCtrl.php", {controller: "transferCtrl", action: "deleteTransfer", idTransfer:idTransfer, type:type}, function (data) {
            try {
    
                var d= JSON.parse(data);  
                if (!d.error) {      
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: d.message,
                    });
                    $('[data-id="' + idTransfer + '"]').closest('tr').remove();

                } else {
                    
                    Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: d.message, 
                });
                }
            } catch (e) {
                
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: e.message,
                    });
            }
        }); 
    }

    function gestionTransfer(idTransfer, type){     


        $.post("../class/controller/transferCtrl.php", {controller: "transferCtrl", action: "editTransfer", idTransfer:idTransfer, type:type}, function (data) {
            try {
    
                var d= JSON.parse(data);  
                if (!d.error) {      
                    
                    $('#modalEditBody').html(d.out);
                    $('#editTransferModal').modal('show');
                    callbackSaveData();
                    

                } else {
                    
                    Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: d.message,    
                });
                }
            } catch (e) {
                
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: e.message,
                    });
            }
        }); 
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
                        start: '2024-12-15T08:00:00',
                        end: '2024-11-15T10:00:00'
                    },
                    {
                        title: 'Transfer 2',
                        start: '2024-10-20T12:00:00',
                        end: '2024-10-20T14:00:00'
                    }
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
                    loadView('views.php'); 
                });
            }
            
        });

        $(document).ready(function () {
            $(".gestionTransferBtn").click(function () {
                loadTransfers();
            })
        });
