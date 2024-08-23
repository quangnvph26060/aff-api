<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RequestApi extends Enum
{
    const API = 'api';
    const WEB = 'web';
    const T_ACTIVE = 1;
}
