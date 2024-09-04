<html>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Cadastrar Novo Participante - Burrific</title>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js'></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css' integrity='sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==' crossorigin='anonymous' referrerpolicy='no-referrer' />
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN' crossorigin='anonymous'>
    <style>

      .form-div{
        width: 60% !important;
        padding-top: 2%;
        padding-left: 2%;
      }

      table, th, td{
        border: 1px solid black;
      }

      .table{
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
    <script>
      function excluir(id){
          $.ajax({
            type: "DELETE",
            url: `/excluir-registro-participante?id=${id}&_token={{csrf_token()}}`,
            //headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(result){
              location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown){
              console.log('Erro na requisição DELETE:' + errorThrown);
              Swal.fire({
                title: textStatus.toUpperCase(),
                text: jqXHR.responseJSON.msg,
                icon: 'error',
              });
            }
          });
        }

        function editar(id){
          //location.href = "{{ route('editParticipantPage') }}";
        }
    </script>
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
            <a class='nav-link' aria-current='page' href="{{ route('registrarPontosPage') }}">Registrar Pontos</a>
          </li>
        </ul>
      </div>
      </div>
    </nav>
    <div class="global-layout">
      <div class='head-card'>
        <div>
          <h2>
            <span class="id-label">#</span>
            <span id="id-variable" class="id-variable"></span>
            <span class="nome-label"> - Nome: </span>
            <i><span id="nombre-variable" class="nome-variable"></span></i>
          </h2>
          <br/>
            <span class="pontos-label">Total de pontos: </span>
            <span id="points-variable" class="pontos-variable"></span>
          <br/><br/>
        </div>
      </div>
      <div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Editar</th>
              <th scope="col">Data</th>
              <th scope="col">Descrição</th>
              <th scope="col">Excluir?</th>
            </tr>
          </thead>
          <tbody id="body-main-table">
            
          </tbody>
        </table>
      </div>
    <div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function() {
        const urlParams = new URLSearchParams(window.location.search);
        const getValue = urlParams.get('id');

        if(getValue === null){
          window.location = '/view404';
        }
        
        $.ajax({
          url: '/get-acoes?id='+getValue,
          type: 'GET', 
          dataType: 'json',
          async: false,
          success: function(data){
            document.title = `Participante: ${data[0].nome}`;

            let spanId = document.getElementById('id-variable')
            if(spanId){
              let texto = document.createTextNode(data[0].id);
              spanId.appendChild(texto)
            }

            let spanNome = document.getElementById('nombre-variable')
            if(spanNome){
              let texto = document.createTextNode(data[0].nome)
              spanNome.appendChild(texto)
            }

            let bodyTable = $('#body-main-table');

            $.each(data, function(index, item){
              bodyTable.append(`<tr>
                                <td><center><i class="fa-solid fa-highlighter" id="botaoEditar" onClick="edit(${data[index].burriceId})"></i></center></td>
                                <td>${data[index].data_ocorrido}</td>
                                <td>${data[index].descricao}</td>
                                <td><center><i class="fa-solid fa-trash buttonHover" id="botaoExcluir" onClick='excluir(${data[index].burriceId})'></i></center></td>
                                </tr>`);
            })
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.error('Failed to retrieve data: ' + errorThrown);
            Swal.fire({
              title: textStatus.toUpperCase(),
              text: jqXHR.responseJSON.msg,
              icon: 'error',
            });
          }
        });

        $.ajax({
          url: './pontos-participante?id='+getValue,
          type: 'GET', 
          dataType: 'json',
          async: true,
          success: function(data){
            var spanPontos = document.getElementById('points-variable')
            if(spanPontos){
              let texto = document.createTextNode(data[0].pontos);
              spanPontos.appendChild(texto);
            }
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.error('Failed to retrieve data: ' + errorThrown);
            Swal.fire({
              title: textStatus.toUpperCase(),
              text: jqXHR.responseJSON.msg,
              icon: 'error',
            });
          }
        });
      });
      
    </script>
  </body>
</html>