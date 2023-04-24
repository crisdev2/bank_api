<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class CustomerController extends AbstractController
{
    #[Route('/customer', name: 'customer_index', methods: ['GET'])]
    public function index(
        CustomerRepository $repository,
    ): JsonResponse
    {
        $records = $repository->findAll();

        return $this->json([
            'msg' => 'Records returned',
            'records' => $records,
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

    #[Route('/customer/{id}', name: 'customer_edit', methods: ['PUT'])]
    public function edit(
        Request $request,
        EntityManagerInterface $em,
        CustomerRepository $repository,
        $id
    ): JsonResponse
    {
        $data = json_decode($request->getContent());
        
        $record = $repository->findOneBy(['id' => $id]);
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
            'msg' => 'Record modified',
            'record' => $record,
        ]);
    }

    #[Route('/customer/{id}', name: 'customer_delete', methods: ['DELETE'])]
    public function delete(
        EntityManagerInterface $em,
        CustomerRepository $repository,
        $id
    ): JsonResponse
    {
        $record = $repository->findOneBy(['id' => $id]);

        $em->remove($record);
        $em->flush();

        return $this->json([
            'msg' => 'Record deleted',
            'record' => $record,
        ]);
    }
}
