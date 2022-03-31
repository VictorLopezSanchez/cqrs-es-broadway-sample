<?php

/**
 *  This file is part of the ProntoPiso software platform.
 *
 *  Copyright (c) 2020 ProntoPiso S.L.
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author ProntoPiso Dev Team <admin@prontopiso.com>
 */

namespace App\Domain\Session\Repository;

use App\Domain\Session\Model\Session;
use App\Domain\Session\Model\ValueObject\SessionId;

interface SessionStoreRepositoryInterface
{
    public function store(Session $session): void;

    public function get(SessionId $id): Session;
}
