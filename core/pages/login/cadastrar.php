
<!-- Custom styling plus plugins -->
<link href="/assets/gentelella-master/production/css/custom.css" rel="stylesheet">
<link href="/assets/gentelella-master/production/css/icheck/flat/green.css" rel="stylesheet">
<!-- editor -->
<link href="/assets/gentelella-master/production/css/editor/external/google-code-prettify/prettify.css" rel="stylesheet">
<link href="/assets/gentelella-master/production/css/editor/index.css" rel="stylesheet">
<!-- select2 -->
<link href="/assets/gentelella-master/production/css/select/select2.min.css" rel="stylesheet">
<!-- switchery -->
<link rel="stylesheet" href="/assets/gentelella-master/production/css/switchery/switchery.min.css" />

<script src="js/jquery.min.js"></script>

<script src="../assets/js/ie8-responsive-file-warning.js"></script>
        
</head>

<body class="nav-md">

  <div class="container body">

    <div class="main_container">

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
        Seja bem vindo <b><?php echo $_SESSION[@usuario]; ?></b> a Tela de Cadastro de novo usuários.          
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                
                <div class="x_content">
                  <br />
                  <form method="POST" data-parsley-validate class="form-horizontal form-label-left">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Nome Completo <span class="required">*</span>
                      </label>
                        
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="nome" name="nome" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user">Usuário <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="user" name="user" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                      
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                      </label>
                        
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                      
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="senha">Senha <span class="required">*</span>
                      </label>
                        
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="senha" name="senha" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                      
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Cargo</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="cargo" name="cargo" class="form-control" required>
                                <option value="">Selecione..</option>
                                <option value="1">Estagiário</option>
                                <option value="2">Montador</option>
                                <option value="3">Técnico</option>
                                <option value="5">Gestor</option>
                                <option value="6">Staff</option>
                                <option value="7">Consulta</option>
                                <option value="8">Coordenador</option>
                                <option value="100">Administrador</option>
                            </select>
                        </div>
                    </div>
                      
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div id="gender" class="btn-group" data-toggle="buttons">
                          <label class="btn btn-primary active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                            <input type="radio" name="status" id="status" value="1" checked=""> Ativo
                          </label>
                          <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                            <input type="radio" name="status" id="status" value="0"> Inativo
                          </label>
                        </div>
                      </div>
                    </div>
                      
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="reset" name="reset" id="reset" class="btn btn-primary">Cancelar</button>
                          <button type="submit" name="submit" id="submit" class="btn btn-success">Cadastrar</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
      </div>
    </div>
  </div>
</body>
