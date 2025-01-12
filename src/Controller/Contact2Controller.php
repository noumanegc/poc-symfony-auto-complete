<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\Contact2Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Contact2Controller extends AbstractController
{
    #[Route('/contact2', name: 'app_contact2')]
    public function index(Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(Contact2Type::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // ...
        }

        return $this->render('contact2/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/contact2/subjects', name: 'app_contact2_subjects')]
    public function subjects(Request $request): JsonResponse
    {
        $search = $request->query->get('q', '');

        // Liste statique pour l'exemple
        $subjects = [
            ['id' => 1, 'text' => 'Question technique'],
            ['id' => 2, 'text' => 'Demande de devis'],
            ['id' => 3, 'text' => 'Support client'],
            ['id' => 3, 'text' => 'Support client2'],
        ];

        $filtered = array_filter($subjects, function ($subject) use ($search) {
            return empty($search) || str_contains(
                strtolower($subject['text']),
                strtolower($search)
            );
        });

        return $this->json([
            'results' => array_values($filtered),
            'pagination' => [
                'more' => false
            ]
        ]);
    }
}
