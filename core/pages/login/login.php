

<!-- Custom styling plus plugins 
<link href="/assets/gentelella-master/production/css/custom.css" rel="stylesheet">
<link href="/assets/gentelella-master/production/css/icheck/flat/green.css" rel="stylesheet">
<!-- editor 
<link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
<link href="/assets/gentelella-master/production/css/editor/external/google-code-prettify/prettify.css" rel="stylesheet">
<link href="/assets/gentelella-master/production/css/editor/index.css" rel="stylesheet">
<!-- select2 
<link href="/assets/gentelella-master/production/css/select/select2.min.css" rel="stylesheet">
<!-- switchery
<link rel="stylesheet" href="/assets/gentelella-master/production/css/switchery/switchery.min.css" />

<div>
        <Center>
            <h1>
                <font face="verdana" size="5" color="blue">.::</font>
                <font face="verdana" size="5" color="">Bem vindo ao</font>
                <font face="verdana" size="5" color="red">SGA - Sistema de Gerenciamento de Apontamentos </font>
                <font face="verdana" size="5" color="blue">::.</font>
                <br><br>
                <font face="verdana" size="3" color="blue">Digite suas credenciais para acessar o banco de dados.</font>
            </h1>
        </center>
    </div>

<div class="x_panel">
        <form method="POST">
            <br>
                <table>
                    <tr>
                        <td width=2%><font>Usuário:</font></td>
                        <td><input name="user" type="text"/></td>
                    </tr>
                    <tr>
                        <td width=2%><font>Senha:</font></td>
                        <td><input name="password" type="password"/></td>
                    </tr>
                    <tr>
                        <td><a href="" ><img title="" alt="" src="/assets/imagens/chave.ico" /></a></td>
                        <td width=20%><input value="Acessar sistema" type="submit"/>
                            <br><br><a href="login/recuperarSenha">Redefinir senha</a>
                    </tr>
                </table>
        </form>
</div>
-->

<!DOCTYPE html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap core CSS -->

  <link href="/assets/gentelella-master/production/css/bootstrap.min.css" rel="stylesheet">

  <link href="/assets/gentelella-master/production/fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="/assets/gentelella-master/production/css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="/assets/gentelella-master/production/css/custom.css" rel="stylesheet">
  <link href="/assets/gentelella-master/production/css/icheck/flat/green.css" rel="stylesheet">


  <script src="js/jquery.min.js"></script>

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body style="background:#F7F7F7;">

  <div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>
    
    <h1>
        <center>.:: SGA - Sistema de Gerenciamento de Apontamentos ::.</center>
    </h1>
    
    <div id="wrapper">
      <div id="login" class="animate form">
        <section class="login_content">
          <form>
            <h1>Login</h1>
            <div>
              <input type="text" class="form-control" placeholder="Usuário" required="" />
            </div>
            <div>
              <input type="password" class="form-control" placeholder="Senha" required="" />
            </div>
            <div>
              <a class="btn btn-default submit" href="/">Acessar</a>
              <a href="#toregister" class="to_register"> Recuperar senha </a>
            </div>
            <div class="clearfix"></div>
            <div class="separator">

              
              <div class="clearfix"></div>
              <br />
              <div>
                <p>©2016 All Rights Reserved. Tárcio Lima e Maro Lopes</p>
              </div>
            </div>
          </form>
          <!-- form -->
        </section>
        <!-- content -->
      </div>
      <div id="register" class="animate form">
        <section class="login_content">
          <form>
            <h1>Recuperar Senha</h1>
            <div>
              <input type="text" class="form-control" placeholder="Usuário" required="" />
            </div>
            <div>
              <input type="email" class="form-control" placeholder="Email" required="" />
            </div>
            <div>
              <input type="password" class="form-control" placeholder="Nova Senha" required="" />
            </div>
            <div>
              <input type="password" class="form-control" placeholder="Redigite a senha" required="" />
            </div>
            <div>
              <a class="btn btn-default submit" href="/login">Resetar</a>
            </div>
            <div class="clearfix"></div>
            <div class="separator">

              <div class="clearfix"></div>
              <br />
              <div>
                <p>©2016 All Rights Reserved. Tárcio Lima e Maro Lopes</p>
              </div>
            </div>
          </form>
          <!-- form -->
        </section>
        <!-- content -->
      </div>
    </div>
  </div>

</body>

</html>
