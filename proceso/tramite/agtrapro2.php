<?php

session_start(); // inicia sesion
if (!empty($_SESSION["usuario"])) { //verifica si la variable de sesion no esta vacia
    include '../class_conexion.php';

    function registrar() {
        $fecha = date("Y-m-d");
        $query = mysql_query(""
                . "select t.duracion, p.id_paso, p.duracion, p.ci_per "
                . "from tramites as t, paso as p where t.id_tramite='$_REQUEST[tramite]' "
                . "and p.id_tramite='$_REQUEST[tramite]' and p.posicion='1'") or
                die("Error SQL");
        while ($row = mysql_fetch_array($query, MYSQL_NUM)) {
            $duracion = $row[0];
            $paso = $row[1];
            $padur = $row[2];
            $persona = $row[3];
        }
        $mes = date("n");
        $dia = date("d");
        $anio = date("Y");
        for ($i = 0; $i < $duracion; $i++) {
            if ($mes > 12) {
                $mes = 1;
                $anio = $anio + 1;
            }
            if ($mes == 4 or $mes == 6 or $mes == 9 or $mes == 11) {
                // verifica si el mes es abril, junio, septiembre o noviembre que tienen 30 dias
                if ($dia < 30) {
                    // verifica que mientras sea menor a 30 se incremente caso contrario volvera a 0 pues paso de mes
                    $dia = $dia + 1;
                } else {
                    $dia = 1;
                    $mes = $mes + 1;
                }
            } elseif ($mes == 2) {
                // verifica si el mes es febrero
                if ($anio % 4 == 0 and $anio % 100 != 0 or $anio % 400 == 0) {
                    //verifica si el año es biciesto
                    if ($dia < 29) {
                        // verifica que mientras sea menor a 29 se incremente caso contrario volvera a 0 pues paso de mes
                        $dia = $dia + 1;
                    } else {
                        $dia = 1;
                        $mes = $mes + 1;
                    }
                } else { // no es biciesto
                    if ($dia < 28) {
                        // verifica que mientras sea menor a 28 se incremente caso contrario volvera a 0 pues paso de mes
                        $dia = $dia + 1;
                    } else {
                        $dia = 1;
                        $mes = $mes + 1;
                    }
                }
            } else {
                if ($dia < 31) {
                    // verifica que mientras sea menor a 28 se incremente caso contrario volvera a 0 pues paso de mes
                    $dia = $dia + 1;
                } else {
                    $dia = 1;
                    $mes = $mes + 1;
                }
            }
        }

        // determinando la fecha de fin de paso
        $mes1 = date("n"); // extrae el mes actual sin ceros delante
        $dia1 = date("d");
        $anio1 = date("Y");
        $horaact = date("G"); // extrae la hora del registro sin ceros 
        for ($i = 0; $i < $padur; $i++) {
            if ($mes1 > 12) {
                $mes1 = 1;
                $anio1 = $anio1 + 1;
            }
            if ($mes1 == 4 or $mes1 == 6 or $mes1 == 9 or $mes1 == 11) {// verifica si el mes es abril, junio, septiembre o noviembre que tienen 30 dias
                if ($dia1 < 30) {// verifica que mientras sea menor a 30 se incremente caso contrario volvera a 0 pues paso de mes
                    if ($horaact < 24) {
                        $horaact = $horaact + 1;
                    } else {
                        $dia1 = $dia1 + 1;
                        $horaact = 0;
                    }
                } else {
                    $dia1 = 1;
                    $mes1 = $mes1 + 1;
                }
            } elseif ($mes1 == 2) {// verifica si el mes es febrero
                if ($anio1 % 4 == 0 and $anio1 % 100 != 0 or $anio1 % 400 == 0) {//verifica si el año es biciesto
                    if ($dia1 < 29) {// verifica que mientras sea menor a 29 se incremente caso contrario volvera a 0 pues paso de mes
                        if ($horaact < 24) {
                            $horaact = $horaact + 1;
                        } else {
                            $dia1 = $dia1 + 1;
                            $horaact = 0;
                        }
                    } else {
                        $dia1 = 1;
                        $mes1 = $mes1 + 1;
                    }
                } else { // no es biciesto
                    if ($dia1 < 28) {// verifica que mientras sea menor a 28 se incremente caso contrario volvera a 0 pues paso de mes
                        if ($horaact < 24) {
                            $horaact = $horaact + 1;
                        } else {
                            $dia1 = $dia1 + 1;
                            $horaact = 0;
                        }
                    } else {
                        $dia1 = 1;
                        $mes1 = $mes1 + 1;
                    }
                }
            } else {
                if ($dia1 < 31) {// verifica que mientras sea menor a 28 se incremente caso contrario volvera a 0 pues paso de mes
                    if ($horaact < 24) {
                        $horaact = $horaact + 1;
                    } else {
                        $dia1 = $dia1 + 1;
                        $horaact = 0;
                    }
                } else {
                    $dia1 = 1;
                    $mes1 = $mes1 + 1;
                }
            }
        }
        if (strlen($mes) < 2) {
            $mes = "0" . $mes;
        }
        if (strlen($dia) < 2) {
            $dia = "0" . $dia;
        }
        if (strlen($mes1) < 2) {
            $mes1 = "0" . $mes1;
        }
        if (strlen($dia1) < 2) {
            $dia1 = "0" . $dia1;
        }
        if (strlen($horaact) < 2) {
            $horaact = "0" . $horaact;
        }
        $hora = date("H"); // extrae la hora del registro con ceros, tomar en cuenta que redondea al inmediato superior
        $finaproxtra = $anio . "-" . $mes . "-" . $dia;
        $finpaprox = $anio1 . "-" . $mes1 . "-" . $dia1; // convierte a date la cadena
        mysql_query("insert into tramite_proceso (fecha_reg, id_tramite, ci_cli, ini_tramite,
        finaprox_tramite, id_paso, ini_paso, inihora_paso,fin_paso,finhora_paso,estado) 
      values ('$fecha', '$_REQUEST[tramite]','$_REQUEST[valor]','$fecha',
        '$finaproxtra','$paso','$fecha','$hora',
        '$finpaprox','$horaact','Activo')") or
                die("Error SQL");
        $queryn = mysql_query("select distinct t.id_proceso from tramite_proceso as t, tramites as tr, cliente as c
          where t.id_tramite='$_REQUEST[tramite]' and t.ci_cli='$_REQUEST[valor]' and t.ini_tramite='$fecha'") or
                die("Error SQL");
        while ($rown = mysql_fetch_array($queryn, MYSQL_NUM)) {
            $proceso = $rown[0];
        }
        mysql_query("insert into paso_proceso (fecha_reg,id_proceso,id_paso,ini_paso,
        inihora_paso,fin_paso,finhora_paso,estado,porcentaje,observaciones,ci_per) 
        values ('$fecha', '$proceso','$paso','$fecha','$hora',
        '$finpaprox','$horaact','En Proceso',
        '0','','$persona')") or
                die("Error SQL");
        echo "<script language='JavaScript'>alert('Grabacion Correcta');
        location.href='../clear.html';</script>";
    }

    $sub = mysql_query("select * from tramite_proceso where ci_cli='$_REQUEST[valor]' and id_tramite='$_REQUEST[tramite]' ") or die("Error SQL");
    if (!mysql_num_rows($sub)) {
        registrar();
    } else {
        echo "<script language='JavaScript'>alert('Este tramite ya esta en proceso, verifique sus datos');
          history.back();</script>";
    }
    mysql_close($conexion);
} else {
    echo "<script language='JavaScript'>alert('Debe iniciar sesion');
  location.href='../index.html';</script>";
}
?>