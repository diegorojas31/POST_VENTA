<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Backup\Tasks\Backup\BackupJob;
use Spatie\Backup\Tasks\Backup\Signals\SIGINT;


class FuncionController extends Controller
{
    public function CodigoLinea($activity) {

        $properties = $activity->properties;
        $properties_string = '';
        $cuaser_string = '';
        $cuaser_string .=':';
        foreach ($properties as $key => $value) {
            if (is_array($value)) {
                // Si $value es un array, conviértelo a una cadena o realiza el procesamiento necesario
                $value = json_encode($value); // o utiliza serialize() u otra lógica según tus necesidades
            }

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
        $ruta_directorio = 'Bitacora';
        $nombre_archivo = 'master_' . $idMaster . '.csv';
    
        // Crea el directorio si no existe
        Storage::makeDirectory($ruta_directorio);
    
        // Ruta completa del archivo
        $ruta_archivo = storage_path($ruta_directorio . '/' . $nombre_archivo);
    
        // Crea el archivo
        touch($ruta_archivo);
    }
    public function backup()
    {
        $job = new BackupJob(config('backup'));
        $job->run();
    }

}
