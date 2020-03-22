<?php
/**
 * Created by PhpStorm.
 * User: hossam
 * Date: 12/4/18
 * Time: 9:32 PM
 */

namespace BlogBundle\Enums;


abstract  class BlogTypeEnum
{

    const TYPE_ARTICLE = "article";
    const TYPE_NEWS  = "news";

    /** @var array user friendly named type */
    protected static $typeName = [
        self::TYPE_ARTICLE => 'article',
        self::TYPE_NEWS  => 'news',
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
            self::TYPE_ARTICLE,
            self::TYPE_NEWS,

        ];
    }
}