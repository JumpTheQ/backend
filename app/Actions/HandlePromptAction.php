<?php

namespace App\Actions;

use App\Enum\PromptableType;
use App\Models\Prompt;
use App\Services\OpenAIService;

class HandlePromptAction
{
    public function __invoke(Prompt $prompt): void
    {
        $openAI = new OpenAIService();
        $promptable = $prompt->promptable;

        switch ($prompt->promptable_type) {
            case PromptableType::RESUME->value:
            case PromptableType::COVERLETTER->value:
                foreach($promptable->sections()->get() as $section) {
                    $section->delete();
                }
                $output = $openAI->prompt($prompt->content);

                foreach(explode("\n\n", $output) as $index => $line) {
                    $promptable->sections()->create([
                        'content' => $line,
                        'user_id' => $promptable->user_id,
                        'order' => $index + 1,
                    ]);
                }
                break;
            case PromptableType::SECTION->value:
                $output = $openAI->prompt($prompt->content);
                $promptable->update(['content' => $output]);
                break;
        }
    }
}
