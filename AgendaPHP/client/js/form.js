$(function(){
  var l = new NewUser();
})


class NewUser {
  constructor() {
    this.submitEvent()
  }

  submitEvent(){
    $('form').submit((event)=>{
      event.preventDefault()
      console.log("el botón emite")
      this.checkContrasena()
    })
  }

  checkContrasena(){
    let contrasena = $('#password').val();
    let repContrasena = $('#contrasenaRepetida').val();

    if(contrasena === repContrasena){
      this.sendForm()
      console.log("contraseña correcta")
    }else{
      alert("La contraseña no coincide, intente nuevamente");
    }
  }



  sendForm(){
    let form_data = newUser();
    console.log("Se ejecuta función sendform")
    console.log(form_data)

    $.ajax({
      url: '../server/create_user.php',
      dataType: "json",
      cache: false,
      processData: false,
      contentType: false,
      data: form_data,
      type: 'POST',
      success: function(php_response){
        if (php_response.msg == "Se ha registrado exitosamente") {
          window.location.href = 'main.html';
        }else {
          alert(php_response.msg);
        }
      },
      error: function(){
        alert("error en la comunicación con el servidor");
      }
    })
  }
}
function newUser() {
  let form_data = new FormData();
  form_data.append('nombre', $('#nombre').val());
  form_data.append('apellido', $('#apellido').val());
  form_data.append('email', $('#email').val());
  form_data.append('psw', $('#password').val());
  form_data.append('fecha_nacimiento', $('#fechaNacimiento').val());
  return form_data;
}

