<?php

namespace App\Models\Mongodb;

use MongoDB\Client;

class Mongodb
{
    protected Client $client;
    protected string $databaseName;
    protected string $collectionName;

    public function __construct()
    {
        $this->client =  new Client(config('database.connections.mongodb.url'));
        
        try {
            $this->client->selectDatabase('admin')->command(['ping' => 1]);
        } catch (\Exception $e) {
            throw new \Exception('Failed database connection!');
        }
        
        $databaseName = config('database.connections.mongodb.database');
        $this->databaseName = $databaseName;
    }

    public function collection(string $collectionName = '')
    {
        return ($collectionName == '') 
            ? $this->client->{$this->databaseName}->$collectionName 
            : $this->client->{$this->databaseName}->{$this->collectionName};
    }
}