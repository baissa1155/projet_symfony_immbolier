<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\BiensImmobiliers;
use App\Entity\Chambres;
use App\Entity\Quartier;
use App\Entity\TypesLogements;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class BiensImmobiliersController extends AbstractController
{

    #[Route('/biens', name: 'biens_immobiliers')]
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(BiensImmobiliers::class);
        $biens = $repo->findAll();

        return $this->render('biens_immobiliers/biens.html.twig', [
            'controller_name' => 'BiensImmobiliersController',
            'biens' => $biens
        ]);
    }

    #[Route('/nouveau/bien', name: 'nouveau_bien')]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $bienImmobilier = new BiensImmobiliers();

        $formBien = $this->createFormBuilder($bienImmobilier)
            ->add('typesLogements', EntityType::class, [
                'class' => TypesLogements::class,
                'choice_label' => 'nom_type',
                'label' => 'Types de Logements'
            ])
            ->add('quartier', EntityType::class, [
                'class' => Quartier::class,
                'choice_label' => 'nom_quartier',
                'label' => 'quartier'
            ])
            ->add('description')
            ->add('localite')
            ->add('rue_et_numero')
            ->add('prix')
            ->add('revenue_cadestral')
            ->add('surface')
            ->add('pieces')
            ->add('parking')
            ->add('meuble')
            ->add('jardin')
            ->add('a_vendre')
            ->add('a_louer')
            ->add('photo_du_bien', FileType::class, [
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ])

            ->add('chambres', EntityType::class, [
                'class' => Chambres::class,
                'choice_label' => 'nombre',
                'label' => 'Nombre de chambres'
            ])

            ->getForm();

        $formBien->handleRequest($request);
        dump($bienImmobilier);

        if ($formBien->isSubmitted() && $formBien->isValid()) {
            $bienImmobilier->setDateSoumis(new \DateTime());

            $manager->persist($bienImmobilier);
            $manager->flush();

            return $this->redirectToRoute('show_bien', ['id' => $bienImmobilier->getId()]);
        }

        return $this->render('biens_immobiliers/nouveau_bien.html.twig', [
            'formBiens' => $formBien->createView()
        ]);
    }

    #[Route('/biens/{id}', name: 'show_bien')]
    public function show($id): Response
    {
        $repos = $this->getDoctrine()->getRepository(BiensImmobiliers::class);

        $bien = $repos->find($id);

        return $this->render('biens_immobiliers/show.html.twig', [
            'bien' => $bien
        ]);
    }
    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        $repo = $this->getDoctrine()->getRepository(BiensImmobiliers::class);
        $biens = $repo->findAll();

        return $this->render('biens_immobiliers/contact.html.twig', [
            'controller_name' => 'BiensImmobiliersController',
            'biens' => $biens
        ]);
    }
}
