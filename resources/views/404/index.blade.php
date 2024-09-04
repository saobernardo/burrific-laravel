<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Página não encontrada - Burrific</title>
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
  </head>"
  <body>
    <div>
    <nav class='navbar navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body'>
    <div class='container-fluid'>
      <a class='navbar-brand' href="{{route('dashboard')}}">Burrific</a>
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
            <a class='nav-link active' aria-current='page' href="{{ route('registrarPontosPage') }}">Registrar Pontos</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>
    </div>
    <div>
      <img src="https://a-z-animals.com/media/2022/02/ox.jpg" />
    </div>
  </body>
</html>