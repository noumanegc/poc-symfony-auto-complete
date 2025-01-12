<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\Contact3Type;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Contact3Controller extends AbstractController
{

    #[Route('/contact3', name: 'app_contact3')]
    public function index(Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(Contact3Type::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // ...
        }

        return $this->render('contact3/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/contact3/subjects', name: 'app_contact3_subjects')]
    public function subjects(Request $request): JsonResponse
    {
        $search = $request->query->get('q', '');

        // Liste statique pour l'exemple
        $subjects = [
            ['id' => 1, 'name' => 'Question1 technique'],
            ['id' => 2, 'name' => 'Question2 technique'],
            ['id' => 3, 'name' => 'Question3 technique'],
            ['id' => 4, 'name' => 'Question4 technique'],
            ['id' => 5, 'name' => 'Question5 technique'],
            ['id' => 6, 'name' => 'Question6 technique'],
            ['id' => 7, 'name' => 'Question7 technique'],
            ['id' => 8, 'name' => 'Question8 technique'],
            ['id' => 9, 'name' => 'Question9 technique'],
            ['id' => 10, 'name' => 'Question10 technique'],
            ['id' => 11, 'name' => 'Question11 technique'],
            ['id' => 12, 'name' => 'Question12 technique'],
            ['id' => 13, 'name' => 'Question13 technique'],
            ['id' => 14, 'name' => 'Question14 technique'],
            ['id' => 15, 'name' => 'Question15 technique'],
            ['id' => 16, 'name' => 'Question16 technique'],
            ['id' => 17, 'name' => 'Demande de devis'],
            ['id' => 18, 'name' => 'Support client']
        ];

        $filtered = array_filter($subjects, function ($subject) use ($search) {
            return empty($search) || str_contains(
                strtolower($subject['name']),
                strtolower($search)
            );
        });

        return $this->json([
            'results' => array_values($filtered)
        ]);
    }
}
