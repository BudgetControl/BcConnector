<?php
/**
 * This file is a helper file that contains various functions.
 */

use Budgetcontrol\Connector\Client\Connector;

if(!function_exists('config')) {
    function confing(string $key, string $value): string {
        return $_ENV[$key] ?? $value;
    }
}

if(!function_exists('response')) {
    function response(array $dataResponse, int $statusCode = 200, array $headers=[]): \Psr\Http\Message\ResponseInterface {
        $response = new \Slim\Psr7\Response();

        $jsonData = json_encode($dataResponse);
        if ($jsonData === false) {
            $errorResponse = new \Slim\Psr7\Response();
            $errorResponse->getBody()->write('Errore nella codifica JSON dei dati');
            return $errorResponse->withStatus(500);
        }
        
        $response->getBody()->write($jsonData);

        foreach ($headers as $key => $value) {
            $response = $response->withHeader($key, $value);
        }
        
        return $response->withHeader('Content-Type', 'application/json')->withStatus($statusCode);
    }
}

if(!function_exists("LibsConnect")) {
    function libsConnect(string $domain, string $path, int $wsid, string $method = 'GET', array $payLoad = [], array $headers = []): array {
        $connect = new Connector();
        $connect->setMethod($method);
        $connect->setPayload($payLoad);
        $connect->setHeader($headers);
        $connect->setDomain($domain);
        $result = $connect->call($path, $wsid);
        return $result->getBody();
    }
}

// More functions...
