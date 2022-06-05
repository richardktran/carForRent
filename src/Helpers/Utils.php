<?php

namespace Khoatran\CarForRent\Helpers;

trait Utils
{
    public function hashPassword($password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}
