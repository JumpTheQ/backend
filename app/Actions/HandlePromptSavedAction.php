<?php

namespace App\Actions;

use App\Enum\PromptableType;
use App\Models\Prompt;
use App\Services\OpenAIService;

class HandlePromptSavedAction
{
    protected $openAiService;

    public function __construct()
    {
        $this->openAiService = new OpenAIService();
    }

    public function __invoke(Prompt $prompt): void
    {
        $promptable = $prompt->promptable;

        switch ($prompt->promptable_type) {
            case PromptableType::RESUME->value:
            case PromptableType::COVERLETTER->value:
                foreach($promptable->sections()->get() as $section) {
                    $section->delete();
                }
                $output = $this->openAiService->prompt($prompt->content);

                foreach(explode("\n\n", $output) as $index => $line) {
                    $promptable->sections()->create([
                        'content' => $line,
                        'user_id' => $promptable->user_id,
                        'order' => $index + 1,
                    ]);
                }
                break;
            case PromptableType::SECTION->value:
                $output = $this->openAiService->prompt($prompt->content);
                $promptable->update(['content' => $output]);
                break;
        }
    }
}