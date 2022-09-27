$(document).ready(function () {
    eventosExtras(); 
});

function eventosExtras() {
    document.getElementById("btn_sesion_c").addEventListener('click',()=>{
        $.post( "../Conexion/cerrar_sesion.php",function(data) {location.href =data;})
        .fail(function() {alert( "error" );});
    });

    if ($("#Sidebar-Menu").width() > 100) {
      $('#pushmenuleft').click();
      $('#sidebar-overlay').click();
    }

}

function contenido(esto,param) {
    $('#Sidebar-Menu a.active').removeClass("active");
    if (esto == 'introduccion') {
        $('#content').load('../Inicio/html/introduccion.html');
    }
    if (esto == 'Interpretacion_1') {
        $('#content').load('../Inicio/html/interpretacion_1.html');
    }
    if (esto == 'Interpretacion_2') {
        $('#content').load('../Inicio/html/interpretacion_2.html');
    }
    if (esto == 'Interpretacion_3') {
        $('#content').load('../Inicio/html/interpretacion_3.html');
    }
    if (esto == 'Interpretacion_4') {
        $('#content').load('../Inicio/html/interpretacion_4.html');
    }
    
    if (esto == 'mapeo_1') {
        $('#content').load('../Inicio/html/mapeo_1.html');
    }
    if (esto == 'mapeo_2') {
        $('#content').load('../Inicio/html/mapeo_2.html');
    }
    if (esto == 'mapeo_3') {
        $('#content').load('../Inicio/html/mapeo_3.html');
    }
    if (esto == 'mapeo_4') {
        $('#content').load('../Inicio/html/mapeo_4.html');
    }





    if (esto == 'auditores') {
        $('#content').load('../Inicio/html/auditores.html');
    }
    $(param).find("a").toggleClass("active");
    $('#sidebar-overlay').click();
    $('#content').focus();
}

var documento_height=$(document).height();
$(document).scroll(function() { 
    scroll_pos = $(this).scrollTop();
    if((documento_height)/3 < scroll_pos){
        $("#draggable").removeClass('draggable_static').addClass('draggable_movil');
        draggable_metodo('enable');
    }
    if (scroll_pos==0) {
        $("#draggable").removeClass('draggable_movil').addClass('draggable_static');
        draggable_metodo('disable');
    }
});
function draggable_metodo(opcion){
    switch (opcion) {
        case 'enable':
            $("#draggable").css("top","80px");
            $("#draggable").css("left","auto");

            $("#draggable").css("right","0");
            $(function() {
                $("#draggable").draggable({ 
                    disabled: false,
                    containment: $('#content')
                });
            });
            
            break;
        case 'disable':
            $("#draggable").css("top","0");
            $("#draggable").css("left","0");
            $(function() {
                $("#draggable").draggable({ 
                    disabled: true
                });
            });

            break;
    }
}

