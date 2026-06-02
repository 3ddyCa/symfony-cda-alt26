<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CategoryRepository;
use App\Repository\LinkRepository;
use App\Repository\AccountRepository;

final class FetchController extends AbstractController
{   
    public function  __construct(
        private CategoryRepository $categories,
        private LinkRepository $links,
        private AccountRepository $account
    ){}

    #[Route('/fetch', name: 'app_fetch')]
    public function index(): Response
    {


        return $this->render('fetch/index.html.twig', [
            'controller_name' => 'FetchController',
        ]);
    }
}
