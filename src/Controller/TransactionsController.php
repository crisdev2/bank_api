<?php

namespace App\Controller;

use App\Entity\Transactions;
use App\Repository\AccountsRepository;
use App\Repository\TransactionsRepository;
use App\Repository\CustomerRepository;
use App\Repository\StatusRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class TransactionsController extends AbstractController
{
    #[Route('/transactions', name: 'transactions_index', methods: ['GET'])]
    public function index(
        TransactionsRepository $repository,
    ): JsonResponse
    {
        $records = $repository->findAll();

        return $this->json([
            'msg' => 'Records returned',
            'records' => $records,
        ]);
    }

    #[Route('/transactions', name: 'transactions_create', methods: ['POST'])]
    public function create(
        Request $request,
        EntityManagerInterface $em,
        CustomerRepository $customerRepository,
        AccountsRepository $accountsRepository,
        StatusRepository $statusRepository,
    ): JsonResponse
    {
        $data = json_decode($request->getContent());
        $record = new Transactions();
        $idAccount = $accountsRepository->find($data->idAccount);
        $finalBalance = $idAccount->getBalance() - $data->value;

        $record->setIdCustomer($customerRepository->find($data->idCustomer));
        $record->setIdAccount($idAccount);
        $record->setTradeName($data->tradeName);
        $record->setValue($data->value);
        $record->setCurrentBalance($idAccount->getBalance());
        $record->setFinalBalance($finalBalance);
        $record->setCreated(new DateTime());
        $record->setIdStatus($statusRepository->find(1));

        $em->persist($record);
        $em->flush();

        return $this->json([
            'msg' => 'Record added',
            'record' => $record,
        ]);
    }

    #[Route('/transactions/{id}/approve', name: 'transactions_approve', methods: ['PUT'])]
    public function approve(
        EntityManagerInterface $em,
        TransactionsRepository $repository,
        StatusRepository $statusRepository,
        $id
    ): JsonResponse
    {        
        $record = $repository->findOneBy(['id' => $id]);
        $record->setIdStatus($statusRepository->find(2));

        $idAccount = $record->getIdAccount();
        $idAccount->setBalance($idAccount->getBalance() - $record->getValue());

        $em->persist($idAccount);
        $em->persist($record);
        $em->flush();

        return $this->json([
            'msg' => 'Record approve',
            'record' => $record,
        ]);
    }

    #[Route('/transactions/{id}/decline', name: 'transactions_decline', methods: ['PUT'])]
    public function decline(
        EntityManagerInterface $em,
        TransactionsRepository $repository,
        StatusRepository $statusRepository,
        $id
    ): JsonResponse
    {        
        $record = $repository->findOneBy(['id' => $id]);
        $record->setIdStatus($statusRepository->find(3));

        $em->persist($record);
        $em->flush();

        return $this->json([
            'msg' => 'Record declined',
            'record' => $record,
        ]);
    }

    #[Route('/transactions/{id}', name: 'transactions_delete', methods: ['DELETE'])]
    public function delete(
        EntityManagerInterface $em,
        TransactionsRepository $repository,
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
