<?php
    //include('variables.php');
    //extract($_GET);
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Empaquetador 1.0 (Beta)</title>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <link rel="icon" type="image/png" href="img/favicon.png" />
    
    
    <script type="text/javascript">
        $(document).ready(function(){
            $('input[type=file]').change(function () {
                console.log(this.files[0].mozFullPath);
            });
            $("#ayuda").modal("show");
        });
    </script>
</head>

<body>
    <section class="container">
        <div class="row cabecera">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 logotipos">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <img class="logo logo_iyc img-responsive" src="img/iyc.png" alt="Logo IyC" />
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <img class="logo logo_scorm img-responsive" src="img/scormLMS.png" alt="Logo Scorm" />
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <img class="logo logo_moodle img-responsive" src="img/logomoodle.png" alt="Logo Moodle" />
                    </div>
                </div>
        </div>
    </section>

    <section class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 formulario">
                <form method="GET" action="php/funciones.php" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <span class="nombre_input col-xs-12 col-sm-3 col-md-2 col-lg-2">Fuentes: </span><input type="text" name="directorio_fuentes" placeholder="Introduce el directorio de las fuentes" class="col-xs-12 col-sm-9 col-md-10 col-lg-10" />
                    <span class="nombre_input col-xs-12 col-sm-3 col-md-2 col-lg-2">Paginación: </span><input type="text" name="directorio_paginacion" placeholder="Introduce el directorio de la paginación" class="col-xs-12 col-sm-9 col-md-10 col-lg-10"  />
                    <input type="submit" value="Empaquetar" class="boton btn-danger btn-lg center-block" />
                </form>
            </div>
        </div>
    </section>
    
    <button data-toggle="modal" href="#ayuda" type="button" class="btn btn-default btn_ayuda">
        <span class="glyphicon glyphicon-question-sign ayuda"></span>
    </button>
    
    
    
<div class="modal fade" id="ayuda" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Instrucciones de uso</h3>
     </div>
         <div class="modal-body">
            <h4>Para utilizar el empaquetador &nbsp;&nbsp;<span class="glyphicon glyphicon-bell" style="color:#f89a2f"></span></h4>
            <ul>
                <li>Tanto las fuentes a empaquetar como la paginación correspondiente a dicho manual, deben estar ubicadas en distintas carpetas dentro del mismo servidor en el que se encuentra ubicada esta página. Preguntar a Ángel o Andrés el servidor al que subir las carpetas. </li>
                <li>Las carpetas donde se almacene la carpeta de paginación debe tener permisos <strong>777</strong></li>
                <li>Las rutas se tienen que asemejar a la siguiente: <strong>"/var/www/empaquetador/fuentes/uf0000"</strong>. Si la ruta no existe o no es válida no se podrá continuar.</li>
                <li>Es <strong>muy importante</strong> que dentro de la carpeta de fuentes <strong>únicamente</strong> se encuentren los archivos pertenecientes a las maquetación, y dentro de la carpeta de paginación <strong>únicamente</strong> se deben encontrar las carpetas pertenecientes a cada tema, cada una con sus htmls, <strong>sin ningún otro archivo</strong>. Si esto no se cumple, fallará el empaquetado o los archivos zip resultantes no serán correctos, pudiendo provocar errores inesperados.</li>
                <li>Si existen archivos .zip (SCORM) dentro de la carpeta paginación, el empaquetador <strong>no</strong> sustituirá estos archivos, e incluso es posible que al no poder sobreescribirlos se eliminen archivos pertenecientes al empaquetador, por lo que es necesario asegurarse antes de empezar el proceso de empaquetado. Si esto pasa avisar a José María.</li>
                <li>Cuando se hayan insertado las rutas correctamente y se pulse sobre empaquetar, se mostrará un <strong>listado</strong> con todo el contenido de las fuentes, así como los htmls de paginación que corresponden a cada uno de los temas.</li>
                <li>Los <strong>errores de maquetación</strong> pueden provocar <strong>desastres inesperados</strong>, por lo que hay que revisar bien el indice de contenidos que se genera tras el empaquetado, y comprobar que es correcto. (Por ejemplo, títulos de capítulos repetidos se deben a un mal etiquetado de los apartados)</li>
                <li>Si no se ha mostrado ningún fallo y se han pintado <strong>ambas listas</strong> y el título del manual, todo el proceso se habrá realizado correctamente y los <strong>paquetes SCORM</strong> se habrán creado en la misma <strong>carpeta de paginación</strong>, desde donde tendremos que descargarlos, junto con un <strong>archivo .txt</strong> con la tabla de contenidos de dicho manual, para realizar comprobaciones.</li>
                <li>Una vez que se haya realizado el empaquetado correctamente, <strong>es importante eliminar las carpetas de las fuentes y de paginación del servidor</strong>, para poder reutilizar la ubicación y para que no ocupe almacenamiento.</li>
                <li>En el caso de que no se pinte la lista entera, o pinte a mitad, sin indicar errores de ningún tipo, seguramente se deba a fallos en la maquetación de las fuentes (divs abiertas, clases incompletas, faltan elementos, etc).</li>
                <li>Si se quiere empaquetar desde <strong>carpetas locales</strong>, existe una versión del empaquetador preparada para utilizarse desde un servidor local bajo sistema operativo de Windows. En tal caso preguntar a José María.</li>
                <li>Las tareas de evaluación presenciales serán recogidas como "Sesiones presenciales", ya que no hay forma de distintguir éstos htmls del resto, por lo que habrá que tener especial cuidado en renombrar estas sesiones presenciales en "Tareas de evaluación (presencial)" en el campus.</li>
             </ul>
     </div>
         <div class="modal-footer">
        <a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
     </div>
      </div>
   </div>
</div>
        
    <script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
