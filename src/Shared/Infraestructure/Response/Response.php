<?php

namespace Rogue\Shared\Infraestructure\Response;

use Doctrine\Common\Collections\ArrayCollection;

class Response
{
    private const SUCCESS = 'Success';
    private const FAILED = 'Failed';

    private $headers;
    private $message;
    private $code;
    private $status;
    private $errors;
    private $data;
    private $runEvents;

    public function __construct()
    {
        $this->message = '';
        $this->status = '';
        $this->headers = [];
        $this->code = 200;
        $this->errors = new ArrayCollection();
        $this->data = new ArrayCollection();
        $this->runEvents = true;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;

        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getCode(): int
    {
        return $this->code == 0 ? 500 : $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getErrors(): ArrayCollection
    {
        return $this->errors;
    }

    public function setErrors(ArrayCollection $errors): self
    {
        $this->errors = $errors;

        return $this;
    }

    public function addError(string $error): self
    {
        $this->errors->add($error);

        return $this;
    }

    public function hasErrors(): bool
    {
        return !$this->errors->isEmpty();
    }

    public function getData(): ArrayCollection
    {
        return $this->data;
    }

    public function getDataByKey(string $key)
    {
        return $this->data->get($key);
    }

    public function setData($key, $value): self
    {
        $this->data->set($key, $value);

        return $this;
    }

    public function isSuccess(): bool
    {
        return $this->code < 400;
    }

    public function runEvents(): bool
    {
        return $this->runEvents;
    }

    public function cancelEvents(): void
    {
        $this->runEvents = false;
    }

    public function setValueData(string $message, array $data, int $code = 200): self
    {
        $this->setMessage($message);
        $this->setCode($code == 0 ? 500 : $code);

        if ($this->isSuccess()) {
            $this->setStatus(self::SUCCESS);
            foreach ($data as $key => $value) {
                $this->setData($key, $value);
            }
        } else {
            $this->setStatus(self::FAILED);
            foreach ($data as $error) {
                $this->addError($error);
            }
        }

        return $this;
    }
}
