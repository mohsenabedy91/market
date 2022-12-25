<?php

namespace Modules\Authorization\Models\Constants;

class PermissionConstant
{
    public const CREATE_ROLE = "create role";
    public const UPDATE_ROLE = "update role";
    public const DELETE_ROLE = "delete role";
    public const GET_ROLE = "get role";

    public const CREATE_PERMISSION = "create permission";
    public const UPDATE_PERMISSION = "update permission";
    public const DELETE_PERMISSION = "delete permission";
    public const GET_PERMISSION = "get permission";

    public const ADD_ROLE_PERMISSION = "add role permission";
    public const UPDATE_PERMISSION_ROLE = "update permission role";
    public const DELETE_PERMISSION_ROLE = "delete permission role";
    public const GET_PERMISSION_ROLE = "get permission role";

    public const ADD_ROLE_USER = "add role user";
    public const UPDATE_USER_ROLE = "update user role";
    public const DELETE_USER_ROLE = "delete user role";
    public const GET_USER_ROLE = "get user role";

    public const ADD_PERMISSION_USER = "add permission user";
    public const UPDATE_USER_PERMISSION = "update user permission";
    public const DELETE_USER_PERMISSION = "delete user permission";
    public const GET_USER_PERMISSION = "get user permission";

    public static array $getPermissions = [
        self::CREATE_ROLE,
        self::UPDATE_ROLE,
        self::DELETE_ROLE,
        self::GET_ROLE,
        self::CREATE_PERMISSION,
        self::UPDATE_PERMISSION,
        self::DELETE_PERMISSION,
        self::GET_PERMISSION,
        self::ADD_ROLE_PERMISSION,
        self::UPDATE_PERMISSION_ROLE,
        self::DELETE_PERMISSION_ROLE,
        self::GET_PERMISSION_ROLE,
        self::ADD_ROLE_USER,
        self::UPDATE_USER_ROLE,
        self::DELETE_USER_ROLE,
        self::GET_USER_ROLE,
        self::ADD_PERMISSION_USER,
        self::UPDATE_USER_PERMISSION,
        self::DELETE_USER_PERMISSION,
        self::GET_USER_PERMISSION,
    ];
}
