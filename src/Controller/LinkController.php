<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\LinkRepository;
use Doctrine\Persistence\ManagerRegistry;

final class LinkController extends AbstractController
{
    public function __construct(
        private LinkRepository $linkRepo
    ){}


    #[Route('/link', name: 'app_link')]
    public function index(): Response
    {
        return $this->render('link/index.html.twig', [
            'Item_type' => 'links',
        ]);
    }
    #[Route('/linkAll', name: 'app_link_All')]
    public function showAllLink(): Response
    {
        $result = $this->linkRepo->findAll();
        foreach($result as $key=>$value){
            $value->setCreatedAt(\DateTimeImmutable::createFromFormat('Y-m-d', $value->getCreatedAt()));
        }
        
        return $this->render('link/index.html.twig', [
            'Item_type' => 'links',
            'linksList' => $result
        ]);
    }
    #[Route('/linkById', name: 'app_link_Id')]
    public function fetchById(int $id): Response
    {
        $result = $this->linkRepo->findById($id);
        $result->setCreatedAt(\DateTimeImmutable::createFromFormat('Y-m-d', $result->getCreatedAt()));
        return $this->render('link/index.html.twig', [
            'Item_type' => 'links',
            'linksList' => $result
        ]);
    }


}
