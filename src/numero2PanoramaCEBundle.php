<?php

declare(strict_types=1);

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2020 Leo Feyer
 *
 * @package   Panorama Content Element
 * @author    Benny Born <benny.born@numero2.de>
 * @license   LGPL
 * @copyright 2020 numero2 - Agentur für digitales Marketing
 */

namespace numero2\PanoramaCE;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class numero2PanoramaCEBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
