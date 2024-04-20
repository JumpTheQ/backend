<?php

namespace App\Actions;

use App\Models\Application;
use App\Models\CoverLetter;
use App\Models\Prompt;
use App\Models\Resume;
use App\Services\OpenAIService;

class HandleApplicationSavedAction
{
    protected $openAiService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAiService = $openAIService;
    }

    public function __invoke(Application $application): void
    {
        $coverLetter = CoverLetter::create([
            'application_id' => $application->id,
            'user_id' => $application->user_id,
        ]);

        Resume::create([
            'application_id' => $application->id,
            'user_id' => $application->user_id,
        ]);

        $keywords = $this->getKeywordsFromJobDescription($application->description);

        $application->updateQuietly(['keywords' => $keywords]);

        $coverLetterPromptContent = <<<END
            Please write me the most outstanding motivation letter for this job offer: {$application->name}

            This is something that describes me quite well: {$application->user->about}

            This is my ambition: {$application->user->about}

            And I want you to focus on these relevant keywords that I took out of the job description: {$keywords}
        END;

        Prompt::create([
            'content' => $coverLetterPromptContent,
            'application_id' => $application->id,
            'user_id' => $application->user_id,
            'promptable_id' => $coverLetter->id,
            'promptable_type' => CoverLetter::class,
        ]);
    }

    private function getKeywordsFromJobDescription(string $jobDescription): string
    {
        $keywordsPrompt = <<<END
            Find me the most relevant keywords of the following job description: {$jobDescription}

            Please return just a JSON string, which contains the array of the found keywords
        END;

        $jsonString = $this->openAiService->prompt($keywordsPrompt);

        return json_decode($jsonString);
    }
}
