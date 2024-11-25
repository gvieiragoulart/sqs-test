<?php

namespace App\DTO;

use Illuminate\Contracts\Support\Arrayable;

abstract class DTO implements Arrayable
{
    public function all(): array
    {
        return get_object_vars($this);
    }

    public function toArray(): array
    {
        return $this->all();
    }
}