<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Psy\Readline\Hoa\Console;
use Kreait\Firebase\Contract\Storage;
use PDO;

class ReportController extends Controller
{
    
    public function __construct(Database $database,Storage $storage)
    {
        $this->database = $database;
        $this->storage = $storage;
        $this->table ='Incidents';
    }
    public function index(){
        $incidents = [];
        $data =  $this->database->getReference($this->table)->getValue();
        foreach ($data as $key => $values) {
            $incidents[$key] = [
                'key' => $key,
                'crime_type' => $values['crime_type'],
                'description' => $values['description'],
                'generated_at' => $values['generated_at'],
                'happenedAt' => $values['happenedAt'],
                'lat' => $values['latitude'],
                'lng' => $values['longitude'],
                'phone' => $values['phone'],
                'title' => $values['title'],
                'updated_at' => $values['updated_at'],
                'officer' => $values['officer_id'],
                'status' => $values['status'],
            ];
        }
        return view ('report')->with('incidentLocations',$incidents);;
    }


}
