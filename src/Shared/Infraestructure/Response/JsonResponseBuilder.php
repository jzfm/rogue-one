<?php

namespace Rogue\Shared\Infraestructure\Response;

use Illuminate\Http\JsonResponse;
use Rogue\Shared\Infraestructure\Response\Response;
use Rogue\Shared\Infraestructure\Response\ResponseBuilderInterface;

class JsonResponseBuilder implements ResponseBuilderInterface
{
    private $result;
    private $keyData;
    private $headers;

    public function make(Response $result): JsonResponse
    {
        $this->setResult($result);

        $response = [
            'status' => $this->result->getStatus(),
            'message' => $this->result->getMessage(),
        ];

        if ($this->result->hasErrors()) {
            $response['errors'] = $this->result->getErrors()->toArray();
        } else {
            $response['data'] = $this->outputData();
        }

        $jsonResponse = response()->json($response, $this->result->getCode());

        if ($this->headers) {
            $jsonResponse->withHeaders($this->headers);
        }

        return $jsonResponse;
    }

    private function outputData(): array
    {
        $data = $this->getDataByKey($this->result, $this->keyData);
        return $data;
    }

    private function getDataByKey(Response $result, ?string $keyData)
    {
        return $keyData ? $result->getDataByKey($keyData) : $result->getData()->toArray();
    }

    public function setResult(Response $result): self
    {
        $this->result = $result;
        return $this;
    }

    public function setKeyData(?string $keyData): self
    {
        $this->keyData = $keyData;
        return $this;
    }

    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;
        return $this;
    }
}
