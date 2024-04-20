<?php

namespace App\Actions;

use App\Models\Application;
use App\Models\CoverLetter;
use App\Models\Prompt;
use App\Models\Resume;
use App\Services\OpenAIService;
use Illuminate\Support\Facades\Log;

class HandleApplicationSavedAction
{
    protected $openAiService;

    public function __construct()
    {
        $this->openAiService = new OpenAIService();
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

        $keywords = join(' ', $keywords);

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

    private function getKeywordsFromJobDescription(string $jobDescription): array
    {
        $keywordsPrompt = <<<END
            Find me the 10 most relevant keywords that I should focus on (while writing my CV and motivation letter),
            from the following job description: {$jobDescription}

            Please return/answer with just a JSON object, that contains an array called 'keywords' with the found keywords
            inside
        END;

        $jsonString = $this->openAiService->prompt($keywordsPrompt);

        return json_decode($jsonString)->{"keywords"};
    }
}
