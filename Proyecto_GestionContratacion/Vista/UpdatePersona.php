<?php
require "../Controlador/SecretariaController.php";
require "../Controlador/PersonaController.php";
if(isset($_SESSION['verificar'])&&$_SESSION['verificar']==true)
{
    if(($_SESSION['DataPersona']["Cargo"])=="General"|| ($_SESSION['DataPersona']["Cargo"])=="Administrador" ){

    }else{
        header("Location: 403.html");
    }

}else
{   $_SESSION['error']=true;
    header("Location: login.php");

}?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Ver Personas</title>

    <meta name="description" content="Free Admin Template Based On Twitter Bootstrap 3.x">
    <meta name="author" content="">

    <meta name="msapplication-TileColor" content="#5bc0de" />
    <meta name="msapplication-TileImage" content="assets/img/metis-tile.png" />

    <!-- Bootstrap -->
    <link rel="icon" href="assets/img/icono.png">
    <link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/lib/font-awesome/css/font-awesome.css">

    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="assets/css/main.css">

    <!-- metisMenu stylesheet -->
    <link rel="stylesheet" href="assets/lib/metismenu/metisMenu.css">

    <!-- onoffcanvas stylesheet -->
    <link rel="stylesheet" href="assets/lib/onoffcanvas/onoffcanvas.css">

    <!-- animate.css stylesheet -->
    <!--link rel="stylesheet" href="assets/lib/animate.css/animate.css">
     <link rel="stylesheet" href="/assets/lib/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css">
    <link rel="stylesheet" href="/assets/lib/jquery.gritter/css/jquery.gritter.css">-->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/Uniform.js/2.1.2/themes/default/css/uniform.default.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/validationEngine.jquery.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--For Development Only. Not required -->
    <script>
        less = {
            env: "development",
            relativeUrls: false,
            rootpath: "/assets/"
        };
    </script>


    <link rel="stylesheet" href="assets/css/style-switcher.css">
    <link rel="stylesheet/less" type="text/css" href="assets/less/theme.less">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/less.js/2.7.1/less.js"></script>

