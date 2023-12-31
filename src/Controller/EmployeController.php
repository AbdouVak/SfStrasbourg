<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Form\EmployeType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmployeController extends AbstractController
{
    #[Route('/employe', name: 'app_employe')]
    public function index(ManagerRegistry $doctrine): Response{
        $employes = $doctrine->getRepository(Employe::class)->findBy([],["nom"=>"ASC"]);
        return $this->render('employe/index.html.twig', [
                "employes" => $employes
        ]);
    }

    #[Route('/employe/add', name: 'add_employe')]
    #[Route('/employe/{id}/edit', name: 'edit_employe')]
    public function add(ManagerRegistry $doctrine, Employe $employe = null, Request $request): Response{   
        if(!$employe){
            $employe = new Employe();
        }
        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $employe = $form->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($employe);
            $entityManager->flush();

            return $this->redirectToRoute('app_employe');
        }

        // vue pour afficher formulaire d'ajout
        return $this->render('employe/add.html.twig', [
            'formAddEmploye' => $form->createView(),
            'edit'=> $employe->getId()
        ]);
    }
    
    #[Route('/employe/{id}/delete', name: 'delete_employe')]
    public function delete(ManagerRegistry $doctrine, Employe $employe): Response{   
        $entityManager = $doctrine->getManager();
        $entityManager->remove($employe);
        $entityManager->flush();
        return $this->redirectToRoute('app_employe');
    }

    #[Route('/employe/{id}', name: 'show_employe')]
    public function show(Employe $employe): Response{   
        return $this->render('employe/show.html.twig', [
                "employe" => $employe
        ]);
    }
    
}
