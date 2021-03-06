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
    <link rel="icon" href="../../src/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../../src/css/font-awesome">
    <link rel="stylesheet" href="../../../src/css/materialize">
    <link rel="stylesheet" href="../../../src/css/style">
    <link rel="stylesheet" href="../../../src/css/navbar">
  </head>
  <body>
    <header>
      <h2>Sistema de Información Web para la Gestión de Pacientes del Servicio Odontológico "Kléber Ramírez"</h2>
      <nav class="fill">
        <ul class="right">
          <li><a id="puesto">Gestión de Usuarios</a></li>
          <li><a href="../perfil">Gestionar Perfil del Paciente</a></li>
          <li><a href="../consulta">Registro de Consultas</a></li>
          <li><a href="../reporte">Emisión de Reportes</a></li>
          <li><a href="../datos">Gestión de Datos</a></li>
          <li><a href="../salir">Terminar Sesión</a></li>
        </ul>
      </nav>
    </header>
    <ul id="slide-out" class="sidenav">
      <li><a href="mostrar" class="tooltipped" data-position="right" data-tooltip="Muestra listado de usuarios registrados en el sistema"><i class="fa fa-lg fa-users"></i> Lista de Usuarios</a></li>
      <li><a href="eliminar" class="tooltipped" data-position="right" data-tooltip="Localiza un usuario y posibilita su eliminación"><i class="fa fa-lg fa-user-times"></i> Eliminar Usuario</a></li>
      <li><a href="actualizar" class="tooltipped" data-position="right" data-tooltip="Busca un usuario y permite realizar algún cambio de sus datos"><i class="fa fa-lg fa-user-secret"></i> Modificar Datos de Usuario</a></li>
      <li><a class="tooltipped" data-position="right" data-tooltip="Regresa al menú principal" style="cursor: pointer;" onclick="top.location.href = '../'"><i class="fa fa-lg fa-arrow-left"></i> Volver</a></li>
    </ul>
    <br><br>
    <?php
    
    function spar(int $b){
      if($b % 2 == 0)
        return true;
      else
        return false;
    }

    function lenner(string $a)
    {
      $sz = strlen($a); 
      $vector; 
      $cat; 
      $b;
      $i;
      $x;

      for($i=0; $i<$sz; $i++)
        $vector[$i]=ord($a[$i]);
      
      for($i=0; $i<$sz; $i++){
        $x=$vector[$i]; 
        if(spar($x-5))
          $vector[$i]-=5;            
        else
          $vector[$i]-=1;
      }

      for($i=0; $i<$sz; $i++){
        $b[$i]=chr($vector[$i]);
        $cadena .=$b[$i];
      }

      return $cadena;
    }
    //Conexión a la BD
    include '../../../src/php/enlace.php';
    // parámetros de conexión
    $enlace = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $enlace->set_charset('utf8');
    
    //Consulta la tabla:
    $usuarios = $enlace->query("SELECT usuario,cedula,nivel FROM trabajador");
    
    //Crear la tabla de HTML en la que se muestran los datos:
    ?>
    <div class="row">
      <fieldset class="campo-morado">
        <a data-target="slide-out" class="sidenav-trigger">
          <h5 class="blanco"><img class="tooltipped menui" src="../../../src/img/menusu.png" data-position="bottom" data-tooltip="Muestra el menú lateral izquierdo"> Lista de usuarios</h5>
        </a>
        <div class="row">
          <div class="col s4 center" style="color: white; font-size: .8rem;">Usuario</div>
          <div class="col s4 center" style="color: white; font-size: .8rem;">Cédula</div>
          <div class="col s4 center" style="color: white; font-size: .8rem;">Tipo de usuario</div>
        </div><?php while($u = $usuarios->fetch_assoc()){ ?>
        <div class="col s4 center blanco"><?php echo lenner($u['usuario']); ?></div>
        <div class="col s4 center blanco"><?php echo $u['cedula']; ?></div>
        <div class="col s4 center blanco"><?php
          if($u['nivel']=='oo')
          $u['nivel']='Odontólogo';
          if($u['nivel']=='ae')
          $u['nivel']='Asístente';
        echo $u['nivel']; ?></div>
        <?php } ?>
      </fieldset>
      <?php mysqli_close($enlace);?>
    </div>
    <script  src="../../../src/js/jquery-3.js"></script>
    <script  src="../../../src/js/materialize.js"></script>
    <script  src="../../../src/js/main.js"></script>
  </body>
</html>
<?php
}
else
{
// Usuario que no se ha logueado
echo "<div class='alert alert-danger' role='alert' style='text-align: center; margin-top: 5%;'>No tienes permiso para:<br><br> <strong>Acceder a esta página</strong><br><br><br><div align='center'><img height='210' width='180' src='http://odontologia.uptm/SIWGO/src/img/saltos.gif'></div><strong>Por favor espere un momento mientras <br>redireccionamos el url.</strong></div>";
header('Refresh: 5; http://odontologia.uptm/SIWGO'); //redirect
}
?>