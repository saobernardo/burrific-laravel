<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Cadastrar Novo Participante - Burrific</title>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js'></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css' integrity='sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==' crossorigin='anonymous' referrerpolicy='no-referrer' />
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN' crossorigin='anonymous'>
    <style>
      #myChart{
        width: 65% !important;
        height: 600px !important;
        float: center;
        padding-top: 50px;
      }

      #myChart2{
        width: 50% !important;
        height: 600px !important;
        float: left;
        padding-top: 50px;
        padding-left: 2%;
      }

      .charts{
        border-radius: 3px;
        border-width: 2px;
      }

      .form-div{
        width: 60% !important;
        padding-top: 2%;
        padding-left: 2%;
      }

      table, th, td{
        border: 1px solid black;
      }

      .tble{
        width: 40%;
        float: right;
        padding-top: 50px;
        padding-right: 2%;
      }

      .global-layout{
        width: 80%;
        margin-left: 10%;
        margin-top: 1%;
        padding-left: 1% !important;
        padding-right: 2%;
        border: 1px solid grey;
        border-radius: 4px;
      }

      .buttonHover{
        cursor: pointer;
      }

    </style>
  </head>
<body>
<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
      <a class='navbar-brand' href="{{ route('dashboard') }}">Burrific</a>
      <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
      </button>
      <div class='collapse navbar-collapse' id='navbarSupportedContent'>
        <ul class='navbar-nav mr-auto'>
          <li class='nav-item active'>
            <a class='nav-link' aria-current='page' href="{{ route('dashboard') }}">Home</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Participantes
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('cadastrarParticipantesPage') }}">Cadastrar Participante</a>
              <a class="dropdown-item" href="#">Participantes</a>
            </div>
          </li>
          <li class='nav-item'>
            <a class="nav-link" aria-current="page" href="{{ route('registrarPontosPage') }}">Registrar Pontos</a>
          </li>
        </ul>
        <!--<form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar participante</button>
        </form>-->
      </div>
    </nav>
    <div class="form-div">
      <form id="form-cadastro" action="{{ route('newParticipant') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="mb-3">
          <label for="inputNome" class="form-label">Nome Completo</label>
          <input type="text" class="form-control" id="inputNome" name="inputNome" required>
        </div>
        <div class="mb-3">
          <label for="inputDepartamento" class="form-label">Departamento</label>
          <select class="form-select" id="idDepartamento" name="idDepartamento" aria-label="Departamentos da empresa" required></select>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function() {
        $.ajax({
          url: "/get-departments",
          type: 'GET',
          dataType: 'json',
          success: async function(data){
            let select = $('#idDepartamento');

            select.append('<option value = "">Selecione um departamento</option>')
            $.each(data, function(index, item){
              
              select.append(`<option value='${item.id}'>${item.descricao}</option>`)
            });
          },
          error: function(jqXHR, textStatus, errorThrown){
            console.error('Failed to retrieve data: ' + errorThrown);
            Swal.fire({
              title: textStatus.toUpperCase(),
              text: jqXHR.responseJSON.msg,
              icon: 'error',
            });
          }
        });

        $('#form-cadastro').submit(function(event){
          event.preventDefault();

          let formData = new FormData(this);

          $.ajax({
            url: "/new-participant",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
              swal.fire({
                title: 'Inscrito',
                text: response.msg,
                icon: 'success'
              });

              setTimeout(location.href = "{{ route('dashboard') }}", 7000);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle errors here
                console.error('Failed to retrieve data: ' + errorThrown);
                Swal.fire({
                  title: textStatus.toUpperCase(),
                  text: jqXHR.responseJSON.msg,
                  icon: 'error',
                });
            }
          });
        });
      })
    </script>
</body>
</html>
