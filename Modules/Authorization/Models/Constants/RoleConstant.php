<?php

namespace Modules\Authorization\Models\Constants;

class RoleConstant
{
    public const DEVELOPER = "developer";
    public const ADMIN = "admin";
    public const SELLER = "seller";
    public const CUSTOMER = "customer";

    public static array $getRoles = [
        self::DEVELOPER,
        self::ADMIN,
        self::SELLER,
        self::CUSTOMER,
    ];
}
