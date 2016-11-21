<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Empaquetador 1.0 (Beta)</title>
        <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css" />
        <link type="text/css" rel="stylesheet" href="../css/style.css" />
        <link rel="icon" type="image/png" href="../img/favicon.png" />
    </head>
    <body>

<?php 
    session_start();
    ob_start(); 
    error_reporting(E_ERROR);
    $ruta_fuentes = $_GET['directorio_fuentes'];
    $ruta_pagina = $_GET['directorio_paginacion'];
    $titulos_capitulos = array();
    $lista_contenidos_tema_ = array();
    $lista_htmls_tema_ = array();
    $titulo_global_manual;
    $capitulo = 0;
    $apartado = 0;
    $numeros_items = array();
    $ruta_final;
    $archivo_texto_contenido = fopen('indice_contenidos.txt','w');
    $nombre_archivo = array();

    /* Comprueba que las rutas son válidas */
    if($ruta_fuentes == '' || $ruta_pagina == '') {
        echo '<script text="text/javascript">
            alert("Debes introducir dos rutas válidas");
            document.location="../index.php";     
        </script>';
    } else {
        if (is_dir($ruta_fuentes) && is_dir($ruta_pagina)){
            lista_htmls($ruta_fuentes,$ruta_pagina);
        } else {
            echo '<script text="text/javascript">
                alert("Alguna de las rutas no es válida");
                document.location="../index.php";     
            </script>';
        }
    }

    /* Se hace un listado de los archivos html */
    function lista_htmls($f,$p) {
        global $titulos_capitulos;
        global $archivo_texto_contenido;
        // Pinta los html de fuentes
        $fuentes = opendir($f);
        $ficheros_fuentes = array();
        while (($leyendo = readdir($fuentes)) !== false) {
            if ($leyendo != "." && $leyendo != ".." && substr($leyendo,0,2)=="ap" ) {
                $ficheros_fuentes[] = $leyendo;
            }
        }
        sort($ficheros_fuentes);
        echo '<section class="container listados">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"><div class="listado_toc">';
        //echo '<h2>'.$f.'</h2>';
        echo '<h2 style="text-align:center">Fuentes</h2>';
        //fputs($archivo_texto_contenido, $f.chr(13).chr(10));
        echo '<ul>';
        for ($i=0; $i<count($ficheros_fuentes); $i++) {
            global $capitulo;
            global $apartado;
            global $lista_contenidos_tema_;
            global $lista_htmls_tema_;
            global $titulo_global_manual;
            // Preparo los htmls para ser leidos
            $contenido_html = file_get_contents($f.'/'.$ficheros_fuentes[$i]);
            $documento = new DOMDocument();
            $documento->loadHTML($contenido_html);
            $documento -> saveHTML();
            $documentopath = new DOMXPath($documento);
            $titulo_manual = $documentopath->query('//title');

            // Busco y recojo los htmls que pertenecen a tareas, actividades, o introducciones, y recojo su título
            $busca_las_tareas = array('21.html','22.html','23.html','24.html','25.html','26.html','27.html','28.html','29.html');
            $es_tarea = strposa($ficheros_fuentes[$i], $busca_las_tareas);
            $busca_introduccion = '0101.html';
            $es_introduccion = strpos($ficheros_fuentes[$i], $busca_introduccion);
            $titulo_tarea = $documentopath->query('//div[@class="show_tarea_evaluacion3"]');
            $titulo_actividad = $documentopath->query('//div[@class="show_actividad_evaluacion2"]');
            
            //Paso los títulos a strings
            foreach($titulo_tarea as $titulo_tareas){
                $titulo_tarea = strval($titulo_tareas->nodeValue);
            }
            foreach($titulo_actividad as $titulo_actividades){
                $titulo_actividad = strval($titulo_actividades->nodeValue);
            }
            
            // Recojo el número y la duración de cada tarea, y si son colaborativas
            if(is_string($titulo_tarea) && $es_tarea == true) {
                $numero_tarea = array($documentopath->query('//div[@class="show_tarea_evaluacion3"]/div[@class="orden_tarea_evaluacion"]'));
                /*if($documentopath->query('//div[@class="duracion_recurso"]') == true){
                    $duracion_tarea = $documentopath->query('//div[@class="duracion_recurso"]');    
                } else {
                    $duracion_tarea = '';
                }*/
                $duracion_tarea = array($documentopath->query('//div[@class="duracion_recurso"]'));
                $es_colaborativa = array($documentopath->query('//div[@class="show_tipo_tarea_evaluacion_colaborativa"]'));
                foreach($duracion_tarea as $duracion_tareas){
                    if ($duracion_tarea != ''){
                        $duracion_tarea = $duracion_tareas[0];        
                    }
                }
                foreach($es_colaborativa as $es_colaborativas){
                    if($es_colaborativa[0] != ''){
                        $es_colaborativa = $es_colaborativas[0];
                    }
                }
                foreach($numero_tarea as $numero_tareas){
                    if($numero_tarea[0] != ''){
                        $numero_tarea = $numero_tareas[0];
                    }
                }
                if(($duracion_tarea != '') && ($es_colaborativa != '')){
                    echo '<li>'.$ficheros_fuentes[$i].' = Tarea de evaluación '.strval($numero_tarea->nodeValue).' ('.strval($duracion_tarea->nodeValue).') (Colaborativa)</li>';
                    fputs($archivo_texto_contenido, $ficheros_fuentes[$i].' = Tarea de evaluación '.strval($numero_tarea->nodeValue).' ('.strval($duracion_tarea->nodeValue).') (Colaborativa)'.chr(13).chr(10));
                    // Guardo el contenido en array
                    $guardo_contenido = 'Tarea de evaluación '.strval($numero_tarea->nodeValue).' ('.strval($duracion_tarea->nodeValue).') (Colaborativa)';
                    $apartado++;
                    $lista_contenidos_tema_[$capitulo][$apartado] =  $guardo_contenido;
                }  else {
                    echo '<li>'.$ficheros_fuentes[$i].' = Tarea de evaluación '.strval($numero_tarea->nodeValue).' ('.strval($duracion_tarea->nodeValue).')</li>';
                    fputs($archivo_texto_contenido, $ficheros_fuentes[$i].' = Tarea de evaluación '.strval($numero_tarea->nodeValue).' ('.strval($duracion_tarea->nodeValue).')'.chr(13).chr(10));
                    // Guardo el contenido en array
                    $guardo_contenido = 'Tarea de evaluación '.strval($numero_tarea->nodeValue).' ('.strval($duracion_tarea->nodeValue).')';
                    $apartado++;
                    $lista_contenidos_tema_[$capitulo][$apartado] =  $guardo_contenido;
                };
            } 
            // Busco las Actividades de evaluación para distinguirlas de las tareas
            else if (is_string($titulo_actividad) && $es_tarea == true){
                $numero_actividad = array($documentopath->query('//div[@class="show_actividad_evaluacion2"]/div[@class="orden_actividad_evaluacion"]'));
                foreach($numero_actividad as $numero_actividades){
                    if($numero_actividad[0] != ''){
                        $numero_actividad = $numero_actividades[0];
                    }
                }
                echo '<li>'.$ficheros_fuentes[$i].' = Actividad de evaluación '.strval($numero_actividad->nodeValue).' </li>'; 
                fputs($archivo_texto_contenido, $ficheros_fuentes[$i].' = Actividad de evaluación '.strval($numero_actividad->nodeValue).chr(13).chr(10));
                // Guardo contenido en el array
                $guardo_contenido = 'Actividad de evaluación '.strval($numero_actividad->nodeValue).'';
                $apartado++;
                $lista_contenidos_tema_[$capitulo][$apartado] =  $guardo_contenido;
            }
            
            // Pinto el título de cada html si no son tareas, actividades o introducciones
            if (($titulo_html = $documentopath->query('//div[@class="show_nivel_1"]')) && ($es_tarea == false)){
                foreach($titulo_manual as $titulo_manuals){
                    $titulo_manual = strval($titulo_manuals->nodeValue);
                }
                $titulo_global_manual = $titulo_manual;
                $titulo_capitulo = $documentopath->query('//div[@class="texto_capitulo"]');
                foreach($titulo_capitulo as $titulo_capitulos){
                    $titulo_capitulo = strval($titulo_capitulos->nodeValue);
                }
                foreach($titulo_html as $titulo_htmls){
                    // Detecto la biografía y el glosario
                    $titulo_compara = strval($titulo_htmls->nodeValue);
                    if ($titulo_compara == "Bibliografía" || $titulo_compara == "Glosario") {
                        $nointro = 1;
                        $capitulo++;
                    } else {
                        $nointro = 0;
                    }
                    if ($es_introduccion == true && $nointro==0) {
                        array_push($titulos_capitulos, $titulo_capitulo);
                        echo '</ul><strong>'.$titulo_capitulo.'</strong><br><ul>';
                        fputs($archivo_texto_contenido, chr(13).chr(10).$titulo_capitulo.chr(13).chr(10));
                        echo '<li>'.$ficheros_fuentes[$i].' = Introducción</li>';
                        fputs($archivo_texto_contenido, $ficheros_fuentes[$i].' = Introducción'.chr(13).chr(10));
                        // Guardo el contenido en el array
                        $guardo_contenido = 'Introducción';
                        $capitulo++;
                        $apartado = 0;
                        $lista_contenidos_tema_[$capitulo][0] =  $guardo_contenido;
                        
                    } else if($es_introduccion == true && $nointro==1){
                        if ($titulo_compara == "Bibliografía") {
                            //$capitulo++;
                            $apartado = 0;
                            $lista_contenidos_tema_[$capitulo][$apartado] =  'Bibliografía';
                            array_push($titulos_capitulos, 'Bibliografía');
                            echo '</ul><ul><li><strong>Bibliografía</strong></li>';
                            fputs($archivo_texto_contenido, 'Bibliografía'.chr(13).chr(10));
                        } else if ($titulo_compara == "Glosario"){
                            //$capitulo++;
                            $lista_contenidos_tema_[$capitulo][$apartado] =  'Glosario';
                            $apartado = 0;
                            array_push($titulos_capitulos, 'Glosario');
                            echo '<li><strong>Glosario</strong></li>';
                            fputs($archivo_texto_contenido, 'Glosario'.chr(13).chr(10));
                        } else {
                            array_push($titulos_capitulos, '<h3>Falta Bibliografía o Glosario</h3>');
                        }
                    } else {
                        echo '<li>'.$ficheros_fuentes[$i].' = '.$titulo_htmls->nodeValue.'</li>';
                        fputs($archivo_texto_contenido, $ficheros_fuentes[$i].' = '.$titulo_htmls->nodeValue.chr(13).chr(10));
                        $guardo_contenido = ''.$titulo_htmls->nodeValue.'';
                        $apartado++;
                        $lista_contenidos_tema_[$capitulo][$apartado] =  $guardo_contenido;
                    }
                }
            }
        }
        echo '</ul>';
        
        /* Listado de htmls de paginación */
        
        fputs($archivo_texto_contenido, chr(13).chr(10).$titulo_manual.chr(13).chr(10));
        
        /* Pinta los html de paginación */
        echo '</div></div><div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"><div class=" listado_pagina">';
        //echo '<h2>'.$p.'</h2>';
        echo '<h2 style="text-align:center">Paginado</h2>';
        $pagina = opendir($p);
        $capit = 0;
        $orden_de_capitulos = array();
        $orden_apartados = array();
        global $lista_htmls_tema_;
        while (($leyendo_p = readdir($pagina)) !== false) {
            if ($leyendo_p != "." && $leyendo_p != "..") {
                //echo '<ul>';
                //echo "<strong>$leyendo_p</strong><br>";
                $numero_capitulo_para_html = intval(preg_replace('/[^0-9]+/', '', $leyendo_p), 10);;
                $capit++;
                $apartado = 0;
                $pagina_int = opendir($p."/".$leyendo_p);
                while (($leyendo_p2 = readdir($pagina_int)) !== false) {
                    if ($leyendo_p2 != "." && $leyendo_p2 != "..") {
                        $guardo_htmls = strval($leyendo_p2);
                        $orden_apartados[] = $guardo_htmls;
                        sort($orden_apartados);
                        $orden_de_capitulos[$numero_capitulo_para_html][] =  strval($guardo_htmls);
                        //echo "<li>$leyendo_p2</li>";
                        $apartado++;
                    }
                }
            } echo "</ul>";
        }
        closedir($pagina);
        closedir($pagina_int);
        //var_dump($orden_de_capitulos);
        for($q=1; $q<=count($orden_de_capitulos); $q++){
            echo "<strong>Unidad ".$q."</strong><br>";
            echo "<ul>";
            for($w=0; $w<count($orden_de_capitulos[$q]); $w++){
                sort($orden_de_capitulos[$q]);
                echo "<li>".$orden_de_capitulos[$q][$w]."</li>";
            }
            echo "</ul>";
        }
        escribe_xml($titulos_capitulos);
        echo '</div></div>
            </div>
        </section>';
        echo '<h1 class="titulo_manual">'.$titulo_manual.'</h1>';
    }

        // Descomentar para que se pinten los distintos arrays con todos los contenidos para comprobar que son correctos
        /*var_dump($lista_contenidos_tema_);*/

