<?php

namespace App\Http\Controllers;

use Spatie\Backup\Tasks\Backup\BackupJob;
use Illuminate\Http\Request;
use Spatie\Backup\Tasks\Backup\Signals\SIGINT;


class FuncionController extends Controller
{
    public function CodigoLinea($activity) {

        $properties = $activity->properties;
        $properties_string = '';
        $cuaser_string = '';
        $cuaser_string .=':';
        foreach ($properties as $key => $value) {
            $properties_string .= $key . ':' . $value . '|';
        }
        $properties_string = rtrim($properties_string, '|');
        //se supone que hay que saber quien es el usuario master
        //[userID:descripcion:performedOn:withproperties:]
        //$result = $activity->causer.":".$activity->properties.":";
        $result = 
            'id:'.optional($activity->causer)->id.'|'.
            'name:'.optional($activity->causer)->name.'|'.
            'Titulo:'.$activity->description.'|'.
            'performerdOn:'.$activity->subject_id.'|'.
            $properties_string
        ;
        return '['.$result.']';
    }
    
    public function guardarEnCSV($activity, $idMaster) {
        $linea = $this->CodigoLinea($activity);
        $ruta_archivo = storage_path('Bitacora\master_'.$idMaster.'.csv');
        $archivo = fopen($ruta_archivo, 'a');
        fputcsv($archivo, [$linea]);
        fclose($archivo);
    }

    public function nuevoArchivoCSV($idMaster) {
        $ruta_archivo = storage_path('Bitacora\master_' . $idMaster . '.csv');
        touch($ruta_archivo);
    }
    public function backup()
    {
        $job = new BackupJob(config('backup'));
        $job->run();
    }

}
