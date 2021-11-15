<?php

namespace Liquid\Infrastructure\Services\HttpClients;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response as HttpResponse;

abstract class HttpClient
{
    protected $client;

    protected $defaultOptions;

    protected $logger;

    abstract protected function defaultConfig(): array;

    abstract protected function clientName(): string;

    public function __construct()
    {
        $this->defaultOptions = $this->defaultConfig();
        $this->defaultOptions['handler'] = $this->initHandlerStack();

        $this->client = $this->initClient($this->defaultOptions);
    }

    protected function initHandlerStack()
    {
        $stack = HandlerStack::create();
        $stack->remove('http_errors');
        $this->logger = $this->initLogger();
        $stack->push($this->logger, 'logger');

        return $stack;
    }

    protected function initLogger()
    {
        return new LogMiddleware($this->clientName());
    }

    protected function initClient($defaultOptions)
    {
        return new Client($defaultOptions);
    }

    protected function send(string $method, string $uri, array $options = []): HttpResponse
    {
        try {
            $httpResponse = $this->client->request($method, $uri, $options);
        } catch (\Exception $e) {
            $this->logger->logError($e);

            if (($e instanceof RequestException)) {
                $httpResponse = $e->getResponse();
                if (is_null($httpResponse)) {
                    throw HttpClientException::error($e->getMessage(), $e->getCode());
                }
            } else {
                throw HttpClientException::error($e->getMessage(), $e->getCode());
            }
        }

        return $httpResponse;
    }

    protected function buildResponse($httpResponse): Response
    {
        $responseContents = $httpResponse->getBody()->getContents();
        $contents = json_decode($responseContents, true);

        return new Response(
            $httpResponse->getStatusCode(),
            $httpResponse->getReasonPhrase(),
            $contents
        );
    }

    public function getLogger(): LogMiddleware
    {
        return $this->logger;
    }
}
