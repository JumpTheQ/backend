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

        $resume = Resume::create([
            'application_id' => $application->id,
            'user_id' => $application->user_id,
        ]);

        $keywords = $this->getKeywordsFromJobDescription($application->description);

        $application->updateQuietly(['keywords' => $keywords]);

        $userAbout = $application->user->about;
        $userAmbitions = $application->user->ambitions;
        $userSkills = join(' ', $application->user->skills ?? []);
        $applicationKeywords = join(' ', $keywords ?? []);

        $coverLetterPromptContent = <<<END
            Please write me the most outstanding motivation letter for this job offer: {$application->name}

            First, let me walk you through some of the most relevant things about me.

            This describes me quite well: {$userAbout}

            These are my ambitions: {$userAmbitions}

            These are my best skills: {$userSkills}

            Now, with all the personal information you have from me, I want you to leverage the following
            keywords I took out from the job description ({$applicationKeywords}), and write me a stellar
            motivation letter that will help me get me this job.
        END;

        Prompt::create([
            'content' => $coverLetterPromptContent,
            'application_id' => $application->id,
            'user_id' => $application->user_id,
            'generated' => true,
            'promptable_id' => $coverLetter->id,
            'promptable_type' => CoverLetter::class,
        ]);

        $resumePromptContent = <<<END
            Help me write two sections for a personalized CV I'm preparing for this job offer: {$application->name}

            First, let me walk you through some of the most relevant things about me.

            This describes me quite well: {$userAbout}

            These are my ambitions: {$userAmbitions}

            These are my best skills: {$userSkills}

            Now, with all the personal information you have from me, I want you to leverage the following
            keywords I took out from the job description ({$applicationKeywords}), and write me two content sections
            focused on these keywords.

            The first is an about me section with approximately 40 words, and the second one is a skills section,
            with up to 5 hashtags of my best skills that match the supplied keywords and job offer.

            I want you to answer this prompt with a JSON object that contains two properties: `about` and `skills`.
END;

        Prompt::create([
            'content' => $resumePromptContent,
            'application_id' => $application->id,
            'user_id' => $application->user_id,
            'generated' => true,
            'promptable_id' => $resume->id,
            'promptable_type' => Resume::class,
        ]);
    }

    private function getKeywordsFromJobDescription(string $jobDescription): array
    {
        $keywordsPrompt = <<<END
            Find me up to 10 keywords that best represent what I should focus on while writing my CV and motivation letter,
            from the following job description: {$jobDescription}

            Please return/answer with just a JSON object, that contains an array called 'keywords' with the found keywords
            inside
        END;

        $jsonString = $this->openAiService->prompt($keywordsPrompt);

        return json_decode($jsonString)->{"keywords"};
    }
}
