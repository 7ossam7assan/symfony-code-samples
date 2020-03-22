<?php
/**
 * Created by PhpStorm.
 * User: hossam
 * Date: 12/4/18
 * Time: 9:32 PM
 */

namespace PagesBundle\Enums;


abstract  class PageActiveTypeEnum
{

    const TYPE_NOT_ACTIVE = "Not Active";
    const TYPE_ACTIVE = "Active";

    /** @var array user friendly named type */
    protected static $typeName = [
        self::TYPE_NOT_ACTIVE => 'Not Active',
        self::TYPE_ACTIVE  => 'Active',
    ];

    /**
     * @param  string $typeShortName
     * @return string
     */
    public static function getTypeName($typeShortName)
    {
        if (!isset(static::$typeName[$typeShortName])) {
            return "Unknown type ($typeShortName)";
        }

        return static::$typeName[$typeShortName];
    }

    /**
     * @return array<string>
     */
    public static function getAvailableTypes()
    {
        return [
            self::TYPE_NOT_ACTIVE,
            self::TYPE_ACTIVE,

        ];
    }
}