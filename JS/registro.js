function mostrarPassword(){
    var cambio = document.getElementById("password");
    if(cambio.type == "password"){
        cambio.type = "text";
        $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    }else{
        cambio.type = "password";
        $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
} 
$(document).ready(function () {
    document.getElementById("show_password").style.display='none';
    document.getElementById("password").addEventListener('keyup',function (){
        if (this.value.length > 0) {
            document.getElementById("show_password").style.display='inline-block';
        }else{
            document.getElementById("show_password").style.display='none';
        }
    });
    document.getElementById("formRegistro").addEventListener("submit",(e)=>{
        e.preventDefault();
        registar();
    });
});

function registar(){
    let 
    nombre=document.getElementsByName("nombre")[0].value,
    apellido=document.getElementsByName("apellido")[0].value,
    mail=document.getElementsByName("email")[0].value,
    pass=document.getElementsByName("pass")[0].value;
    if (nombre.length > 1 && apellido.length > 1 && mail.length > 5 && pass.length > 5) {
        var formData = new FormData(document.getElementById("formRegistro"));
        $.ajax({
            type: "POST",
            url: "../Registro/registrar.php",
            data: formData,
            processData: false,
            contentType: false
        }).fail(function() {
            alert( "error" );
          }).done(function(data) {
              if (data == false) {
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Puede que un campo este incorrecto o el correo ya este registrado',
                    footer: ''
                    });
              }else{
                Swal.fire(
                    'Exito!',
                    '',
                    'success'
                  ).then(function() {
                    location.href =data;
                });
              }
          });
    }
};


