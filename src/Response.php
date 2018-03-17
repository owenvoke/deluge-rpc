<?php

namespace App\Clients\Deluge;

/**
 * Class Response
 */
class Response
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $data;

    /**
     * Response constructor.
     *
     * @param string $response
     */
    public function __construct(string $response)
    {
        $response = $this->decodeResponse($response);
        $this->id = $response['id'];

        if (isset($response['error'])) {
            throw new \InvalidArgumentException(
                $response['error']['message'],
                $response['error']['code']
            );
        } elseif (!isset($response['result'])) {
            throw new \InvalidArgumentException('Invalid JSON RPC response.');
        }

        $this->data = $response['result'];
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $json
     * @return array
     */
    private function decodeResponse(string $json): array
    {
        return json_decode($json, true);
    }
}