/* Función para porder buscar muchas cadenas de texto en una misma variable */
function strposa($haystack, $needle, $offset=0) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $query) {
        if(strpos($haystack, $query, $offset) !== false) return true; // Para en el primer resultado encontrado
    }
    return false;
}
/********************/

function escribe_xml($titulos_capitulos) {
    // Incluyo las variables con el contenido xml
    include 'variables.php';
    extract($_GET);
    global $zip;
    // Nombre de los archivos 
    $nombre_archivo = array('adlcp_rootv1p2.xsd','ims_xml.xsd','imscp_rootv1p1p2.xsd','imsmd_rootv1p2p1.xsd','imsmanifest.xml');

    // Creo los archivos en mi carpeta local php
    $archivo_1 = fopen($nombre_archivo[0],'w') or die ('Fallo');
    $archivo_2 = fopen($nombre_archivo[1],'w') or die ('Fallo');
    $archivo_3 = fopen($nombre_archivo[2],'w') or die ('Fallo');
    $archivo_4 = fopen($nombre_archivo[3],'w') or die ('Fallo');
   // $archivo_5 = fopen($nombre_archivo[4],'w') or die ('Fallo');
    
    // Recojo la ruta donde están las carpetas para incluir los archivos y la ruta del archivo en ejecución, para eliminar los archivos
    $ruta_fuentes = $_GET['directorio_fuentes'];
    $ruta_pagina = $_GET['directorio_paginacion'];
    $ruta_local = str_replace('/funciones.php', '', __FILE__);
    $numero_temas = 0;
    
    // Copio el contenido xml en cada archivo, y cierro el archivo
    fputs($archivo_1, $adlcp_rootv1p2); fclose($archivo_1);
    fputs($archivo_2, $ims_xml); fclose($archivo_2);
    fputs($archivo_3, $imscp_rootv1p1p2); fclose($archivo_3);
    fputs($archivo_4, $imsmd_rootv1p2p1); fclose($archivo_4);
        
    // Copio los archivos en cada una de las carpetas de la paginación, menos el manifest
    $abre_carpetas = opendir($ruta_pagina);
    $contando_carpetas = readdir($abre_carpetas);
    while (($contando_carpetas = readdir($abre_carpetas)) !== false) {
        $numero_temas++;
    }
    
    // Voy creando y rellenando el archivo manifest para cada uno de los capítulos
    $archivo_manifest = array();
    for($k=1; $k<=($numero_temas-1); $k++){
        global $capitulo;
        global $lista_contenidos_tema_;
        global $lista_htmls_tema_;
        // Creo los archivos y les incluyo las cabeceras xml
        $archivo_manifest[$k] = fopen($nombre_archivo[4],'w') or die ('Fallo');
        fputs($archivo_manifest[$k], $imsmanifest_cabecera); 
        
        // Incluyo el fragmento organization con el número aleatorio y el título de cada capítulo
        $numero_organization = codigos_aleatorios();
        $imsmanifest_organization = ''.chr(9).'<organizations default="ORG-'.$numero_organization.'">'.chr(13).chr(9).chr(9).'<organization identifier="ORG-'.$numero_organization.'" structure="hierarchical">'.chr(13).chr(9).chr(9).chr(9).'<title>'.$titulos_capitulos[$k-1].'</title>'.chr(13);
        fputs($archivo_manifest[$k], $imsmanifest_organization); 
        
        // Para cada uno de los archivos imanifest de cada capítulo
        for($j=1; $j<=$capitulo; $j++) {
            // Incluyo el fragmento de cada Item con su código aleatorio y su título
            for($a=0; $a<count($lista_contenidos_tema_[$j]); $a++){
                $numeros_items[$a] = codigos_aleatorios();
                $imsmanifest_items = ''.chr(9).chr(9).chr(9).'<item identifier="ITEM-'.codigos_aleatorios().'" isvisible="true" identifierref="RES-'.$numeros_items[$a].'">'.chr(13).chr(9).chr(9).chr(9).chr(9).'<title>'.$lista_contenidos_tema_[$j][$a].'</title>'.chr(13).chr(9).chr(9).chr(9).'</item>'.chr(13).'';
                fputs($archivo_manifest[$j], $imsmanifest_items); 
            }
            
            // Cierro etiquetas organization y organizations, y abro etiqueta resources
            fputs ($archivo_manifest[$j], ''.chr(9).chr(9).'</organization>'.chr(13).chr(9).'</organizations>'.chr(13).chr(9).'<resources>'.chr(13).'');
            
            // Incluyo el fragmento de cada resource con su código y html correspondiente
            for($z=0; $z<count($lista_contenidos_tema_[$j]); $z++){
                $imsmanifest_resource = ''.chr(9).chr(9).'<resource identifier="RES-'.$numeros_items[$z].'" type="webcontent" href="'.$lista_htmls_tema_[$j][$z].'" adlcp:scormtype="sco">'.chr(13).chr(9).chr(9).chr(9).'<file href="'.$lista_htmls_tema_[$j][$z].'" />'.chr(13).chr(9).chr(9).'</resource>'.chr(13).'';
                fputs($archivo_manifest[$j], $imsmanifest_resource); 
            }
            
            // Cierro etiquetas resources y manfest
            fputs ($archivo_manifest[$j], ''.chr(9).'</resources>'.chr(13).'</manifest>');
        }
        
        // Cierro el archivo manifest
        fclose($archivo_manifest[$k]);
        
        // Copio el archivo generado en la carpeta del capítulo correspondiente
        if($k>=1 && $k<= 9){
            copy($ruta_local.'/'.$nombre_archivo[4], $ruta_pagina.'/ud0'.$k.'/'.$nombre_archivo[4]);
        } else {
            copy($ruta_local.'/'.$nombre_archivo[4], $ruta_pagina.'/ud'.$k.'/'.$nombre_archivo[4]);
        }
    }
    
    for ($i=1; $i<=($numero_temas-1); $i++) {
        if($i>=1 && $i<= 9){
            copy($ruta_local.'/'.$nombre_archivo[0], $ruta_pagina.'/ud0'.$i.'/'.$nombre_archivo[0]);
            copy($ruta_local.'/'.$nombre_archivo[1], $ruta_pagina.'/ud0'.$i.'/'.$nombre_archivo[1]);
            copy($ruta_local.'/'.$nombre_archivo[2], $ruta_pagina.'/ud0'.$i.'/'.$nombre_archivo[2]);
            copy($ruta_local.'/'.$nombre_archivo[3], $ruta_pagina.'/ud0'.$i.'/'.$nombre_archivo[3]);
        } else {
            copy($ruta_local.'/'.$nombre_archivo[0], $ruta_pagina.'/ud'.$i.'/'.$nombre_archivo[0]);
            copy($ruta_local.'/'.$nombre_archivo[1], $ruta_pagina.'/ud'.$i.'/'.$nombre_archivo[1]);
            copy($ruta_local.'/'.$nombre_archivo[2], $ruta_pagina.'/ud'.$i.'/'.$nombre_archivo[2]);
            copy($ruta_local.'/'.$nombre_archivo[3], $ruta_pagina.'/ud'.$i.'/'.$nombre_archivo[3]);
        }
    };
    
    // Elimino los archivos de la carpeta php
    unlink($ruta_local.'/'.$nombre_archivo[0]);
    unlink($ruta_local.'/'.$nombre_archivo[1]);
    unlink($ruta_local.'/'.$nombre_archivo[2]);
    unlink($ruta_local.'/'.$nombre_archivo[3]);
    unlink($ruta_local.'/'.$nombre_archivo[4]);

    // Llamo a la función para comprimir
    comprime($ruta_pagina);
}

