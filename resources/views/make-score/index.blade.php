<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Registrar Pontos - Burrific</title>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js'></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css' integrity='sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==' crossorigin='anonymous' referrerpolicy='no-referrer' />
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN' crossorigin='anonymous'>
    <style>
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
  <nav class='navbar navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body'>
  <div class='container-fluid'>
    <a class='navbar-brand' href='index.php'>Burrific</a>
    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
      <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse' id='navbarSuportContent'>
      <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
        <li class='nav-item'>
          <a class='nav-link' aria-current='page' href="{{ route('dashboard') }}">Home</a>
        </li>
          
        <li class='nav-item'>
          <a class='nav-link' aria-current='page' href="{{ route('cadastrarParticipantesPage') }}">Cadastrar Participante</a>
        </li>
          
        <li class='nav-item'>
          <a class='nav-link active' aria-current='page' href="{{ route('registrarPontosPage') }}">Registrar Pontos</a>
        </li>
      </ul>
    </div>
    </div>
  </nav>
    <div class="form-div">
      <form id="form-registraponto" action="process-registrarPontos.php" method="POST">
      {{ csrf_field() }}
        <div class="md-3">
          <label for="selectParticipante" class="form-label">Participante:</label>
          <select class="form-select" id="select-participante" name="id-participante" aria-label="Participantes do Burrific" required></select>
        </div>
        <br/>
        <div class="md-3">
          <label for="points-toIncrease" class="form-label">Pontos a adicionar:</label>
          <input type="number" id="qty-points" name="qty-points" min="1" max="500" required>
        </div>
        <br/>
        <div class="input-group md-3">
          <span class="input-group-text">Descrição</span>
          <textarea id="form-description" name="form-description" class="form-descricao" aria-label="Descrição" rows="4" cols="100" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function () {

        $.ajax({
          url: '/get-participants',
          type: 'GET',
          dataType: 'json',
          success: function(data){
            var select = $('#select-participante');
            //esvaziar todo o select
            //select.empty();

            select.append('<option value="">Selecione um participante</option>');
            $.each(data, function(index, item){
              select.append('<option value="'+item.id+'">'+item.nome+'</option>')
            });
          },
          error: function () {
            console.error('Failed to retrieve data');
          }
        });

        document.getElementById("qty-points").defaultValue = "1";

        $('#form-registraponto').submit(function(event) {
          event.preventDefault();

          let formData = new FormData(this);

          if($('#qty-points').val() <= 0 ){
            Swal.fire({
              title: 'Pontuação inválida',
              text: 'Campo de vlaor numérico só pode ser maior que zero',
              icon: 'error',
            });

            return false;
          }

          $.ajax({
            url: '/points-register',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
              swal.fire({
                title: 'Registrado',
                text: response.msg,
                icon: 'success'
              });

              setTimeout(location.href = "{{ route('dashboard') }}", 7000);
            },
            error: function(jqXHR, textStatus, errorThrown){
              console.error(textStatus, errorThrown);
              Swal.fire({
                title: textStatus,
                text: errorThrown,
                icon: 'error',
              });
            }
          });
        });
      });
    </script>
  </body>
</html>