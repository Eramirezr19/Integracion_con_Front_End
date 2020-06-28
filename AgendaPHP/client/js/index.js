$(function(){
  var l = new Login();
})


class Login {
  constructor() {
    this.submitEvent()
  }

  submitEvent(){
    $('form').submit((event)=>{
      event.preventDefault()
      this.sendForm()
    })
  }

  sendForm(){
    let form_data = this.loginUser();
    $.ajax({
      url: '../server/check_login.php',
      dataType: "json",
      cache: false,
      processData: false,
      contentType: false,
      data: form_data,
      type: 'POST',
      success: function(php_response){
        console.log("se recibe respuesta exitosa");
        console.log(Object.values(php_response)[1]);
        console.log(php_response);
       if (Object.values(php_response)[1] == "concedido") {
        window.location.href = 'main.html';
        }else {
          alert(Object.values(php_response)[1]);
        }
      },
      error: function(){
        alert("error en la comunicación con el servidor");
      }
    })
  }

  loginUser() {
    let form_data = new FormData();
    form_data.append('email', $('#user').val());
    form_data.append('psw', $('#password').val());
    return form_data;
  }
}
