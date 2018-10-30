<?php
namespace Procob\Http;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Procob\Exceptions\ProcobValidationException;
use Procob\Exceptions\ProcobRequestException;

class Api
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function get(string $endpoint = null, string $data = null, array $options = [])
    {
        return $this->request('GET', $endpoint, $data, $options);
    }

    private static function getEndpointUrl(string $endpoint = null, string $data = null)
    {
        if (!empty($data)) $endpoint .= "/". $data;

        return $endpoint;
    }

    private function request(string $method, string $endpoint = null, string $data = null, array $options = [])
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

    private function response(ResponseInterface $response)
    {
        $content = $response->getBody()->getContents();

        $data = json_decode($content);

        $this->checkForErrors($response, $data);

        return $data;
    }

    private function checkForErrors(ResponseInterface $response, \stdClass $data)
    {
        $code           = $response->getStatusCode();
        $statusClass    = (int) ($code / 100);

        // Not in accordante to REST API specification:
        // Request errors are received as "200 OK" rather than
        // "400 Bad Request" or "422 Unprocessable Entity"
        $this->ProcobValidationException($data);

        if ($statusClass === 4 || $statusClass === 5) {
            $this->checkForRequestException($response);
        }
    }

    private function ProcobValidationException(\stdClass $data)
    {
        $code    = intval($data->code ?? 0);
        $reason  = $data->message ?? 'Unknown error';

        if ($code === 0) return;

        $message = "{$reason} ($code)";

        throw new ProcobValidationException($message);
    }

    private function checkForRequestException(ResponseInterface $response)
    {
        $code    = $response->getStatusCode();
        $reason  = $response->getReasonPhrase();

        $message = "{$reason} ($code)";

        throw new ProcobRequestException($message);
    }
}
