<?php

namespace Procob\Http;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use Procob\Exceptions\ProcobApiException;
use Procob\Exceptions\ProcobRequestException;
use GuzzleHttp\Client as Guzzle;

class Api
{
    /**
     * @var Guzzle
     */
    protected $client;

    /**
     * Api constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param string|null $endpoint
     * @param string|null $data
     * @param array $options
     * @return mixed
     * @throws ProcobRequestException
     * @throws ProcobApiException
     * @throws GuzzleException
     */
    public function get(string $endpoint = null,
                        string $data = null,
                        array  $options = [])
    {
        return $this->request('GET', $endpoint, $data, $options);
    }

    /**
     * @param string|null $endpoint
     * @param string|null $data
     * @return string
     */
    private static function getEndpointUrl(string $endpoint = null,
                                           string $data = null): ?string
    {
        if (!empty($data)) $endpoint .= "/" . $data;

        return $endpoint;
    }

    /**
     * @param string $method
     * @param string|null $endpoint
     * @param string|null $data
     * @param array $options
     * @return mixed
     * @throws ProcobRequestException
     * @throws ProcobApiException
     * @throws GuzzleException
     */
    private function request(string $method,
                             string $endpoint = null,
                             string $data = null,
                             array  $options = [])
    {
        $url = $this->getEndpointUrl($endpoint, $data);

        try {
            $response = $this->client->request($method, $url, $options);
        } catch (RequestException $e) {
            if (!$e->hasResponse()) {
                throw new ProcobRequestException($e->getMessage());
            }

            $response = $e->getResponse();
        }

        return $this->response($response);
    }

    /**
     * @param ResponseInterface $response
     * @return mixed
     * @throws ProcobRequestException
     * @throws ProcobApiException
     */
    private function response(ResponseInterface $response)
    {
        $content = $response->getBody()->getContents();

        $data = json_decode($content);

        $this->checkForErrors($response, $data);

        return $data;
    }

    /**
     * @param ResponseInterface $response
     * @param \stdClass|null $data
     * @throws ProcobApiException
     * @throws ProcobRequestException
     */
    private function checkForErrors(ResponseInterface $response, \stdClass $data = null)
    {
        $code = $response->getStatusCode();
        $statusClass = (int)($code / 100);

        // Not in accordance to REST API specification:
        // Request errors are received as "200 OK" rather than
        // "400 Bad Request" or "422 Unprocessable Entity"
        $this->checkForApiException($data);

        if ($statusClass === 4 || $statusClass === 5) {
            $this->checkForRequestException($response);
        }
    }

    /**
     * @param \stdClass|null $data
     * @throws ProcobApiException
     */
    private function checkForApiException(\stdClass $data = null)
    {
        $code = intval($data->code ?? 0);
        $reason = $data->message ?? 'Unknown error';

        if ($code === 0) return;

        throw new ProcobApiException($reason, $code);
    }

    /**
     * @param ResponseInterface $response
     * @throws ProcobRequestException
     */
    private function checkForRequestException(ResponseInterface $response)
    {
        $code = $response->getStatusCode();
        $reason = $response->getReasonPhrase();

        throw new ProcobRequestException($reason, $code);
    }

    /**
     * @param Guzzle $client
     */
    public function setClient(Guzzle $client): void
    {
        $this->client = $client;
    }
}