function comprime($d) {
    global $capitulo;
    $zip = array();
    $archivoZip;
    global $archivo_texto_contenido;
    global $titulo_global_manual;
    
    // Copio todos los archivos generados en el paginado en una carpeta dentro del directorio local, para comprimirlos, copiarlos en su sitio, y eliminarlos
    
    // Genero un archivos Zip por cada capítulo
    for($m=1; $m<=($capitulo); $m++){
        // Obtengo el directorio actual y le añado la carpeta SCORM
        $ruta_actual =  dirname(getcwd());
        $ruta_actual = $ruta_actual.'/SCORM';
        $zip[$m] = new ZipArchive();
        // Si no existe la carpeta se crea con todos los permisos
        mkdir($ruta_actual, 0777);
        // Genero los nombres de zip según el número de temas
        if($m>=1 && $m<=9){
            $nombreCarpeta = 'ud0'.$m;
            $archivoZip = 'ud0'.$m.'.zip';
        } else {
            $nombreCarpeta = 'ud'.$m;
            $archivoZip = 'ud'.$m.'.zip';
        }
        // Le añado la carpeta de cada tema a la carpeta SCORM y si no existe se crea con todos los permisos
        $ruta_actual = $ruta_actual.'/'.$nombreCarpeta;
        mkdir($ruta_actual, 0777, true);
        // Compruebo que la ruta de paginación $d + ud sea un directorio válido
        if($vcarga = opendir($d.'/'.$nombreCarpeta)){
            // Obtengo los nombres de los archivos de cada carpeta
            while($file = readdir($vcarga)){
                if($file != "." && $file != ".."){
                    // Compruebo que no existan subdirectorios, ya que no sería correcto
                    if(!is_dir($d.$file)){
                        // Copio los archivos de cada carpeta de paginación a su carpeta equivalente en SCORM
                        if(copy($d.'/'.$nombreCarpeta.'/'.$file, $ruta_actual.'/'.$file)){
                            // Abro la carpeta de cada tema en SCORM
                            if($lee = opendir($ruta_actual)){
                                // Recorro sus archivos obteniendo el nombre
                                while(($archivo_ = readdir($lee)) !== false){
                                    if($archivo_ != '.' && $archivo_ != '..'){
                                        // Creo el archivo zip y les añado los archivos correspondientes
                                        if($zip[$m]->open($archivoZip, ZIPARCHIVE::CREATE) === true){
                                            $zip[$m]->addFile($ruta_actual.'/'.$archivo_, $archivo_);
                                        }                                       
                                    } 
                                }
                                // Cierro los zip
                                $zip[$m]->close();
                                // Copio los archivos zip en la carpeta pagina
                                copy($archivoZip, $d.'/'.$archivoZip);
                                // Cierro el archivo de texto de contenido y lo copio en la carpeta pagina
                                fclose($archivo_texto_contenido);
                                copy('indice_contenidos.txt', $d.'/TOC de '.$titulo_global_manual.'.txt');
                                // Mando las rutas para eliminar los ficheros sobrantes a la función de borrar carpeta Scorm
                                $ruta_a_eliminar = dirname(getcwd());
                                $ruta_a_eliminar_php = $ruta_a_eliminar.'/php';
                                $ruta_a_eliminar = $ruta_a_eliminar.'/SCORM';
                                $ruta_elimina_paginacion = $d;
                            }
                        } else {
                            echo 'Al intentar copiar <strong>'.$d.'/'.$nombreCarpeta.'/'.$file .'<br>'. '</strong> en <strong>'.$ruta_actual.'/'.$file.'</strong> ha fallado de muy malas maneras';
                            echo '<br>Este proceso recoge los archivos de las carpetas de la paginación para llevarselos a la carpeta SCORM y crear cada uno de los zip.<br>';
                            echo "<h2>ERROR de los potentes, avisad a alguien que sepa</h2>";
                        }
                    } else {
                        echo "<h3>Todo ha petado, esto puede pasar por varias cosas, o que no se haya creado el archivo correctamente, o que no haya permisos de escritura, o que la paginación no es la correcta, o miles de historias. Espabila y empieza de nuevo.</h3>";
                    }
                }
            }
        }
    }
    borra_carpeta_scorm($ruta_a_eliminar, $ruta_a_eliminar_php, $capitulo, $ruta_elimina_paginacion);
}

