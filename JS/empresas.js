document.getElementById("btn_sesion_c").addEventListener('click',()=>{
    $.post( "../Conexion/cerrar_sesion.php", 
    function(data) {location.href =data;})
    .fail(function() {alert( "error" );});
});

var photodropdown=$('#dropdownc');
if(photodropdown[0]){
	photodropdown.on("click", function(e) {
		var menuItem = $(e.currentTarget);
		var dropdownMenu=$('#dropdownc ~ .dropdown-menu');
		if (menuItem.attr("aria-expanded") == 'true') {
			$(this).attr("aria-expanded", false);
			dropdownMenu.addClass('outmenu');
			setTimeout(function() {
				dropdownMenu.removeClass('show outmenu');
			}, 200);
		} else {
			 $(this).attr("aria-expanded", true);
			 dropdownMenu.addClass('show inmenu');
			 setTimeout(function() {
				dropdownMenu.removeClass('inmenu');
			}, 200);
		}
		return false;
	});
}
document.addEventListener("click",()=>{
	if($('#dropdownc').attr("aria-expanded")){
		$('#dropdownc').attr("aria-expanded",false);
		$('#dropdownc ~ .dropdown-menu').addClass('outmenu');
		setTimeout(function() {
			$('#dropdownc ~ .dropdown-menu').removeClass('show outmenu');
		}, 200);
	}
});

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
	'use strict'
  
	// Fetch all the forms we want to apply custom Bootstrap validation styles to
	var forms = document.querySelectorAll('.needs-validation')
  
	// Loop over them and prevent submission
	Array.prototype.slice.call(forms)
	  .forEach(function (form) {
		form.addEventListener('submit', function (event) {
		  if (!form.checkValidity()) {
			event.preventDefault()
			event.stopPropagation()
		  }
  
		  form.classList.add('was-validated')
		}, false)
	  })
  })()

$(document).ready(function () {
	$('#CheckShowPass').click(function () {
	  if ($('#CheckShowPass').is(':checked')) {
		$('#passuni').attr('type', 'text');
	  } else {
		$('#passuni').attr('type', 'password');
	  }
	});
	eventFormAdd();
	// eventFormShare();
	eventFormJoin();
});

// GUARDAR EMPRESA
function eventFormAdd(){
	$("#formaddemp").submit((e)=>{
        e.preventDefault();
		if ($('input[name="addnombre"]').val().length > 2 && $('input[name="addfile"]').val().length > 1) {
			var formData = new FormData(document.getElementById("formaddemp"));
			$.ajax({
				type: "POST",
				url: "../Empresas/crear.php",
				data: formData,
				processData: false,
				contentType: false
			}).fail(function() {
				alert( "error" );
			}).done(function(data) {
				 console.log(data);
				switch (data) {
					case 'true':
						Swal.fire(
							'Exito!',
							'',
							'success'
						  ).then(function() {
							location.reload();
						});
						break;
					
					case 'count':
						Swal.fire(
							'Espera...',
							'Esta empresa ya fue registrada anterior mente',
							'warning'
						  );
						break;
					case 'false':
						Swal.fire(
							'UPS...',
							'¡Algo salió mal!',
							'error'
						  );
						break;
				
					default:
						break;
				}
			});
		}
    });
}
// EditModal
$('#ModalEdit').on('show.bs.modal', function modalEdit (event) {
	var button = $(event.relatedTarget); 
	var recipient = button.data('whatever'); 
	var modal = $(this);
	modal.find('.modal-title').text(recipient);
	var empresa=$('#ModalEdit').find('#ModalEditLabel').text();

	$.get("../Empresas/contenido.php",{nombre:empresa},function( data ) {
		modal.find('.modal-body').html(data);
		valores();
	});

});



function valores() {
	$('#ModalEdit').find('a[href="#ModalCode"]').click(()=>{
		$('input[name="contracom"]').prop("disabled",true);
		var empresa=$('#ModalEdit').find('#ModalEditLabel').text();
		$.post("../Empresas/compartir.php", { nombre: empresa})
			.done(function( data ) {
				var array = JSON.parse(data);
				switch (array['accion']) {
					case "consulta":
						$('#ModalCode .modal-body #codelabel').text(array['codigo']);
						$('#ModalCode input[name="contracom"]').val(array['contra']);
						if (array['acceso']=="1") {
							$('#ModalCode #switchCheckAccess').prop( "checked", true);
						}else{
							$('#ModalCode #switchCheckAccess').prop( "checked", false);
						}
						break;
					default:
						break;
				}
			}).fail(function() {
				console.log( "error" );
		});
		
	});
}

