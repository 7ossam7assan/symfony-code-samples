<?php
/**
 * Created by PhpStorm.
 * User: hossam
 * Date: 11/21/18
 * Time: 12:01 AM
 */

namespace ApiBundle\Exceptions;


use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends HttpException
{


    /**
     * ValidationException constructor.
     * @param ConstraintViolationListInterface $constraintViolations
     */
    public function __construct(ConstraintViolationListInterface $constraintViolations)
    {

        $message=[];
        /**
         * @var ConstraintViolationListInterface $constraintViolation
         */
        foreach ($constraintViolations as $constraintViolation){

            $message[$constraintViolation->getPropertyPath()]=$constraintViolation->getMessage();
        }
        parent::__construct(400, json_encode($message));
    }


}