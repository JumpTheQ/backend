<?php

namespace App\Actions;

use App\Enum\PromptableType;
use App\Models\Prompt;
use App\Services\OpenAIService;
use Illuminate\Support\Facades\Log;

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
                foreach($promptable->sections()->get() as $section) {
                    $section->delete();
                }
                $jsonString = $this->openAiService->prompt($prompt->content);
                $promptable->sections()->create([
                    'content' => join(' ', array_map(function ($item) {
                        return "#{$item}";
                    }, json_decode($jsonString)->{"skills"})),
                    'type' => 'skills',
                    'user_id' => $promptable->user_id,
                    'order' => 0,
                ]);
                $promptable->sections()->create([
                    'content' => json_decode($jsonString)->{"about"},
                    'type' => 'about',
                    'user_id' => $promptable->user_id,
                    'order' => 1,
                ]);
                break;
            case PromptableType::COVERLETTER->value:
                foreach($promptable->sections()->get() as $section) {
                    $section->delete();
                }
                $output = $this->openAiService->prompt($prompt->content);

                foreach(explode("\n\n", $output) as $index => $line) {
                    $promptable->sections()->create([
                        'content' => $line,
                        'type' => 'paragraph',
                        'user_id' => $promptable->user_id,
                        'order' => $index + 1,
                    ]);
                }
                break;
            case PromptableType::SECTION->value:
                $promptContent = <<<END
                Everything that I'm about to say, is related to this content: {$promptable->content}

                {$prompt->content}
END;

                $output = $this->openAiService->prompt($promptContent);
                $promptable->update(['content' => $output]);
                break;
        }
    }
}
