document.addEventListener("DOMContentLoaded", function () {
  $("#guardarMedico").on("click", function () {
    let datos = {
      nombre: $("#nombre").val(),
      especialidad: $("#especialidad").val(),
      telefono: $("#telefono").val(),
      email: $("#email").val(),
    };
    if ($("#id-medico").val() === "") {
      crearMedico(datos);
    } else {
      datos.id = $("#id-medico").val();
      editarMedico(datos);
    }
  });

  $("#agregarMedico").on("click", function () {
    $("#id-medico").val("");
  });
  $(".btn-warning").on("click", function () {
    let idMedico = $(this).data("id");
    $("#id-medico").val(idMedico);
  });

  $(".btnEliminar").on("click", function () {
    let idMedico = $(this).data("id");
    $("#id-medico").val(idMedico);
  });

  $("#btnEliminarMedico").click(function () {
    let id = $("#id-medico").val();
    eliminar(id);
  });
});
//al abrir el modalverifica si hay un id valido si lo hay lo rellena para un actualizar
$("#medico").on("shown.bs.modal", function () {


  if ($("#id-medico").val() !== "") {
    $.ajax({
      type: "GET",
      url: "http://localhost/hospital/Apirest_jaime/get_id_medico.php",
      dataType: "JSON",
      data: { id: $("#id-medico").val() },
      success: function (respuesta) {
        $("#nombre").val(respuesta[0].nombre);
        $("#especialidad").val(respuesta[0].especialidad);
        $("#telefono").val(respuesta[0].telefono);
        $("#email").val(respuesta[0].email);
      },
      error: function (error) {
        // Manejar errores
        console.error("Error en la solicitud AJAX:", error);
        Swal.fire({
          title: "Error",
          text: "error:" + error,
          icon: "error",
        });
      },
    });
  }else{
    $("#nombre").val("");
        $("#especialidad").val("");
        $("#telefono").val("");
        $("#email").val("");
  }
  
});

function crearMedico(datos = {}) {
  let errores = false;

  for (let campo in datos) {
    if (datos[campo].trim() === "") {
      $("#" + campo)
        .removeClass("is-valid")
        .addClass("is-invalid");
      errores = true;
    } else {
      $("#" + campo)
        .removeClass("is-invalid")
        .addClass("is-valid");
    }
  }
  if (errores) {
    Swal.fire({
      title: "Error",
      text: "error: porfavor llene todos los campos",
      icon: "error",
    });
    return;
  }

  $.ajax({
    type: "POST",
    url: "http://localhost/hospital/Apirest_jaime/create_medico.php",
    data: datos,
    dataType: "json",
    success: function (respuesta) {
      $("#medico").modal("hide");

      $("#nombre").val(""),
        $("#especialidad").val(""),
        $("#telefono").val(""),
        $("#email").val(""),
        console.log(respuesta);
      Swal.fire({
        title: "Exito",
        text: respuesta.message,
        icon: "success",
        timer: 5000,
      }).then(() => {
        location.reload();
      });
    },
    error: function (error) {
      // Manejar errores
      console.error("Error en la solicitud AJAX:", error);
      Swal.fire({
        title: "Error",
        text: "error:" + error,
        icon: "error",
      });
    },
  });
}

function editarMedico(datos = {}) {
  let errores = false;

  for (let campo in datos) {
    if (datos[campo].trim() === "") {
      $("#" + campo)
        .removeClass("is-valid")
        .addClass("is-invalid");
      errores = true;
    } else {
      $("#" + campo)
        .removeClass("is-invalid")
        .addClass("is-valid");
    }
  }
  if (errores) {
    Swal.fire({
      title: "Error",
      text: "error: porfavor llene todos los campos",
      icon: "error",
    });
    return;
  }

  $.ajax({
    type: "PUT",
    url: "http://localhost/hospital/Apirest_jaime/update_medico.php",
    data: datos,
    dataType: "json",
    success: function (respuesta) {
      $("#medico").modal("hide");

      $("#nombre").val(""),
        $("#especialidad").val(""),
        $("#telefono").val(""),
        $("#email").val(""),
        console.log(respuesta);
      Swal.fire({
        title: "Exito",
        text: respuesta.message,
        icon: "success",
        timer: 5000,
      }).then(() => {
        location.reload();
      });
    },
    error: function (error) {
      // Manejar errores
      console.error("Error en la solicitud AJAX:", error);
      Swal.fire({
        title: "Error",
        text: "error:" + error,
        icon: "error",
      });
    },
  });
}

function eliminar(id) {
  console.log(id);
  $.ajax({
    type: "DELETE",
    url: "http://localhost/hospital/Apirest_jaime/delete_medico.php?id=" + id,
    dataType: "json",
    success: function (respuesta) {
      console.log(respuesta);
      $('modalEliminar').modal('hide')
      Swal.fire({
        title: "Exito",
        text: respuesta.message,
        icon: "success",
        timer: 5000,
      }).then(() => {
        location.reload();
      });
    },
    error: function (error) {
      // Manejar errores
      console.error("Error en la solicitud AJAX:", error);
      Swal.fire({
        title: "Error",
        text: "error: " + error.responseText, // Mostrar el texto de respuesta del error
        icon: "error",
      });
    },
    

  });
}
