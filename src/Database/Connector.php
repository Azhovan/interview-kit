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
     * The database driver name
     *
     * @var string
     */
    private $database;

    /**
     * The database password
     *
     * @var string
     */
    private $password;

    /**
     * The database username
     *
     * @var string
     */
    private $username;

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
        $this->username = getenv('DB_USERNAME') ?: 'root';
        $this->password = getenv('DB_PASSWORD') ?: null;
    }

    /**
     * Get the default path for SQLite
     *
     * @return string
     */
    private function getDefaultPath(): string
    {
        if ($this->driver === 'sqlite') {
            return __DIR__ . '/../../database/database.sqlite';
        }

        throw new \RuntimeException('Invalid database driver');
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
            'username' => $this->username,
            'password' => $this->password,
        ]);

        $this->instance->setAsGlobal();

        $this->instance->bootEloquent();
    }

}