<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;

class OpenAIService
{
    protected string $model;

    public function __construct()
    {
        $this->model = 'gpt-3.5-turbo';
    }

    public function prompt(string $content)
    {
        $response = OpenAI::chat()->create([
            'model' => $this->model,
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $content
                ],
            ],
        ]);

        return $response->choices[0]->message->content;
    }
}
