function initDatepicker() {

    $('#fechaRango').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD', // Formato de fecha
            applyLabel: 'Aplicar', // Etiqueta del botón de aplicar
            cancelLabel: 'Cancelar', // Etiqueta del botón de cancelar
            customRangeLabel: 'Seleccionar rango', // Etiqueta para el rango personalizado
        },
        startDate: moment().startOf('month'), // Fecha de inicio: primer día del mes actual
        endDate: moment().endOf('month'), // Fecha de fin: último día del mes actual
        minDate: moment().subtract(1, 'years'), // Fecha mínima (1 año atrás)
        maxDate: moment().add(1, 'years'), // Fecha máxima (1 año adelante)
        showDropdowns: true, // Mostrar los dropdowns de mes y año
        opens: 'up',
        autoApply: true, // Aplicar automáticamente cuando se selecciona el rango
        ranges: {
            'Hoy': [moment(), moment()],
            'Este mes': [moment().startOf('month'), moment().endOf('month')],
            'Últimos 30 días': [moment().subtract(30, 'days'), moment()],
            'Este año': [moment().startOf('year'), moment().endOf('year')]
        },
        alwaysShowCalendars: true, // Mostrar siempre los calendarios
        showWeekNumbers: false, // No mostrar números de semana
        timePicker: false, // No usar selección de hora
        singleDatePicker: false, // Hacer que sea un rango de fechas
        autoUpdateInput: true, // Actualizar el valor del input automáticamente
    }, function(start, end, label) {
        
        $('#fechaRango').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
    });
}


function validateFilters() {
    let valid = true;

    document.querySelectorAll('.form-select').forEach(input => {
        input.classList.remove('is-invalid');
        const errorMessage = input.parentNode.querySelector('.error-message');
        if (errorMessage) errorMessage.remove();
    });

     // Validar hotel (select)
     const hotelFilter = document.getElementById('hotelFilter');
     if (!hotelFilter.value || hotelFilter.value === "") { // Verifica si no se seleccionó una opción válida
         valid = false;
         hotelFilter.classList.add('is-invalid');
         showError(hotelFilter.parentNode, "Debe seleccionar un hotel.");
     }

     // Validar fecha (select o campo de fecha)
     const monthFilter = document.getElementById('fechaRango');
     if (!monthFilter.value || monthFilter.value === "") { // Verifica si no se seleccionó una opción válida
         valid = false;
         monthFilter.classList.add('is-invalid');
         showError(monthFilter.parentNode, "Debe seleccionar una fecha.");
     }

    return valid;
}

// Función para mostrar el mensaje de error
function showError(parentNode, message) {
    const errorDiv = document.createElement('div');
    errorDiv.classList.add('error-message');
    errorDiv.classList.add('text-danger');
    errorDiv.textContent = message;
    parentNode.appendChild(errorDiv);
}

function callbackLoadFilters() 
{
    $("#dynamicContent .filtrarBtn").off().click(function () {
        
        const idHotel = $('#hotelFilter option:selected').attr('data-id');
        const fecha = $('#fechaRango').val();
        loadFilters(idHotel, fecha); 
    });
}

function loadPrecios() {
    
    $.post("../class/controller/preciosCtrl.php", {controller: "preciosCtrl", action: "loadPrecios"}, function (data) {
        
        try {
            var d = JSON.parse(data);

            if (!d.error) {
                $('#dynamicContent').html(d.out);
                $('#fechaRango').datepicker('destroy');
                initDatepicker();
                callbackLoadFilters();

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

function loadFilters(idHotel, fecha) {
    if (!validateFilters()) {
        return; // Detener si la validación falla
    }

    $.post("../class/controller/preciosCtrl.php", {controller: "preciosCtrl", action: "filterHotel", idHotel:idHotel, fecha:fecha}, function (data) {
        
        try {
            var d = JSON.parse(data);

            if (!d.error) {
                $('#dynamicFilter').html(d.out);
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


$(document).ready(function () {
    // Asignar evento al botón perfil (cuando se hace clic en cargar perfil)
    $(".preciosBtn").on("click", function (e) {
        e.preventDefault();
        loadPrecios();
    });

})