class Dashboard 
{
    constructor(){}
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
                if (input && input.offsetParent !== null && !input.value) { // Validar solo campos visibles
                    valid = false;
                    input.classList.add('is-invalid');
                    this.showError(input, field.message);
                }
            });
    
            const fechaEntradaInput = document.getElementById('fechaIda');
            if (fechaEntradaInput) {
                const fechaEntrada = new Date(fechaEntradaInput.value);
                const hoy = new Date();
                hoy.setHours(0, 0, 0, 0);
                if (fechaEntrada < hoy) {
                    valid = false;
                    fechaEntradaInput.classList.add('is-invalid');
                    this.showError(fechaEntradaInput, "La fecha no puede ser anterior a hoy.");
                }
            }
    
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
                    if (input && input.offsetParent !== null && !input.value) { // Validar solo campos visibles
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
                if (input && input.offsetParent !== null && !input.value) { // Validar solo campos visibles
                    valid = false;
                    input.classList.add('is-invalid');
                    this.showError(input, field.message);
                }
            });
    
            const emailInput = document.getElementById('emailCliente');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (emailInput && !emailRegex.test(emailInput.value)) {
                valid = false;
                emailInput.classList.add('is-invalid');
                this.showError(emailInput, "Introduce un correo válido.");
            }
    
            const telefonoInput = document.getElementById('telefonoCliente');
            if (telefonoInput && (!/^\d+$/.test(telefonoInput.value) || telefonoInput.value.length < 9)) {
                valid = false;
                telefonoInput.classList.add('is-invalid');
                this.showError(telefonoInput, "Introduce un número de teléfono válido.");
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
            numeroVueloVuelta: $('#summaryNumeroVueloVuelta').text(),
            idHotel: $('#summaryHotelId').val() 
            
        };
        var transfer = JSON.stringify(transferData)
    
        $.post("../class/controller/transferCtrl.php", {controller: "transferCtrl", action: "createTransfer", transfer}, function (data) {
            try {
                var d = JSON.parse(data);
    
                if (!d.error) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: d.message +" Localizador de la reserva: "+ d.localizador +". "
                        + "Precio: "+ d.precio + "€",
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
        const idaSection = document.getElementById('summaryIdaSection');
        const hotelSection = document.getElementById('summaryHotel');

        if (trayecto == 'ida') {
            vueltaSection.style.display = 'none'; 
            idaSection.style.display = 'block'; 
            hotelSection.style.display = 'block'; 
            // Asegúrate de procesar los datos del hotel
             document.getElementById('summaryHotelDestino').innerText = 'N/A';
            document.getElementById('summaryDireccionHotel').innerText = 'N/A';
        } else if (trayecto == 'vuelta') {

            vueltaSection.style.display = 'block'; 
            hotelSection.style.display = 'block';

            document.getElementById('summaryFechaIda').innerText = 'N/A';
            document.getElementById('summaryHoraIda').innerText = 'N/A';
            document.getElementById('summaryAeropuertoOrigen').innerText = 'N/A';
            document.getElementById('summaryNumeroVueloIda').innerText = 'N/A';
            
        } else if (trayecto == 'idaVuelta') {

            idaSection.style.display = 'block'; 
            vueltaSection.style.display = 'block'; 
            hotelSection.style.display = 'block'
        }

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

        $("#dynamicContent .viewTransferBtn").off().click(function () {

            const idTransfer = $(this).attr('data-id');
            const type = $(this).attr('data-target');
            gestionViewTransfer(idTransfer, type);

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

                    loadTransfers();

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
                        $('#dynamicContent').html(d.out);
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

        Swal.fire({
            title: "Vas a eliminar el transfer",
            text: "Esta acción no puede deshacerse.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Eliminar transfer"
        }).then((result) => {
            // Si el usuario confirma la eliminación
            if (result.isConfirmed) {
        $.post("../class/controller/transferCtrl.php", {controller: "transferCtrl", action: "deleteTransfer", idTransfer:idTransfer, type:type}, function (data) {
        
            try {
                var d = JSON.parse(data);  
                if (!d.error) {  
                    Swal.fire({
                        title: "Transfer eliminado!",
                        text: "Tu transfer se ha cancelado correctamente.",
                        icon: "success"
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
    });
    }

    function gestionTransfer(idTransfer, type){     


        $.post("../class/controller/transferCtrl.php", {controller: "transferCtrl", action: "editTransfer", idTransfer:idTransfer, type:type}, function (data) {
            try {
    
                var d= JSON.parse(data);  
                if (!d.error) {      
                    
                    $('#modalEditBody').html(d.out);
                    $('#editTransferModal').modal('show');
                    actualizarVisibilidadTrayecto();
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

    function gestionViewTransfer(idTransfer, type){     


        $.post("../class/controller/transferCtrl.php", {controller: "transferCtrl", action: "viewTransfer", idTransfer:idTransfer, type:type}, function (data) {
            try {
    
                var d= JSON.parse(data);  
                if (!d.error) {      
                    
                    $('#modalEditBody').html(d.out);
                    $('#editTransferModal').modal('show');
                   
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
    
   async function fetchActiveTransfers() {
        try {
            const response = fetch('../class/controller/transferCtrl.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    controller: 'transferCtrl',
                    action: 'loadTransfer',    
                }),
            });

            const text = response.text();
    
            if (response.ok) {
                const result = await response.json();
    
                if (result.error) {
                    console.error('Error en el servidor:', result.message);
                    return [];
                }
    
                return result.data.map(transfer => {
                    const startDateTime = new Date(`${transfer.fecha_entrada}T${transfer.hora_entrada}`);
                    const endDateTime = new Date(startDateTime);
                    endDateTime.setHours(startDateTime.getHours() + 1);
                    return {
                        title: `Reserva #${transfer.localizador}`,
                        start: startDateTime.toISOString(),
                        end: endDateTime.toISOString(),
                        description: `Cliente: ${transfer.email_cliente}, Num. viajeros: ${transfer.num_viajeros}`,
                        location: `Hotel ID: ${transfer.id_hotel}, Destino: ${transfer.id_destino}`,
                    };
                });
            } else {
                console.error('Error en la solicitud:', response.statusText);
            }
        } catch (error) {
            console.error('Hubo un problema con la solicitud:', error);
        }
    }
    
    async function loadTransfersCalendar() {
            try {
                const response = await fetch('../class/controller/transferCtrl.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        controller: 'transferCtrl',  
                        action: 'loadCalendarTransfer' 
                    })
                });
        
                if (!response.ok) {
                    throw new Error(`Error en la solicitud: ${response.statusText}`);
                }
        
                const data = await response.json();  
        
                
                if (data.error) {
                    throw new Error(data.message);
                }
        
                return data.out;  
        
            } catch (error) {
                console.error('Error al cargar los transfers:', error);
                return []; 
            }
    }

    async function initializeCalendar() {
        var calendarEl = document.getElementById('calendar');
        if (calendarEl) {
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'es',
                initialView: 'dayGridMonth',
                height: '100%',
                contentHeight: 'auto',
                editable: false,
                selectable: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek'
                },
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Día',
                    list: 'Agenda'
                },
                events: [],
                eventClick: function(info) {
                    var event = info.event;
                    showEventDetails(event);
                }
            });
    
            try {
                const transfers = await loadTransfersCalendar();
                transfers.forEach(transfer => {
                    let startDateTime = null;
                    let endDateTime = null;
    
                    // Verifica el trayecto de ida
                    if (transfer.fecha_entrada && transfer.hora_entrada) {
                        startDateTime = new Date(`${transfer.fecha_entrada}T${transfer.hora_entrada}`);
                        endDateTime = new Date(startDateTime);
                        endDateTime.setHours(startDateTime.getHours() + 1); // Duración de 1 hora
    
                        if (!isNaN(startDateTime.getTime()) && !isNaN(endDateTime.getTime())) {
                            calendar.addEvent({
                                title: `${transfer.localizador} - Ida`,
                                start: startDateTime.toISOString(),
                                end: endDateTime.toISOString(),
                                description: `Cliente: ${transfer.email_cliente}, Num. viajeros: ${transfer.num_viajeros}`,
                                location: transfer.descripcion_hotel || 'Ubicación no disponible',
                                extendedProps: {
                                    email_cliente: transfer.email_cliente,
                                    num_viajeros: transfer.num_viajeros,
                                    id_hotel: transfer.id_hotel,
                                    id_destino: transfer.id_destino,
                                    fecha_entrada: transfer.fecha_entrada,
                                    hora_entrada: transfer.hora_entrada,
                                    hora_recogida: transfer.hora_recogida,
                                    numero_vuelo_entrada: transfer.numero_vuelo_entrada,
                                    origen_vuelo_entrada: transfer.origen_vuelo_entrada,
                                    fecha_vuelo_salida: transfer.fecha_vuelo_salida,
                                    hora_vuelo_salida: transfer.hora_vuelo_salida,
                                    numero_vuelo_vuelta: transfer.numero_vuelo_vuelta,
                                    id_tipo_reserva: transfer.id_tipo_reserva,
                                    descripcion_hotel: transfer.descripcion_hotel,
                                    nombre_hotel: transfer.nombre_hotel
                                }
                            });
                        } else {
                            console.warn(`Evento con datos inválidos omitido: ${transfer.localizador}`);
                        }
                    }
    
                    // Verifica el trayecto de vuelta
                    if (transfer.fecha_vuelo_salida && transfer.hora_vuelo_salida) {
                        startDateTime = new Date(`${transfer.fecha_vuelo_salida}T${transfer.hora_vuelo_salida}`);
                        endDateTime = new Date(startDateTime);
                        endDateTime.setHours(startDateTime.getHours() + 1); // Duración de 1 hora
    
                        if (!isNaN(startDateTime.getTime()) && !isNaN(endDateTime.getTime())) {
                            calendar.addEvent({
                                title: `${transfer.localizador} - Vuelta`,
                                start: startDateTime.toISOString(),
                                end: endDateTime.toISOString(),
                                description: `Cliente: ${transfer.email_cliente}, Num. viajeros: ${transfer.num_viajeros}`,
                                location: transfer.descripcion_hotel || 'Ubicación no disponible',
                                extendedProps: {
                                    email_cliente: transfer.email_cliente,
                                    num_viajeros: transfer.num_viajeros,
                                    id_hotel: transfer.id_hotel,
                                    id_destino: transfer.id_destino,
                                    fecha_entrada: transfer.fecha_entrada,
                                    hora_entrada: transfer.hora_entrada,
                                    hora_recogida: transfer.hora_recogida,
                                    numero_vuelo_entrada: transfer.numero_vuelo_entrada,
                                    origen_vuelo_entrada: transfer.origen_vuelo_entrada,
                                    fecha_vuelo_salida: transfer.fecha_vuelo_salida,
                                    hora_vuelo_salida: transfer.hora_vuelo_salida,
                                    numero_vuelo_vuelta: transfer.numero_vuelo_vuelta,
                                    id_tipo_reserva: transfer.id_tipo_reserva,
                                    descripcion_hotel: transfer.descripcion_hotel,
                                    nombre_hotel: transfer.nombre_hotel
                                }
                            });
                        } else {
                            console.warn(`Evento con datos inválidos omitido: ${transfer.localizador}`);
                        }
                    }
                });
                calendar.render();
            } catch (error) {
                console.error('Hubo un problema al cargar los transfers:', error);
            }
        }
    }


    function showEventDetails(event) {
        let reservaInfo = '';
    
        // Mostrar solo la información relevante dependiendo del tipo de reserva
        if (event.extendedProps.id_tipo_reserva === 'Ida') {
            reservaInfo = `
                <p><strong>Fecha entrada:</strong> ${event.extendedProps.fecha_entrada}</p>
                <p><strong>Llegada:</strong> ${event.extendedProps.hora_entrada}</p>
                <p><strong>Número de vuelo entrada:</strong> ${event.extendedProps.numero_vuelo_entrada}</p>
                <p><strong>Origen vuelo entrada:</strong> ${event.extendedProps.origen_vuelo_entrada}</p>
            `;
        } else if (event.extendedProps.id_tipo_reserva === 'Vuelta') {
            reservaInfo = `
                <p><strong>Fecha vuelta:</strong> ${event.extendedProps.fecha_vuelo_salida}</p>
                <p><strong>Hora recogida:</strong> ${event.extendedProps.hora_recogida}</p>
                <p><strong>Hora vuelo:</strong> ${event.extendedProps.hora_vuelo_salida}</p>
                <p><strong>Vuelo vuelta:</strong> ${event.extendedProps.numero_vuelo_vuelta}</p>
            `;
        } else if (event.extendedProps.id_tipo_reserva === 'Ida y Vuelta') {
            reservaInfo = `
                <p><strong>Fecha entrada:</strong> ${event.extendedProps.fecha_entrada}</p>
                <p><strong>Llegada:</strong> ${event.extendedProps.hora_entrada}</p>
                <p><strong>Recogida:</strong> ${event.extendedProps.hora_recogida || 'No disponible'}</p>
                <p><strong>Vuelo entrada:</strong> ${event.extendedProps.numero_vuelo_entrada}</p>
                <p><strong>Origen vuelo entrada:</strong> ${event.extendedProps.origen_vuelo_entrada}</p>
                <p><strong>Fecha vuelta:</strong> ${event.extendedProps.fecha_vuelo_salida}</p>
                <p><strong>Hora recogida:</strong> ${event.extendedProps.hora_recogida}</p>
                <p><strong>Hora vuelo:</strong> ${event.extendedProps.hora_vuelo_salida}</p>
                <p><strong>Número de vuelo vuelta:</strong> ${event.extendedProps.numero_vuelo_vuelta}</p>
            `;
        }
    
        // Crear el contenido del modal
        var modalContent = `
            <p><strong>Localizador:</strong> ${event.title}</p>
            <p><strong>Cliente:</strong> ${event.extendedProps.email_cliente}</p>
            <p><strong>Viajeros:</strong> ${event.extendedProps.num_viajeros}</p>
            <p><strong>Hotel:</strong> ${event.extendedProps.nombre_hotel}</p>
            <p><strong>Destino:</strong> ${event.extendedProps.descripcion_hotel}</p>
            ${reservaInfo}
        `;
    
        // Mostrar el modal con Swal
        Swal.fire({
            title: 'Detalles del Transfer',
            html: modalContent,
            icon: 'info',
            showCloseButton: true
        });
    }

    function loadDatosUser() {       
            // Asignamos los valores a los campos del formulario
            document.getElementById('nombreCliente').value = document.getElementById('nombreCliente').getAttribute('data-value');
            document.getElementById('apellido1').value = document.getElementById('apellido1').getAttribute('data-value');
            document.getElementById('apellido2').value = document.getElementById('apellido2').getAttribute('data-value');
            document.getElementById('emailCliente').value = document.getElementById('emailCliente').getAttribute('data-value');
            document.getElementById('telefonoCliente').value =document.getElementById('telefonoCliente').getAttribute('data-value');
            document.getElementById('dniCliente').value = document.getElementById('dniCliente').getAttribute('data-value');
    }

    function updateDireccionHotel() {
        const select = document.getElementById('hotelDestino');
        const direccionInput = document.getElementById('direccionHotel');
        const idHotelInput = document.getElementById('summaryHotelId');
        
        // Obtener la opción seleccionada
        const selectedOption = select.options[select.selectedIndex];
        
        // Obtener el atributo `data-direccion` de la opción seleccionada
        const direccion = selectedOption.getAttribute('data-direccion');
        const idHotel = selectedOption.getAttribute('data-id');
        
        // Establecer la dirección en el campo de texto
        direccionInput.value = direccion || '';
        idHotelInput.value = idHotel || '';
    }

    //Resetear el modal stepper cada vez que se cierra
    document.getElementById('addReservaModal').addEventListener('show.bs.modal', resetStepper);
    
    document.addEventListener('DOMContentLoaded', function () {
        const vistaPanelLink = document.getElementById('vistaPanelLink');
        if (vistaPanelLink) {
            vistaPanelLink.addEventListener('click', function (e) {
                loadView('views.php'); 
            });
        }
        const vistaPanelLink2 = document.getElementById('vistaPanelLink2');
        if (vistaPanelLink2) {
            vistaPanelLink2.addEventListener('click', function (e) {
                loadView('views.php'); 
            });
        }
        
    });

    $(document).ready(function () {
        $(".gestionTransferBtn").click(function () {
            loadTransfers();
        })
    });

    function actualizarVisibilidadTrayecto() {
        const tipoTrayectoSelect = document.querySelector('.tipoTrayecto');
    
        if (tipoTrayectoSelect) {

            function updateTrayectoVisibility() {
                const tipoTrayecto = tipoTrayectoSelect.value;
    

                const datosIda = document.getElementById('datosIda');
                const datosVuelta = document.getElementById('datosVuelta');
    
                if (datosIda && datosVuelta) {
                    if (tipoTrayecto === 'ida') {
                        datosIda.style.display = 'block';
                        datosVuelta.style.display = 'none';
                    } else if (tipoTrayecto === 'vuelta') {
                        datosIda.style.display = 'none';
                        datosVuelta.style.display = 'block';
                    } else if (tipoTrayecto === 'ida_vuelta') {
                        datosIda.style.display = 'block';
                        datosVuelta.style.display = 'block';
                    }
                } else {
                    console.error("Los elementos 'datosIda' y/o 'datosVuelta' no existen en el DOM.");
                }
            }

            updateTrayectoVisibility();
    
            tipoTrayectoSelect.addEventListener('change', updateTrayectoVisibility);
        } else {
            console.error("El select 'tipoTrayecto' no se encuentra en el DOM.");
        }
    }
