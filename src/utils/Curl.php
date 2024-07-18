
<?php

namespace Utils;

use Exception;

/**
 * Class Curl
 * @package classes
 *
 * A simple CURL wrapper for HTTP requests.
 */
class Curl
{
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    private function execute(array $options): array|string
    {
        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if ($error) {
            throw new Exception($error);
        }

        $decodedResponse = json_decode($response, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $decodedResponse;
        }

        parse_str($response, $parsedResponse);
        return !empty($parsedResponse) ? $parsedResponse : $response;
    }

    public function post(array $headers = [], array $data = []): array|string
    {
        $options = [
            CURLOPT_URL => $this->url,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => json_encode($data),
        ];

        return $this->execute($options);
    }

    public function get(array $headers = []): array|string
    {
        $options = [
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
        ];

        return $this->execute($options);
    }

    public function put(array $headers = [], array $data = []): array|string
    {
        $options = [
            CURLOPT_URL => $this->url,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => json_encode($data),
        ];

        return $this->execute($options);
    }

    public function delete(array $headers = []): array|string
    {
        $options = [
            CURLOPT_URL => $this->url,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
        ];

        return $this->execute($options);
    }
}
