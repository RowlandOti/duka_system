<?php

namespace Tenant\Affects;

use Illuminate\Database\ConnectionResolverInterface;

class ConnectionResolver  implements ConnectionResolverInterface {

    /**
     * @var string
     */
    private $connection;

    /**
     * @var ConnectionResolverInterface
     */
    private $db;

    public function __construct(string $connection, ConnectionResolverInterface $db)
    {
        $this->connection = $connection;
        $this->db = $db;
    }

    /**
     * Get a database connection instance.
     *
     * @param string $name
     *
     * @return \Illuminate\Database\ConnectionInterface
     */
    public function connection($name = null)
    {
        return $this->db->connection($name ?? $this->getDefaultConnection());
    }

    /**
     * Get the default connection name.
     *
     * @return string
     */
    public function getDefaultConnection()
    {
        return $this->connection;
    }

    /**
     * Set the default connection name.
     *
     * @param string $name
     *
     * @return void
     */
    public function setDefaultConnection($name)
    {
        $this->connection = $name;
    }
}
