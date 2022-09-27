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
});

document.getElementById("form").addEventListener("submit",(e)=>{
    e.preventDefault();
    let mail=document.getElementById("email").value,pass=document.getElementById("password").value;
    if (mail.length > 5 && pass.length > 5) {
        var formData = new FormData(document.getElementById("form"));
        $.ajax({
            type: "POST",
            url: "../Login/validacion.php",
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
                    text: 'Algun campo esta incorrecto',
                    footer: ''
                    });
              }else{
                  location.href =data;
              }
          });
    }
});





