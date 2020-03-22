<?php
/**
 * Created by PhpStorm.
 * User: hossam
 * Date: 11/21/18
 * Time: 9:07 PM
 */

namespace ApiBundle\Annotation;

use Doctrine\Common\Annotations\Annotation\Target;

/**
 * @Annotation
 * @Target({"PROPERTY"})// annotation on properties only not methods
 */

final class DeserializeEntity
{

    /**
     * @var string
     * @Required()
     */
    public $type;

    /**
     * @var string
     * @Required()
     */
    public $idField;


    /**
     * @var string
     * @Required()
     */
    public $setter;


    /**
     * @var string
     * @Required()
     */
    public $idGetter;
}