$('#contracom').click(function () {
	campo=$('input[name="contracom"]');
	if (campo.prop("disabled")) {
		campo.prop("disabled",false);
		campo.attr('type', 'text');
		
	}else{
		campo.prop("disabled",true);
		campo.attr('type', 'password');
	}
});

$('#formCompartir').change(function() {
	var codigo=$('#ModalCode .modal-body #codelabel').text(),
	p=$('#ModalCode input[name="contracom"]').val(),
	a=$('#ModalCode #switchCheckAccess').prop( "checked");
			
	$.post("../Empresas/compartir.php", { acceso: a, clave: p, editar: codigo})
		.done(function( data ) {
		}).fail(function() {
			console.log( "error" );
	});

});


//Unirse a una empresa
function eventFormJoin() {
	$('#formJoin').submit(function( event ) {
		event.preventDefault();
		var cam= $('#Code').val(),
		pas= $('#passuni').val();
		if (cam.length > 6) {
			$.post("../Empresas/unirse.php", { cod: cam, pass: pas})
			.done(function( data ) {
				// console.log(data);
				switch (data) {
					case 'success':
						Swal.fire(
							'Exito!',
							'',
							'success'
						  ).then(function() {
							location.reload();
						});
						break;

					case 'error':
						Swal.fire(
							'UPS...',
							'¡Algo salió mal!',
							'error'
						  );
						break;
					
					case 'op2':
						Swal.fire(
							'',
							'¡Ya eres parte de esta empresa!',
							'info'
						  );
						break;

					case 'op3':
						Swal.fire(
							'',
							'¡No tienes permiso de acceso!',
							'warning'
						  );
						break;
					default:
						break;
				}
			}).fail(function() {
				console.log( "error" );
			});
		}
	});
}

function refrescarModalEdit() {
	var empresa=$('#ModalEdit').find('#ModalEditLabel').text();
	$.get("../Empresas/contenido.php",{nombre:empresa},function( data ) {
		$('#ModalEdit').find('.modal-body').html(data);
		valores();
	});
}






function hacerAdmin(param1,param2) {
	$.post("../Empresas/acciones.php",{key:"a1st",valores:JSON.stringify({ x: param1, y: param2 })},function( data ) {
		var res=JSON.parse(data);
		Swal.fire({
			title: 'Hacer admin. a '+res['nombre'],
			text: res['correo'],
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText:'Cancelar',
			confirmButtonText: 'Hacer admin.'
		}).then((result) => {
			if (result.isConfirmed) {
				$.post("../Empresas/acciones.php",{key:"cdsk",valores:JSON.stringify({ x: param1, y: param2 })},function( data ){
					if (JSON.parse(data)['success']==1) {
						Swal.fire(
							'Hecho!',
							'',
							'success'
						).then(function() {
							refrescarModalEdit();
							
						});
					}
				});
			}
		  })
	});
}
function eliminar_u(param1,param2) {
	$.post("../Empresas/acciones.php",{key:"a1st",valores:JSON.stringify({ x: param1, y: param2 })},function( data ) {
		var res=JSON.parse(data);
		Swal.fire({
			title: 'Eliminar a '+res['nombre'],
			text: res['correo'],
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText:'Cancelar',
			confirmButtonText: 'Eliminar'
		}).then((result) => {
			if (result.isConfirmed) {
				$.post("../Empresas/acciones.php",{key:"xsa1s",valores:JSON.stringify({ x: param1, y: param2 })},function( data ){
					if (JSON.parse(data)['success']==1) {
						Swal.fire(
							'Hecho!',
							'',
							'success'
						).then(function() {
							refrescarModalEdit();
							
						});
					}
				});
			}
		  })
	});
}