</head>

        <body class="  ">
            <div class="bg-dark dk" id="wrap">
                <?php require("snippers/MenuSuperior.php");?>
                <!-- /#top -->
                <?php require ("snippers/MenuIzquierdo.php");?>
                    <!-- /#left -->
                 <div id="content">
                    <div class="outer">
                        <div class="inner bg-light lter">
                            <style>
                                .form-control.col-lg-6 {
                                    width: 50% !important;
                                }

                            </style>
                                <div class="row">
                        <div class="col-lg-12">
                            <div class="box">
                                <header class="dark">
                                    <div class="icons"><i class="fa glyphicon-user"></i></div>
                                    <h5>Ver Persona</h5>
                                    <!-- .toolbar -->
                                    <div class="toolbar">
                                        <nav style="padding: 8px;">
                                            <a href="javascript:;" class="btn btn-default btn-xs collapse-box">
                                                <i class="fa fa-minus"></i>
                                            </a>
                                            <a href="javascript:;" class="btn btn-default btn-xs full-box">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                            <a href="javascript:;" class="btn btn-danger btn-xs close-box">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </nav>
                                    </div>            <!-- /.toolbar -->

                                </header>

                                <div id="collapse2" class="body">

                                    <?php if(!empty($_GET['respuesta'])){ ?>
                                        <?php if ($_GET['respuesta'] == "correcto"){ ?>
                                            <div class="alert alert-info" id="correcto" title="Registro Exitoso" >
                                              <a href="AdministrarPersona.php"  <p> <i class="glyphicon glyphicon-ok-sign"></i>
                                                    La Actualización se ha creado correctamente</p>
                                            </div>
                                        <?php }else {?>
                                            <div class="alert alert-danger" id="error" title="Registro Fallido!" >
                                                <p><i class="glyphicon glyphicon-remove-sign"></i>&nbsp;Error! La Actualización no se pudo crear correctamente intentalo nuevamente</p>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>

                                    <?php if(!empty($_GET["id"]) && isset($_GET["id"])){ ?>
                                    <?php
                                    $DataPersona = PersonaController::buscarID($_GET["id"]);

                                    ?>
                                    <form class="form-horizontal" id="popup-validation"  enctype="multipart/form-data" action="../Controlador/PersonaController.php?action=editar" method="POST">
                                        <?php
                                        $htmlSelect ="<h1> esta es la id'".$_GET["id"]."'</h1>"?>

                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Nombre</label>
                                             <div class="col-lg-4">

                                                 <input required id="Nombres" value="<?php echo $DataPersona->getNombres(); ?>" class="form-control col-md-7 col-xs-12" name="Nombres"  type="text">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Apellido</label>
                                            <div class="col-lg-4">
                                                <input type="text" placeholder="Apellidos" class="validate[required] form-control"  required name="Apellidos" id="Apellidos" value="<?php echo $DataPersona->getApellidos(); ?>" >
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Tipo Documento</label>
                                            <div class="col-lg-4">
                                                <select id="TipoDocumento" name="TipoDocumento" class="form-control">
                                                    <option value="">Seleccione</option>
                                                    <option value="C.C" <?php if($DataPersona->getTipoDocumento() == "C.C"){ echo "selected"; } ?>>Cedula Ciudadina</option>
                                                    <option value="R.C" <?php if($DataPersona->getTipoDocumento() == "T.I"){ echo "selected"; } ?>>Tarjeta Identidad</option>
                                                    <option value="R.C" <?php if($DataPersona->getTipoDocumento() == "R.C"){ echo "selected"; } ?>>Registro Civil</option>
                                                    <option value="C.E" <?php if($DataPersona->getTipoDocumento() == "C.E"){ echo "selected"; } ?>>Cedula Extranjera</option>
                                                    <option value="Otros    " <?php if($DataPersona->getTipoDocumento() == "Otros"){ echo "selected"; } ?>>Otros</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-lg-4">N° Documento</label>
                                            <div class=" col-lg-4">
                                                <input  placeholder="Documento " required class="validate[required] form-control" type="text" name="Documento" id="Documento" value="<?php echo $DataPersona->getDocumento(); ?>" >
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Fecha Nacimiento</label>
                                            <div class="col-lg-4">
                                            <input placeholder="Fecha_Nacimiento " required class="validate[required] form-control"  type="text" name="Fecha_Nacimiento" id="Fecha_Nacimiento" value="<?php echo $DataPersona->getFechaNacimiento(); ?>" >
                                        </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Género</label>
                                            <div class="col-lg-4">
                                                <input  placeholder="Genero " required class="validate[required] form-control"  name="Genero" id="Genero"    value="<?php echo $DataPersona->getGenero(); ?>" >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Teléfono</label>

                                            <div class=" col-lg-4">
                                                <input required placeholder="Telefono" class="validate[required,custom[number]] form-control" type="number" name="Telefono" id="Telefono"
                                                       value="<?php echo $DataPersona->getTelefono(); ?>" />
                                                <span class="help-block"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label  class="control-label col-lg-4">Dirección</label>
                                            <div class="col-lg-4">
                                                <input required type="text" placeholder="Direccion" class="validate[required] form-control" name="Direccion" id="Direccion"
                                                       value="<?php echo $DataPersona->getDireccion(); ?>" >
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-lg-4">E-mail</label>

                                            <div class=" col-lg-4">
                                                <input required placeholder="E-mail" class="validate[required,custom[email]] form-control" type="email" name="Correo"
                                                       id="Correo" value="<?php echo $DataPersona->getCorreo(); ?>" />
                                            </div>
                                        </div>

                                        <div  hidden   class="form-group">
                                            <label class="control-label col-lg-4">Usuario</label>
                                            <div class="col-lg-4">
                                                <input required placeholder="Usuario" type="text" class="validate[required] form-control" name="Usuario" id="Usuario"
                                                       value="<?php echo $DataPersona->getUsuario(); ?>" >

                                            </div>
                                        </div>
                                        <div hidden class="form-group">
                                            <label class="control-label col-lg-4">Contraseña</label>

                                            <div class=" col-lg-4">
                                                <input required placeholder="Contraseña"   value="<?php echo $DataPersona->getContrasena(); ?>"  class="validate[required] form-control" type="password" name="Contrasena" id="Contrasena"/>
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Número de Registro Profesional</label>

                                            <div class="col-lg-4">
                                                <input required placeholder="Numero Registro Profesional" class="validate[required,custom[number]] form-control" type="text"
                                                       name="NRP" id="NRP" value="<?php echo $DataPersona->getNRP(); ?>" />
                                                <span class="help-block"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Cargo</label>
                                            <div class="col-lg-4">
                                                <select id="Cargo" name="Cargo" class="form-control">
                                                    <option  <?php if($DataPersona->getCargo() == "Seleccione"){ echo "selected"; } ?>>Seleccione</option>
                                                    <option <?php if($DataPersona->getCargo() == "Administrador"){ echo "selected"; } ?>>Administrador</option>
                                                    <option <?php if($DataPersona->getCargo() == "Secretari@"){ echo "selected"; } ?>>Secretari@</option>
                                                    <option <?php if($DataPersona->getCargo() == "General"){ echo "selected"; } ?>>General</option>
                                                    <option <?php if($DataPersona->getCargo() == "Subgeneral"){ echo "selected"; } ?>>Subgeneral</option>
                                                </select>
                                        </div>
                                        </div>


                                        <?php if ($DataPersona->getCargo() != "Administrador"){ ?>
                                        <div class="form-group" name="idSecretarias" id="idSecretarias">
                                            <label class="control-label col-lg-4">Secretaría</label>
                                            <div class="col-lg-4">
                                                <?php echo SecretariaController::selectSecretaria(true,"form-group"); ?>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php if($_SESSION['DataPersona']['Cargo'] == "General" ){ ?>
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Contrato</label>
                                            <div class="col-lg-8">
                                                <input  type="file"  id="ContratoPDF" name="ContratoPDF" required accept="application/pdf" />

                                            </div>
                                        </div>
                                        <?php }?>
                                        <div  hidden class="form-group">
                                            <label class="control-label col-lg-4">Foto</label>
                                            <div class="col-lg-4">
                                                <input  type="text" value="<?php echo $DataPersona->getEstado(); ?>" id="Estado" name="Estado"  />
                                            </div>
                                        </div>

                                        <div  hidden class="form-group">
                                            <label class="control-label col-lg-4">Foto</label>
                                            <div class="col-lg-4">
                                                            <input  type="text" value="<?php echo $DataPersona->getFoto(); ?>" id="imagen" name="imagen"  />
                                            </div>
                                        </div>
                                        <div hidden  class="form-group">
                                            <label class="control-label col-lg-4">Foto</label>
                                            <div class="col-lg-4">
                                                <input  type="text" value="<?php echo $DataPersona->getIdPersona(); ?>" id="idPersona" name="idPersona"  />
                                            </div>
                                        </div>


                                        <div class="form-actions no-margin-bottom">
                                            <a href="AdministrarPersona.php" class="btn btn-info ">Cancelar</a>
                                            <button id="send" type="submit" class="btn btn-success" style="float: right">Enviar</button>
                                        </div>
                                    </form>
                                    <?php }else{ ?>
                                        <?php if (empty($_GET["respuesta"])){ ?>
                                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                                </button>
                                                <strong>Error!</strong> No se encontró ninguna Persona con el párametro de búsqueda.
                                                <!--       <//?php $htmlSelect = "";
                                                       $htmlSelect .="<h1> esta es la id'".$_GET["id"]."'</h1>"?>
                                                   --></div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                                </div>
                        <!-- /.inner -->
                            </div>
                     <!-- /.outer -->
                    </div>
                <!-- /#content -->


                <div id="right" class="onoffcanvas is-right is-fixed bg-light" aria-expanded=false>
                    <a class="onoffcanvas-toggler" href="#right" data-toggle=onoffcanvas aria-expanded=false></a>
                    <br>
                    <br>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Warning!</strong> Best check yo self, you're not looking too good.
                    </div>
                    <!-- .well well-small -->
                    <div class="well well-small dark">
                        <ul class="list-unstyled">
                            <li>Visitor <span class="inlinesparkline pull-right">1,4,4,7,5,9,10</span></li>
                            <li>Online Visitor <span class="dynamicsparkline pull-right">Loading..</span></li>
                            <li>Popularity <span class="dynamicbar pull-right">Loading..</span></li>
                            <li>New Users <span class="inlinebar pull-right">1,3,4,5,3,5</span></li>
                        </ul>
                    </div>
                    <!-- /.well well-small -->
                    <!-- .well well-small -->
                    <div class="well well-small dark">
                        <button class="btn btn-block">Default</button>
                        <button class="btn btn-primary btn-block">Primary</button>
                        <button class="btn btn-info btn-block">Info</button>
                        <button class="btn btn-success btn-block">Success</button>
                        <button class="btn btn-danger btn-block">Danger</button>
                        <button class="btn btn-warning btn-block">Warning</button>
                        <button class="btn btn-inverse btn-block">Inverse</button>
                        <button class="btn btn-metis-1 btn-block">btn-metis-1</button>
                        <button class="btn btn-metis-2 btn-block">btn-metis-2</button>
                        <button class="btn btn-metis-3 btn-block">btn-metis-3</button>
                        <button class="btn btn-metis-4 btn-block">btn-metis-4</button>
                        <button class="btn btn-metis-5 btn-block">btn-metis-5</button>
                        <button class="btn btn-metis-6 btn-block">btn-metis-6</button>
                    </div>
                    <!-- /.well well-small -->
                    <!-- .well well-small -->
                    <div class="well well-small dark">
                        <span>Default</span><span class="pull-right"><small>20%</small></span>

                        <div class="progress xs">
                            <div class="progress-bar progress-bar-info" style="width: 20%"></div>
                        </div>
                        <span>Success</span><span class="pull-right"><small>40%</small></span>

                        <div class="progress xs">
                            <div class="progress-bar progress-bar-success" style="width: 40%"></div>
                        </div>
                        <span>warning</span><span class="pull-right"><small>60%</small></span>

                        <div class="progress xs">
                            <div class="progress-bar progress-bar-warning" style="width: 60%"></div>
                        </div>
                        <span>Danger</span><span class="pull-right"><small>80%</small></span>

                        <div class="progress xs">
                            <div class="progress-bar progress-bar-danger" style="width: 80%"></div>
                        </div>
                    </div>
                </div>
                <!-- /#right -->

            </div>

            <!-- /#wrap -->
            <footer class="Footer bg-dark dker">
                <p>2017 &copy; SIC-Sistema Integrado de Contratacion. v1.0</p>
            </footer>
            <!-- /#footer -->
            <!-- #helpModal -->
            <div id="helpModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                                culpa qui officia deserunt mollit anim id est laborum.
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <!-- /.modal -->
            <!-- /#helpModal -->
            <!--jQuery -->
            <script src="assets/lib/jquery/jquery.js"></script>
            <script >

            </script>

                <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery.validationEngine.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/languages/jquery.validationEngine-en.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/holder/2.4.1/holder.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/Uniform.js/2.1.2/jquery.uniform.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
           <script src="assets/lib/bootstrap/js/bootstrap.js"></script>
            <!-- MetisMenu -->
            <script src="assets/lib/metismenu/metisMenu.js"></script>
            <!-- onoffcanvas -->
            <script src="assets/lib/onoffcanvas/onoffcanvas.js"></script>
            <!-- Screenfull -->
            <script src="assets/lib/screenfull/screenfull.js"></script>

            <!-- script src="/assets/lib/plupload/js/plupload.full.min.js"></script>
            <script src="/assets/lib/plupload/js/jquery.plupload.queue/jquery.plupload.queue.min.js"></script>
            <script src="/assets/lib/jquery.gritter/js/jquery.gritter.min.js"></script>
            <script src="/assets/lib/formwizard/js/jquery.form.wizard.js"></script> -->
                <script src="assets/lib/jquery-validation/jquery.validate.js"></script>

            <!-- Metis core scripts -->
            <script src="assets/js/core.js"></script>

            <!-- Metis demo scripts -->
                <script src="assets/js/app.js"></script>
                <script>
                    $(function() {
                        Metis.formValidation();
                    });
                </script>

                <script src="assets/js/style-switcher.js"></script>

            <script src="assets/lib/jquery/jquery.js"></script>
            <script>
                $(function() {
                    Metis.formWizard();
                });
            </script>



            <script >

            </script>

        </body>

</html>
