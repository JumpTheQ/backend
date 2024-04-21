<?php

namespace App\Enum;

use App\Traits\EnumsToArrayTrait;

enum SectionType: string
{
    use EnumsToArrayTrait;

    case PARAGRAPH = 'paragraph';

    case SKILLS = 'skills';

    case ABOUT = 'about';
}
