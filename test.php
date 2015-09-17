<?php

include_once __DIR__.'/db/proceso/TramiteProceso.php';


$tramite_proceso = new TramiteProceso();

print_r($tramite_proceso->getall());
