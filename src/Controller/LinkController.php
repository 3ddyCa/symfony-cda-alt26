<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\LinkRepository;

final class LinkController extends AbstractController
{
    public function __construct(
        private LinkRepository $linkRepo;
    ){}


    #[Route('/link', name: 'app_link')]
    public function index(): Response
    {
        return $this->render('link/index.html.twig', [
            'controller_name' => 'LinkController',
        ]);
    }
    #[Route('/linksAll', name: 'app_link')]
    public function showAllLink(): Response
    {
        $this->linkRepo = new LinkRepository();

        return $this->render('link/index.html.twig', [
            'controller_name' => 'LinkController',
            'linksList' => $this->fetchAll()
        ]);
    }
    #[Route('/link', name: 'app_link')]
    public function fetchById(): Response
    {
        return $this->render('link/index.html.twig', [
            'controller_name' => 'LinkController',
        ]);
    }


}
