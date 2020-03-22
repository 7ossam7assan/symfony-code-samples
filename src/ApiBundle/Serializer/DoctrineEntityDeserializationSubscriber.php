<?php
/**
 * Created by PhpStorm.
 * User: hossam
 * Date: 11/21/18
 * Time: 9:22 PM
 */

namespace ApiBundle\Serializer;


use ApiBundle\Annotation\DeserializeEntity;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\Reader;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\EventDispatcher\PreDeserializeEvent;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DoctrineEntityDeserializationSubscriber implements EventSubscriberInterface
{

    private $annotationReader;
    /**
     * @var Registry
     */
    private $registry;

    public function __construct(Reader $annotationReader,\Doctrine\Common\Persistence\ManagerRegistry $registry)
    {

        $this->annotationReader = $annotationReader;
        $this->registry = $registry;
    }

    public static function getSubscribedEvents()
    {

        return[

            [
                'event' => 'serializer.pre_deserialize',
                'method' => 'onPreDeserialize',
                'format' => 'json'
            ],
            [
                'event' => 'serializer.post_deserialize',
                'method' => 'onPostDeserialize',
                'format' => 'json'
            ]
        ];
    }

    public function onPreDeserialize(PreDeserializeEvent $deserializeEvent){

//        dump($deserializeEvent->getType(),$deserializeEvent->getData());die();


        $deserializedType=$deserializeEvent->getType()["name"];//to get class name of entity from request
        if (!class_exists($deserializedType)){
            return;
        }
        $data=$deserializeEvent->getData();//return request body
        $class=new \ReflectionClass($deserializedType);//reflection give us all info about a class and we can many things on it look in php reflection
        foreach ($class->getProperties() as $property){
            if (!isset($data[$property->name])){
                continue;//data not in request body dont do any thing and continue cuase we may not send all properties in request
            }
//            dump($property->getName());
            $annotation=$this->annotationReader->getPropertyAnnotation(
              $property,DeserializeEntity::class
            );
            if (null === $annotation || !class_exists($annotation->type)){
                continue;
            }
//            dump($data[$property->name]);die();

            $data[$property->name]=[
                $annotation->idField => $data[$property->name] //set integer number come from body request  as developer with this id = this integer

            ];
//            dump($data);die();
        }
//        die();
//        dump($class->getProperties());die();

        $deserializeEvent->setData($data);

    }
    public function onPostDeserialize(ObjectEvent $objectEvent){
//        dump($objectEvent);
        $deserializedObjectName=$objectEvent->getType()['name'];
        if (!class_exists($deserializedObjectName)){
            return null;
        }
        $deserializedObject=$objectEvent->getObject();
//        dump($deserializedObject);die();
        $reflection=new \ReflectionObject($deserializedObject);
//        dump($annotation->type);die();

        foreach ($reflection->getProperties() as $property){
            $annotation=$this->annotationReader->getPropertyAnnotation(
                $property,DeserializeEntity::class
            );
//            dump($annotation->type);die();
            if (null === $annotation || !class_exists($annotation->type)){
                continue;
            }
            if (!$reflection->hasMethod($annotation->setter)){
                throw new \LogicException("the Object {$reflection->getName()} doesn't have method {$annotation->setter}");
            }
            $property->setAccessible(true); //can access private variables (properties)
            $deserialized_Property=$property->getValue($deserializedObject);
            if (null === $deserialized_Property){
                return;
            }
            $entityId=$deserialized_Property->{$annotation->idGetter}();
            $repo=$this->registry->getRepository($annotation->type);
            $entity=$repo->find($entityId);
            if (null === $entity){
                throw new NotFoundHttpException(
                    "Resource {$reflection->getShortName()}/$entityId Not Found"
                );
            }
            $deserializedObject->{$annotation->setter}($entity);

        }
    }


}