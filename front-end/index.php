<?php


$ch = curl_init();

$url = "http://localhost/hospital/Apirest_jaime/get_all_medico.php";


curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);


if ($response === false) {

  echo "Error en la solicitud cURL: " . curl_error($ch);
} else {

  $response = json_decode($response, true);

}

curl_close($ch);


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <style>
    /* Agregar estilos CSS personalizados aquí */
    .navbar {
      background-color: #15e8e8 !important;
      border-color:#6411f2!important;
    }

    .navbar-brand {
      color: black !important;
      font-weight: bold;
    }

    .container {
      margin-top: 25px;
    }

    .table-info th {
      background-color: #24db0f !important;
      color: white;
    }

    .table-info td {
      background-color: #f8f9fa !important;
    }

    .modal-header {
      background-color: #f8f9fa !important;
      border-bottom: none !important;
    }

    .modal-title {
      color:#030303 !important;
    }

    .form-control {
      border-color:#f2f211 !important;
    }

    .btn-outline-danger {
      color:#0f0e0e;
      border-color: #41f505;
    }

    .btn-outline-danger:hover {
      color: #fff;
      background-color: #0d05f5;
      border-color: #41f505;
    }
  </style>
  <title>hospital</title>
</head>

<body>
  <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">hospital</a>
    </div>
  </nav>

  <div class="container">
    <div class=" mt-5">
      <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#medico"
        id="agregarMedico">
        <i class="fas fa-plus me-1"></i> Agregar médico
      </button>
    </div>
    <div class="contenedor">
      <h1 class="mb-4">hospital</h1>
      <div class="table-responsive">
        <table id="tabla-conteiner" class="table table-bordered table-hover">
          <thead>
            <tr class="table-info">
              <th class="sorting">id</th>
              <th class="sorting" style="width: 150px;">Nombre</th>
              <th class="sorting" style="width: 200px;">Especialidad</th>
              <th class="sorting" style="width: 150px;">Telefono</th>
              <th class="sorting" style="width: 150px;">Email</th>
              <th class="sorting">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($response as $key => $medico) {
              echo '<tr>
                                <td>' . $medico['id'] . '</td>
                                <td>' . $medico['nombre'] . '</td>
                                <td>' . $medico['especialidad'] . '</td>
                                <td>' . $medico['telefono'] . '</td>
                                <td>' . $medico['email'] . '</td>
                                <td>
                                    <button type="button" class="btn btn-warning btnEditar" data-id="' . $medico['id'] . '" data-bs-toggle="modal" data-bs-target="#medico">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btnEliminar" data-id="' . $medico['id'] . '" data-bs-toggle="modal" data-bs-target="#modalEliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <input type="text" id="id-medico" hidden>

  <div class="modal fade" id="medico" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h5 class="modal-title mx-auto font-weight-bold h2">Registrar medico</h5>
          
        </div>

        <form id="nuevo_form">
          <div class="modal-body">
            <div class="container-fluid">
              <div class="form-group mb-2">
                <label for="nombre">
                <i class="far fa-plus-square me-1"></i> Agregar medico
                </label>
                <input type="text" name="nombre" id="nombre" class="form-control"
                  placeholder="Nombre del medico">
              </div>
              <div class="form-group mb-2">
                <label for="especialidad">
                <i class="far fa-edit"></i> Especialidad
                </label>
                <input type="text" name="especialidad" id="especialidad" class="form-control" placeholder="Especialidad">
              </div>
              <div class="form-group mb-2">
                <label for="telefono">
                <i class="fas fa-phone"></i> Teléfono
                </label>
                <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Telefono">
              </div>
              <div class="form-group mb-2">
                <label for="email">
                <i class="fas fa-envelope"></i> Email
                </label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Email">
              </div>
            </div>
          </div>
          <div class="modal-footer mb-2">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="fas fa-times mr-3"></i>Cancelar
            </button>
            <button type="button" class="btn btn-success" id="guardarMedico">
              <i class="fas fa-save mr-3"></i>Guardar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Deseas eliminar este medico?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <button type="button" class="btn btn-primary" id="btnEliminarMedico">Si</button>
        </div>
      </div>
    </div>
  </div>


  <script src="./jquery.js"> </script>
  <script src="./script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/16d70f32b6.js" crossorigin="anonymous"></script>

</body>

</html>
