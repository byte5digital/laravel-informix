<?php

namespace Byte5\LaravelInformix\Connectors;

use Exception;
use Illuminate\Database\Connectors\Connector;
use Illuminate\Database\Connectors\ConnectorInterface;
use Illuminate\Support\Arr;
use PDO;

class IfxConnector extends Connector implements ConnectorInterface
{
    /**
     * The PDO connection options.
     *
     * @var array
     */
    protected $options = [
        PDO::ATTR_CASE    => PDO::CASE_NATURAL,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];

    public function createConnection($dsn, array $config, array $options)
    {
        $username = Arr::get($config, 'username');
        $password = Arr::get($config, 'password');

        try {
            $pdo = new \PDO($dsn, $username, $password, $options);
        } catch (Exception $e) {
            $pdo = $this->tryAgainIfCausedByLostConnection(
                $e, $dsn, $username, $password, $options
            );
        }

        return $pdo;
    }

    /**
     * Establish a database connection.
     *
     * @param array $config
     *
     * @return \PDO
     */
    public function connect(array $config)
    {
        $dsn = $this->getDsn($config);

        $options = $this->getOptions($config);

        // We need to grab the PDO options that should be used while making the brand
        // new connection instance. The PDO options control various aspects of the
        // connection's behavior, and some might be specified by the developers.
        $connection = $this->createConnection($dsn, $config, $options);

        if (Arr::get($config, 'initSqls', false)) {
            if (is_string($config['initSqls'])) {
                $connection->exec($config['initSqls']);
            }
            if (is_array($config['initSqls'])) {
                $connection->exec(implode('; ', $config['initSqls']));
            }
        }

        return $connection;
    }

    /**
     * Create a DSN string from a configuration.
     *
     * Chooses socket or host/port based on the 'unix_socket' config value.
     *
     * @param array $config
     *
     * @return string
     */
    protected function getDsn(array $config)
    {
        return "informix:host={$config['host']}; database={$config['database']}; service={$config['service']}; server={$config['server']}; ".$this->getDsnOption($config);
    }

    protected function getDsnOption(array $config)
    {
        $options = 'protocol='.Arr::get($config, 'onsoctcp', 'onsoctcp').';';

        if (isset($config['db_locale'])) {
            $options .= " DB_LOCALE={$config['db_locale']};";
        }
        if (isset($config['client_locale'])) {
            $options .= " CLIENT_LOCALE={$config['client_locale']};";
        }

        return $options;
    }
}
