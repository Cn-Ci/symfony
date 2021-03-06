<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Repository\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAdController extends AbstractController
{
    /**
     * @Route("/admin/ads", name="admin_ads_index")
     */
    public function index(AdRepository $repo): Response
    {
        return $this->render('admin/ad/index.html.twig', [
            'ads' => $repo->findAll()
        ]);
    }

    /**
     * Permet d'afficher le formulaire d'edition
     * 
     * @Route ("admin/ads/{id}/edit", name="admin_ads_edit")
     *
     * @param Ad $ad
     * @return void
     */
    public function edit(Ad $ad, Request $request, EntityManagerInterface $manager){
        $form = $this->createForm(AdType::class, $ad);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce <strong>{$ad->getTitle()}</strong> a bien été modifiée !"
            );
        }

        return $this->render('admin/ad/edit.html.twig', [
            'form' => $form->createView(),
            'ad' => $ad,
        ]);
    }

    /**
     * Permet de supprimer une annonce
     * 
     * @Route("/admin/ads/{id}/delete", name="admin_ads_delete")
     * 
     * @param Ad $ad
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Ad $ad, EntityManagerInterface $manager)
    {

        if(count($ad->getBookings()) > 0){
            $this->addFlash( 
                'danger',
                "Vous ne pouvez pas supprimer l'annonce <strong>{$ad->getTitle()}</strong>, car elle possède déjà des réservations !"
            );
        }
        else {
            $manager->remove($ad);
            $manager->flush();
            $this->addFlash( 
                'success',
                "L'annonce <strong>{$ad->getTitle()}</strong> a bien été supprimé !"
            );
        }
            return $this->redirectToRoute('admin_ads_index');
       
    }

}
