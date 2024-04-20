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
        $promptable = $prompt->promptable();

        switch ($prompt->promptable_type) {
            case PromptableType::RESUME;
            case PromptableType::COVERLETTER:
                foreach($promptable->sections()->get() as $section) {
                    $section->delete();
                }
                $output = $openAI->prompt($prompt->content);

                foreach(explode("\n\n", $output) as $line) {
                    $promptable->sections()->create(['content' => $line]);
                }
                break;
            case PromptableType::SECTION:
                $output = $openAI->prompt($prompt->content);
                $promptable->update(['content' => $output]);
                break;
        }
    }
}
