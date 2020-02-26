<?php

namespace Project\Database;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    /**
     * The database manager instance
     *
     * @var Capsule
     */
    private $instance;

    /**
     * @var string
     */
    private $driver;

    /**
     * The database host name
     *
     * @var string
     */
    private $host;

    /**
     * The sqlite database absolute path
     *
     * @var string
     */
    private $database;

    /**
     * Database constructor.
     *
     * @param Capsule $instance
     */
    public function __construct(Capsule $instance = null)
    {
        /*
         * Creat an instance of eloquent orm
         * This object will be configured when only connection established
         */
        $this->instance = $instance ?? new Capsule;

        /*
         *  Loading the database attribute from the environment
         *  If env variables have not been set, defaults will be used
         */
        $this->driver = getenv('DB_CONNECTION') ?: 'sqlite';
        $this->host   = getenv('DB_HOST') ?: 'localhost';
        $this->database = getenv('DB_DATABASE') ?: $this->getDefaultPath();
    }

    /**
     * Get the default path for SQLite
     *
     * @return string
     */
    private function getDefaultPath(): string
    {
        return __DIR__ . '/../../database/database.sqlite';
    }

    /**
     * Setup the service and run
     *
     * @throws \InvalidArgumentException
     * @return void
     */
    public function registerConfiguration(): void
    {
        $this->instance->addConnection([
            'driver' => $this->driver,
            'host' => $this->host,
            'database' => $this->database,
        ]);

        $this->instance->setAsGlobal();

        $this->instance->bootEloquent();
    }

}