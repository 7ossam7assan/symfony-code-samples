<?php
/**
 * Created by PhpStorm.
 * User: hossam
 * Date: 11/22/18
 * Time: 2:07 AM
 */

namespace ApiBundle\Merger;


use Doctrine\Common\Annotations\Reader;
use Doctrine\ORM\Mapping\Id;

class EntityMerger
{


    /**
     * @var Reader
     */
    private $reader;

    public function __construct(Reader $reader)
    {


        $this->reader = $reader;
    }

    public function merge($entity,$changed){



        $entityClass=get_class($entity);// get class name or false if not a class

        if (false === $entityClass)
            return new \InvalidArgumentException("$entity is not a class",500);

        $changedClass=get_class($changed);

        if (false === $entityClass)
            return new \InvalidArgumentException("$changed is not a class",500);

        if (!is_a($changed,$entityClass))
            return new \InvalidArgumentException("cannot merge object of type {$changedClass} with object of type {$entityClass}");

        $entityReflection= new \ReflectionObject($entity);
        $changedEntityReflection= new \ReflectionObject($changed);
        foreach ($changedEntityReflection->getProperties() as $changedProperty){
            $changedProperty->setAccessible(true);
            $changedValue = $changedProperty->getValue($changed);

            //ignore the properties send as null (not sent)
            if (null === $changedValue){
                continue;
            }
            // ignore the properties of changed entity that is not in the original entity
            if (! $entityReflection->hasProperty($changedProperty->getName())){
                continue;
            }

            $entityProperty=$entityReflection->getProperty($changedProperty->getName());
            $annotation = $this->reader->getPropertyAnnotation($entityProperty,Id::class);
            // ignore changes entities that has id annotation as id is not modified
            if (null !== $annotation){
                continue;
            }

            $entityProperty->setAccessible(true);

            $entityProperty->setValue($entity,$changedValue);

        }




    }
}