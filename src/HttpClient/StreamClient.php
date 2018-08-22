<?php

namespace IspApi\HttpClient;

/**
 * Class StreamClient
 * @package IspApi\HttpClient
 */
class StreamClient implements HttpClientInterface
{
    /**
     * @var HttpClientParams
     */
    private $params;

    /**
     * @param HttpClientParams $params
     *
     * @return StreamClient
     */
    public function setParams(HttpClientParams $params): self
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        try {
            $connection = \fopen($this->params->getUrl(), 'rb', false, \stream_context_create($this->prepareParams()));
            $response = '';
            while ($data = \fread($connection, 4096)) {
                $response .= $data;
            }
            \fclose($connection);
            $response = \json_decode($response, true);
        } catch (\Exception $exception) {
            $response = [];
        }
        return $response;
    }

    /**
     * @return array
     */
    private function prepareParams(): array
    {
        $header = $this->params->getHeader();
        if ($this->params->getMethod() === HttpClientParams::HTTP_METHOD_POST) {
            return [
                'http' => [
                    'method'  => $this->params->getMethod(),
                    'header'  => $header[0],
                    'content' => $this->params->getContent(),
                ]
            ];
        }
        return [
            'http' => [
                'method' => $this->params->getMethod(),
                'header' => $header[0],
            ],
        ];
    }
}