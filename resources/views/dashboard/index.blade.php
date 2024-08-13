<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Dashboard - Burrific</title>
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

      .nav-item{
        padding: 0 15px;
      }

    </style>
  </head>
  <body>
    <div>
    <nav class='navbar navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body'>
  <div class='container-fluid'>
    <a class='navbar-brand' href="{{ route('dashboard') }}">Burrific</a>
    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
      <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse' id='navbarSuportContent'>
      <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
        <li class='nav-item'>
          <a class='nav-link' aria-current='page' href="{{ route('dashboard') }}">Home</a>
        </li>
          
        <li class='nav-item'>
          <a class='nav-link active' aria-current='page' href="{{ route('cadastrarParticipantesPage') }}">Cadastrar Participante</a>
        </li>
          
        <li class='nav-item'>
          <a class="nav-link active" aria-current="page" href="{{ route('registrarPontosPage') }}">Registrar Pontos</a>
        </li>
      </ul>
    </div>
    </div>
  </nav>
</div>
    <div class="charts">
      <center>
        <canvas id="myChart"></canvas>
      </center>
    </div>
    <!--<div class="charts">
      <canvas id="myChart2"></canvas>
    </div>-->
    <div class="tble">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Última burrice</th>
            <th scope="col">Pontos</th>
          </tr>
        </thead>
        <tbody id="body-main-table">
            
        </tbody>
      </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function() {
        const ctx = document.getElementById('myChart');
        const ctx2 = document.getElementById('myChart2');
        let names = [];
        let points = [];

        $.ajax({
          url: "/get-graphic-data",
          type: 'GET',
          dataType: 'json',
          success: async function(data){
            data.forEach(function (json, i) {
              names.push(json.nome)
              points.push(json.pontos)
            })

            new Chart(ctx, {
              type: 'bar',
              data: {
              labels: names,
              datasets: [{
                label: 'Pontos',
                data: points,
                borderWidth: 2
              }]
              },
              options:{
                scales:{
                  y:{
                    beginAtZero: true
                  }
                }
              }
            })

            new Chart(ctx2, {
              type: 'polarArea',
              data: {
              labels: names,
              datasets: [{
                label: 'Comparativo',
                data: points,
                borderWidth: 2
              }]
              },
              options:{
                scales:{
                  y:{
                    beginAtZero: true
                  }
                }
              }
            })
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.error('Failed to retrieve data: ' + errorThrown);
          }
        });

        $.ajax({
          url: "/get-last-burrices",
          type: 'GET',
          async: false,
          dataType: 'json',
          success: function(data){
            var bodyTable = $("#body-main-table");

            $.each(data, function(index, item){
              console.log(item)
              bodyTable.append(`<tr>
                                  <td>${item.id}</td>
                                  <td><a href='../resumo-participante/index.php?id=${item.id}' class='link-info link-offset-2'>${data[index].nome}</a></td>
                                  <td>${data[index].descricao}</td>
                                  <td>${data[index].pontos}</td>
                                </tr>`);
            });
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.error('Failed to retrieve data: ' + errorThrown);
          }
        });
      });
    </script>
  </body>
</html>