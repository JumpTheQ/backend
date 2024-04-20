<?php

namespace App\Enum;

use App\Traits\EnumsToArrayTrait;

enum SectionableType: string
{
    use EnumsToArrayTrait;

    case COVERLETTER = 'App\Models\CoverLetter';

    case RESUME = 'App\Models\Resume';
}
