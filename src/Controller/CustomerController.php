<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Service\RequestService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class CustomerController extends AbstractController
{
    #[Route('/customer', name: 'customer_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CustomerController.php',
        ]);
    }

    #[Route('/customer', name: 'customer_create', methods: ['POST'])]
    public function create(
        Request $request,
        EntityManagerInterface $em,
    ): JsonResponse
    {
        $data = json_decode($request->getContent());
        $record = new Customer();
        $record->setName($data->name);
        $record->setIdnumber($data->idnumber);
        $record->setPhone($data->phone);
        $record->setAge($data->age);
        $record->setAddress($data->address);
        $record->setCity($data->city);
        $record->setOccupation($data->occupation);
        $record->setActive($data->active);

        $em->persist($record);
        $em->flush();

        return $this->json([
            'msg' => 'Record added',
            'record' => $record,
        ]);
    }
}