function borra_carpeta_scorm($carpeta, $carpeta_php, $numero_capitulos, $ruta_paginacion) {
    $nombres_archivo = array('adlcp_rootv1p2.xsd','ims_xml.xsd','imscp_rootv1p1p2.xsd','imsmd_rootv1p2p1.xsd','imsmanifest.xml');
    /* Borro carpeta SCORM */
    foreach(glob($carpeta . "/*") as $archivos_carpeta){
        if (is_dir($archivos_carpeta)){
            borra_carpeta_scorm($archivos_carpeta, $carpeta_php, $numero_capitulos, $ruta_paginacion);
        } else {
            unlink($archivos_carpeta);
        }
    }
    rmdir($carpeta);
    
    /* Borro los archivos XML de las carpetas de paginación y los archivos .zip carpeta PHP, para que se pueda volver a empaquetar*/
    for($r=0; $r<=$numero_capitulos; $r++){
        if($r>=1 && $r<=9){
            unlink($ruta_a_eliminar_php.'ud0'.$r.'.zip');
            unlink($ruta_a_eliminar_php.'indice_contenidos.txt');
            unlink($ruta_paginacion.'/ud0'.$r.'/'.$nombres_archivo[0]);
            unlink($ruta_paginacion.'/ud0'.$r.'/'.$nombres_archivo[1]);
            unlink($ruta_paginacion.'/ud0'.$r.'/'.$nombres_archivo[2]);
            unlink($ruta_paginacion.'/ud0'.$r.'/'.$nombres_archivo[3]);
            unlink($ruta_paginacion.'/ud0'.$r.'/'.$nombres_archivo[4]);
        } else {
            unlink($ruta_a_eliminar_php.'ud'.$r.'.zip');
            unlink($ruta_paginacion.'/ud'.$r.'/'.$nombres_archivo[0]);
            unlink($ruta_paginacion.'/ud'.$r.'/'.$nombres_archivo[1]);
            unlink($ruta_paginacion.'/ud'.$r.'/'.$nombres_archivo[2]);
            unlink($ruta_paginacion.'/ud'.$r.'/'.$nombres_archivo[3]);
            unlink($ruta_paginacion.'/ud'.$r.'/'.$nombres_archivo[4]);
        }
        
    }    
    unlink($ruta_a_eliminar_php.'/'.$nombre_archivo[0]);
    unlink($ruta_a_eliminar_php.'/'.$nombre_archivo[1]);
    unlink($ruta_a_eliminar_php.'/'.$nombre_archivo[2]);
    unlink($ruta_a_eliminar_php.'/'.$nombre_archivo[3]);
    unlink($ruta_a_eliminar_php.'/'.$nombre_archivo[4]);
}

/* Genera los chorizos para los xml */
function codigos_aleatorios() {
    $an = "0123456789ABCDEF";
    $su = strlen($an) - 1;
    return substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1);
}
?>
        
        <script type="text/javascript" src="../js/jquery-3.1.0.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    </body>
</html>