function eliminar_adm(param1,param2,param3) {
	$.post("../Empresas/acciones.php",{key:"cds2",valores:JSON.stringify({ x: param1, y: param2 })},function( data ){
		if (JSON.parse(data)['numAdmi']==1) {
			Swal.fire({
				title: 'Salir de la empresa',
				text: 'Eres el único Administrador, si sales sacara a los demás, nombra admirador a alguien más.',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				cancelButtonText:'Cancelar',
				confirmButtonText: 'Salir'
			}).then((result) => {
				if (result.isConfirmed){
					$.post("../Empresas/acciones.php",{key:"al2f",valores:JSON.stringify({ x: param1, y: param2 })},function( data ){
						if (JSON.parse(data)['success']==1) {
							Swal.fire(
								'Hecho!',
								'',
								'success'
							).then(function() {
								location.reload();
							});
						}
					});
				}
			});
		}else{
			$.post("../Empresas/acciones.php",{key:"a1st",valores:JSON.stringify({ x: param1, y: param2 })},function( data ) {
				var res=JSON.parse(data);
				tit='Eliminar a '+res['nombre'];
				tex=res['correo'];
				if (param3 == true) {
					tit='Salir de la empresa';
					tex="";
				}
				Swal.fire({
					title:tit ,
					text: tex,
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					cancelButtonText:'Cancelar',
					confirmButtonText: 'Eliminar'
				}).then((result) => {
					if (result.isConfirmed) {
						$.post("../Empresas/acciones.php",{key:"xsa1s",valores:JSON.stringify({ x: param1, y: param2 })},function( data ){
							if (JSON.parse(data)['success']==1) {
								Swal.fire(
									'Hecho!',
									'',
									'success'
								).then(function() {
									refrescarModalEdit();
								});
							}
						});
					}
				});
			});
		}
	});
}


function noadmin(param1,param2,param3) {
	$.post("../Empresas/acciones.php",{key:"cds2",valores:JSON.stringify({ x: param1, y: param2 })},function( data ){
		if (JSON.parse(data)['numAdmi']==1) {
			Swal.fire({
				title: 'Dejar de ser administrador.',
				text: 'Eres el único Administrador, nombra admirador a alguien más.',
				icon: 'info'
			});
		}else{
			$.post("../Empresas/acciones.php",{key:"a1st",valores:JSON.stringify({ x: param1, y: param2 })},function( data ) {
				var res=JSON.parse(data);
				tit='Descartar a '+res['nombre']+' como admin.';
				tex=res['correo'];
				if (param3 == true) {
					tit='Dejar de ser administrador';
					tex="";
				}
				Swal.fire({
					title:tit ,
					text: tex,
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					cancelButtonText:'Cancelar',
					confirmButtonText: 'Descartar'
				}).then((result) => {
					if (result.isConfirmed) {
						$.post("../Empresas/acciones.php",{key:"jnjs2",valores:JSON.stringify({ x: param1, y: param2 })},function( data ){
							if (JSON.parse(data)['success']==1) {
								Swal.fire(
									'Hecho!',
									'',
									'success'
								).then(function() {
									refrescarModalEdit();
								});
							}
						});
					}
				});
			});
		}
	});
}

function redireccion(param) {
	if (param.target != $('.card .socials i[data-bs-toggle="modal"]')[0]) {
		$.get("../Empresas/test.php",{ name: $('.card .main-text').text(), time: $('.card .img2 img').attr('alt') },function (data) {
			window.location = '../Inicio/index.php?empresa='+data;
		});	
	}
}

function verpass(id,campo) {
	$("#"+id+' > i').toggleClass("fa-eye fa-eye-slash");
	var input = $("#"+campo);
	input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password');
}

$('#miperfil').on('show.bs.modal', ()=> {
	$.get( "../Empresas/actualizar.php", {o:'consulta'},function( data ) {
		array=JSON.parse(data);
		$('#miperfil_name').val(array['name']);
		$('#miperfil_lastname').val(array['lastname']);
	});
});

$('#form_miperfil').submit(function( event ) {
	if ($('#miperfil_name').val().length > 1 && $('#miperfil_lastname').val().length > 1 ) {
		$.get( "../Empresas/actualizar.php", {o:'up_nombre', n:$('#miperfil_name').val(),l:$('#miperfil_lastname').val()},function( data ) {
			array=JSON.parse(data);
			if (array['update']) {
				Swal.fire(
					'Exito!',
					'',
					'success'
				).then(function() {
					location.reload();
				});
			}else{
				Swal.fire(
					'UPS...',
					'¡Algo salió mal!',
					'error'
				);
			}
		});
	}
	event.preventDefault();
});

$('#form_cambContra').submit(function( event ) {
	
	
	if ($('#cambio_pass_actual').val().length > 5 && $('#cambio_pass_rep').val() == $('#cambio_pass_nueva').val() && $('#cambio_pass_nueva').val().length >5 ) {
		$.get( "../Empresas/actualizar.php", {o:'up_pass', p:$('#cambio_pass_actual').val(),r:$('#cambio_pass_nueva').val()},function( data ) {
			array=JSON.parse(data);
			if (array['update']) {
				Swal.fire(
					'Exito!',
					'',
					'success'
				).then(function() {
					location.reload();
				});
			}else{
				Swal.fire(
					'UPS...',
					'¡Algo es incorrecto!',
					'error'
				);
			}
		});
	}
	event.preventDefault();
});