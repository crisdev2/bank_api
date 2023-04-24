<?php

namespace App\Controller;

use App\Entity\Accounts;
use App\Repository\AccountsRepository;
use App\Repository\CustomerRepository;
use App\Service\RequestService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class AccountsController extends AbstractController
{
    #[Route('/accounts', name: 'accounts_index', methods: ['GET'])]
    public function index(
        AccountsRepository $repository,
    ): JsonResponse
    {
        $records = $repository->findAll();

        return $this->json([
            'msg' => 'Records returned',
            'records' => $records,
        ]);
    }

    #[Route('/accounts', name: 'accounts_create', methods: ['POST'])]
    public function create(
        Request $request,
        EntityManagerInterface $em,
        CustomerRepository $customerRepository,
    ): JsonResponse
    {
        $data = json_decode($request->getContent());
        $record = new Accounts();
        $record->setIdCustomer($customerRepository->find($data->idCustomer));
        $record->setNumber($data->number);
        $record->setBalance($data->balance);
        $record->setActivation(new DateTime($data->activation));
        $record->setCity($data->city);
        $record->setCountry($data->country);
        $record->setActive($data->active);

        $em->persist($record);
        $em->flush();

        return $this->json([
            'msg' => 'Record added',
            'record' => $record,
        ]);
    }

    #[Route('/accounts/{id}', name: 'accounts_edit', methods: ['PUT'])]
    public function edit(
        Request $request,
        EntityManagerInterface $em,
        AccountsRepository $repository,
        CustomerRepository $customerRepository,
        $id
    ): JsonResponse
    {
        $data = json_decode($request->getContent());
        
        $record = $repository->findOneBy(['id' => $id]);
        $record->setIdCustomer($customerRepository->find($data->idCustomer));
        $record->setNumber($data->number);
        $record->setBalance($data->balance);
        $record->setActivation(new DateTime($data->activation));
        $record->setCity($data->city);
        $record->setCountry($data->country);
        $record->setActive($data->active);

        $em->persist($record);
        $em->flush();

        return $this->json([
            'msg' => 'Record modified',
            'record' => $record,
        ]);
    }

    #[Route('/accounts/{id}', name: 'accounts_delete', methods: ['DELETE'])]
    public function delete(
        EntityManagerInterface $em,
        AccountsRepository $repository,
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
