<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Question;
use App\Form\QuestionFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class FormController extends AbstractController
{
    #[Route('/', name: 'app_form')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $question = new Question();

        $form = $this->createForm(QuestionFormType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if($form->isValid()) {
                $entityManager->persist($question);
                $entityManager->flush();

                $this->addFlash('success', "Köszönjük szépen a kérdésedet. Válaszunkkal hamarosan keresünk a megadott e-mail címen.");
                return $this->redirectToRoute('app_form');
            }
            else {
                $this->addFlash('fail', "Hiba! Kérjük töltsd ki az összes mezőt!");
            }
        }

        return $this->render('form/index.html.twig', [
            'controller_name' => 'FormController',
            'question_form' => $form->createView()
        ]);
    }
}
