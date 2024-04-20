<?php

namespace App\Enum;

use App\Traits\EnumsToArrayTrait;

enum PromptableType: string
{
    use EnumsToArrayTrait;

    case COVERLETTER = 'App\Models\CoverLetter';

    case RESUME = 'App\Models\Resume';

    case SECTION = 'App\Models\Section';
}
