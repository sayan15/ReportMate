<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Psy\Readline\Hoa\Console;
use Kreait\Firebase\Contract\Storage;

class DashboardController extends Controller
{
    public function __construct(Database $database,Storage $storage)
    {
        $this->database = $database;
        $this->storage = $storage;
        $this->table ='Incidents';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incidents = [];
        
        try {
            $data = $this->database->getReference($this->table)->getValue();
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
                    'officer' => User::where('id', $values['officer_id'])->value('name'),
                    'status' => $values['status'],
                ];
            }
        } catch (\Exception $e) {
            // You might want to log this exception or handle it in a way other than just showing the dashboard
        }
        
        return view('dashboard', ['incidentLocations' => $incidents]);
    }

}
