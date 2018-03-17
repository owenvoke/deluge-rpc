<?php

namespace App\Clients\Deluge;

/**
 * Class Command
 */
class Command
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var Client
     */
    private $client;
    /**
     * @var array
     */
    private $arguments = [];

    /**
     * Command constructor.
     *
     * @param string $name
     * @param Client $client
     */
    public function __construct(string $name, Client $client)
    {
        $this->name = $name;
        $this->client = $client;
    }

    /**
     * Executes the remote procedure call command.
     *
     * @param array $arguments
     * @return mixed
     * @exception \Exception
     */
    public function execute(array $arguments = [])
    {
        $this->arguments = $arguments;

        return $this->client->executeCommand($this);
    }

    /**
     * @return array
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
