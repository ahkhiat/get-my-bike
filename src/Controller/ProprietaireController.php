<?php

namespace App\Controller;

use App\Entity\Proprietaire;
use App\Entity\Moto;
use App\Entity\User;
use App\Form\ProprietaireType;
use App\Repository\ProprietaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/proprietaire')]
class ProprietaireController extends AbstractController
{
    #[Route('/', name: 'app_proprietaire_index', methods: ['GET'])]
    public function index(ProprietaireRepository $proprietaireRepository): Response
    {
        return $this->render('proprietaire/index.html.twig', [
            'proprietaires' => $proprietaireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_proprietaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $proprietaire = new Proprietaire();
        $form = $this->createForm(ProprietaireType::class, $proprietaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($proprietaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_proprietaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('proprietaire/new.html.twig', [
            'proprietaire' => $proprietaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_proprietaire_show', methods: ['GET'])]
    public function show(Proprietaire $proprietaire, Moto $moto): Response
    {
        return $this->render('proprietaire/show.html.twig', [
            'proprietaire' => $proprietaire,
            'moto' => $moto,
        ]);
    }

    #[Route('/public/{id}', name: 'app_proprietaire_show_public', methods: ['GET'])]
    public function show_p(User $user, Proprietaire $proprietaire): Response
    {
        return $this->render('proprietaire/show_p.html.twig', [
            'user' => $user,
            'proprietaire' => $proprietaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_proprietaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Proprietaire $proprietaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProprietaireType::class, $proprietaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_proprietaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('proprietaire/edit.html.twig', [
            'proprietaire' => $proprietaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_proprietaire_delete', methods: ['POST'])]
    public function delete(Request $request, Proprietaire $proprietaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$proprietaire->getId(), $request->request->get('_token'))) {
            $entityManager->remove($proprietaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_proprietaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
