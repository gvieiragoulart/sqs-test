<?php

namespace App\DTO\Sqs\Message;

use App\DTO\DTO;
use Illuminate\Contracts\Validation\Validator;

class MessageDTO extends DTO {

    public function __construct(
        public readonly int $delaySeconds = 10,
        public readonly string $title = "",
        public readonly string $author = "",
        public readonly string $weeksOn = "6",
        public readonly string $body = ""
    ){
        $this->validate();
    }

    public function rules(): array
    {
        return [];
        /**return [
            'titulo' => 'required|string|min:10|max:60'
        ];*/
    }

    public function messages(): array
    {
        return [];
        /**return [
            'titulo' => 'Você precisa definir um título entre 10 e 60 caracteres.'
        ];*/
    }

    public function validator(): Validator
    {
        return validator($this->toArray(), $this->rules(), $this->messages());

    }

    public function validate(): array
    {
        return $this->validator()->validate();
    }
}