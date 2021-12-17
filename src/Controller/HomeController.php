<?php

namespace App\Controller;

use App\Entity\BiensImmobiliers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(BiensImmobiliers::class);
        $biens = $repo->findAll();
        return $this->render('home/page.html.twig', [
            'controller_name' => 'BiensImmobiliersController',
            'biens' => $biens
        ]);
    }
    #[Route('/test', name: 'test')]
    public function test(): Response
    {
        return $this->render('home/page.html.twig');
    }
}
