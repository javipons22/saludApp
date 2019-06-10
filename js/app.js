jQuery(document).ready(function ($) {
    (function () {
        $('.menu-wrapper').on('click', function () {
            $('.hamburger-menu').toggleClass('animate');
            $('.navbar').slideToggle();
        })
    })();
    // El plugin de jquery "datetimepicker" nos permite elegir las horas disponibles de turnos ( en el array allow times)
    $.datetimepicker.setLocale('es');
    // usamos la app para tiempo aca y para fecha en el otro , el id selecciona el input en page_turnos.php
    $('#timepicker').datetimepicker({
        datepicker: false,
        format: 'H:i',
        allowTimes: [
            '12:00', '13:00', '15:00',
            '17:00', '19:00', '20:00'
        ]
    });

    $('#datepicker').datetimepicker({
        timepicker: false,
        format: 'd/m/Y',
        minDate: 0 // para que la fecha minima sea hoy
    });

});
