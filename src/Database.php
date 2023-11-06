<?php

namespace Ethereal;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    protected $capsule;

    public function __construct()
    {
        $this->capsule = new Capsule;
    }

    public function connect($config)
    {
        $this->capsule->addConnection($config);
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }

    public function getQueryBuilder()
    {
        return $this->capsule->getConnection()->query();
    }
}