<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
//use Shared\ValidationFailed;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

///**
// * @Route(service="api.controller")
// */
class ApiController extends Controller
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

//    /**
//     * @var ValidatorInterface
//     */
//    private $validator;

    /**
     * @var SerializerInterface
     */
    private $jmsSerializer;

    /**
     * @param EntityManagerInterface $entityManager
     * @param SerializerInterface $jmsSerializer
//     * @param ValidatorInterface $validator
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        SerializerInterface $jmsSerializer
        /*ValidatorInterface $validator*/
    ) {
        $this->jmsSerializer = $jmsSerializer;
        /*$this->validator = $validator;*/
        $this->entityManager = $entityManager;
    }

    /**
     * @param mixed $data    The response data
     * @param int   $status  The status code to use for the Response
     * @param array $headers Array of extra headers to add
     * @param array $context Context to pass to serializer when using serializer component
     *
     * @return JsonResponse
     */
    protected function json($data, $status = 200, $headers = [], $context = [])
    {
        $json = $this->jmsSerializer->serialize($data, 'json');

        return new JsonResponse($json, $status, $headers, true);
    }

//    /**
//     * @param $entity
//     * @throws ValidationFailed
//     */
//    protected function validate($entity)
//    {
//        $errors = $this->validator->validate($entity);
//
//        if ($errorsCount = $errors->count()) {
//
//            $validationException = new ValidationFailed;
//            for ($i = 0; $i < $errorsCount; $i++) {
//
//                $violation = $errors->get($i);
//                $validationException->addViolations([$violation->getPropertyPath() => $violation->getMessage()]);
//            }
//            throw $validationException;
//        }
//    }
}
