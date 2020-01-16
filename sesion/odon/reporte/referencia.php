<?php
session_start();
if(isset($_SESSION['usuario']) && $_SESSION['nivel'] =='o'){
$fechaGuardada = $_SESSION["ultimoAcceso"];
$ahora = date("Y-n-j H:i:s");
$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
include '../../../src/php/enlace.php';
$enlace = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$enlace->set_charset('utf8');
if (!$enlace) die("Conexión fallida: " . mysqli_connect_error());
$result = mysqli_query($enlace, "SELECT max(id_sesion) as id FROM sesion WHERE usuario = '$_SESSION[usuario]'");
$row = mysqli_fetch_assoc($result);
$query = mysqli_query($enlace, "INSERT into registro_devisitas (id_sesion, enlace, tiempo) values('$row[id]','$_SERVER[PHP_SELF]','$ahora')");
//comparamos el tiempo transcurrido
if($tiempo_transcurrido < 0 || $tiempo_transcurrido > 599)
{
//si pasaron 10 minutos o más
$query = mysqli_query($enlace, "UPDATE sesion set fin ='$ahora', minutos=TIMESTAMPDIFF(MINUTE,inicio,fin) where id_sesion = '$row[id]' and usuario like '$_SESSION[usuario]'");
session_unset($_SESSION['usuario']);
session_unset($_SESSION['nivel']);
session_unset($_SESSION['trabajador']);
session_unset($_SESSION['ultimoAcceso']);
session_destroy();
header("Location:../../../",TRUE,301);
mysqli_close($enlace);
}
else
$_SESSION["ultimoAcceso"] = $ahora;?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../../src/css/font-awesome">
        <link rel="stylesheet" href="../../../src/css/materialize">
        <link rel="stylesheet" href="../../../src/css/style2">
        <link rel="stylesheet" href="../../../src/css/navbar">
        <style type="text/css">
        .gen{
        margin-left: 0% !important;
        }
        </style>
    </head>
    <body>
        <header>
      <h2>Sistema de Información Web para la Gestión de Pacientes del Servicio Odontológico "Kléber Ramírez"</h2>
      <nav class="fill">
        <ul class="right">
          <li><a href="../usuario">Gestión de Usuarios</a></li>
          <li><a href="../perfil">Gestionar Perfil del Paciente</a></li>
          <li><a href="../consulta">Registro de Consultas</a></li>
          <li><a id="puesto">Emisión de Reportes</a></li>
          <li><a href="../datos">Gestión de Datos</a></li>
          <li><a href="../salir">Terminar Sesión</a></li>
        </ul>
      </nav>
    </header>
        <ul id="slide-out" class="sidenav">
            <li><a href="historia" class="tooltipped" data-position="right" data-tooltip="Muestra todos los registros vinculados al paciente"><i class="fa fa-lg fa-book"></i> Historia Clínica</a></li>
            <li><a href="referencia" class="tooltipped" data-position="right" data-tooltip="Proporciona el elemento necesario para que el paciente sea referido hacia otro servicio"><i class="fa fa-lg fa-file-text"></i> Referencia Médica</a></li>
            <li><a href="constancia" class="tooltipped" data-position="right" data-tooltip="Facilita la certificación de constancia para uso del paciente"><i class="fa fa-lg fa-file-pdf-o"></i> Constancia</a></li>
            <li><a href="tratamiento" class="tooltipped" data-position="right" data-tooltip="Permite generarle al paciente su tratamiento"><i class="fa fa-lg fa-columns"></i> Tratamiento</a></li>
            <li><a href="estadistica" class="tooltipped" data-position="right" data-tooltip="Realiza consultas para proporcionar datos estadisticos confiables"><i class="fa fa-lg fa-line-chart"></i> Estadística</a></li>
            <li><a class="tooltipped" data-position="right" data-tooltip="Regresa al menú principal" style="cursor: pointer;" onclick="top.location.href = '../'"><i class="fa fa-lg fa-arrow-left"></i> Volver</a></li>
        </ul>
        <br><br>
        <div class="row">
            <form class="col s12" method="post" action="r3fe">
                <fieldset class="campo-morado">
                    <a data-target="slide-out" class="sidenav-trigger">
                        <h5 class="blanco"><img class="tooltipped menui" src="../../../src/img/menurep.png" data-position="bottom" data-tooltip="Muestra el menú lateral izquierdo"> Datos para la Referencia</h5>
                    </a>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="cedula" type="text" class="validate identificacion blanco" name="ci" autocomplete="off" required="">
                            <label for="cedula"> Número de cédula</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="destinatario" type="text" class="validate blanco" autocomplete="off" name="dr" value="_______________________________" required="">
                            <label for="destinatario">Destinatario</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="result" type="text" class="validate blanco" maxlength="30" autocomplete="off" onkeyup="this.value=Letras(this.value)" required="" readonly="">
                            <label for="result">Nombres</label>
                        </div>
                        <div class="input-field col s6">
                            <select id="tipo" class="browser-default" name="servicio">
                                <optgroup label="Servicio o Atención requerida">
                                    <option value="Odontología General">Odontología General</option>
                                    <option value="Endodoncia">Endodoncia</option>
                                    <option value="Odontología Estética">Odontología Estética</option>
                                    <option value="Cirugía">Cirugía</option>
                                    <option value="Rehabilitación Oral">Rehabilitación Oral</option>
                                    <option value="Implantología Oral">Implantología Oral</option>
                                    <option value="Periodoncia">Periodoncia</option>
                                    <option value="Ortodoncia">Ortodoncia</option>
                                    <option value="Cariología">Cariología</option>
                                    <option value="Gnatología">Gnatología</option>
                                    <option value="Patología Bucal">Patología Bucal</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="miespec" type="text" class="validate blanco" name="miespec" value="Odontología General" autocomplete="off" required="">
                            <label for="miespec"> Mi especialidad</label>
                        </div>
                        <div class="input-field col s6">
                            <p>
                                <label class="title">Sugerir exámenes</label>
                                <label>
                                    <input class="with-gap" name="re" type="radio" value="no" checked/>
                                    <span class="gen"> No </span>
                                </label>
                                <label>
                                    <input class="with-gap" name="re" type="radio" value="si" />
                                    <span class="gen">Si</span>
                                </label>
                            </p>
                        </div>
                    </div>
                    <div id="exam" class="row" hidden="">
                        <div class="input-field col s12">
                            <textarea id="examenes" class="materialize-textarea blanco" autocomplete='off' rows='2' name='exam' maxlength='150' onkeyup="this.value=Dir(this.value);"></textarea>
                            <label for="examenes">Exámenes que se sugieren</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="pdiag" class="materialize-textarea blanco" autocomplete='off' rows='2' name='pdiag' maxlength='150' onkeyup="this.value=Dir(this.value);"></textarea>
                            <label for="pdiag">Impresión diagnóstica</label>
                        </div>
                    </div>
                </fieldset>
                <input class="btn-azul in-right tooltipped" type="submit" disabled value="Emitir Referencia" data-position="left" data-tooltip="En formato de impresión">
                <input class="btn-azul in-left tooltipped" type="button" onclick="atend(); buscar(); verificar();"  value="Buscar" data-position="bottom" data-tooltip="Comprueba sí el paciente ya esta registrado y también si ha sido atendido">
                <input class="btn-gris in-left2 tooltipped" type="reset" onclick="desactivar(); hr();" value="Borrar Formulario" data-position="right" data-tooltip="Vacia todos los campos del formulario">
            </form>
        </div>
        <script  src="../../../src/js/jquery-3.js"></script>
        <script  src="../../../src/js/jquery-mask.js"></script>
        <script  src="../../../src/js/materialize.js"></script>
        <script  src="../../../src/js/main.js"></script>
        <script  src="../../../src/js/pac.js"></script>
        <script  src="../../../src/js/atendido.js"></script>
        <script  src="../../../src/js/referencia.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){
        $('input').each(function() {
        this.focus();
        });});
        </script>
    </body>
</html>
<?php
}
else
{
// Usuario que no se ha logueado
echo "<div class='alert alert-danger' role='alert' style='text-align: center; margin-top: 5%;'>No tienes permiso para:<br><br> <strong>Acceder a esta página</strong><br><br><br><div align='center'><img height='210' width='180' src='http://odontologia.uptm/SIWGO/src/img/saltos.gif'></div><strong>Por favor espere un momento mientras <br>redireccionamos el url.</strong></div>";
header('Refresh: 6; http://odontologia.uptm/SIWGO'); //redirect
}
?>