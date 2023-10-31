<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

class FirebaseController extends Controller
{
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->table ='Incidents';
    }
    public function index()
    {
 
        $data =  $this->database->getReference($this->table)->getValue();

        request()->merge(['locationData' => $data]);
        return redirect()->route('map.index');
 
    }
}
