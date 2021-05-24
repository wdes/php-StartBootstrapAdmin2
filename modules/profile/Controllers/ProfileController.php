<?php

declare(strict_types = 1);

namespace WdesAdminModule\profile\Controllers;

use WdesAdmin\AbstractController;
use WdesAdmin\Response;

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, version 2.0.
 * If a copy of the MPL was not distributed with this file,
 * You can obtain one at https://mozilla.org/MPL/2.0/.
 * @license MPL-2.0 https://mozilla.org/MPL/2.0/
 * @source https://github.com/wdes/php-StartBootstrapAdmin2
 */

class ProfileController extends AbstractController
{

    public function authorized(): bool
    {
        return true;
    }

    public function profile(): Response
    {
        $this->addHtml($this->render('@[profile]/profile'));
        return $this->response;
    }

}
