<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{

    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // ...
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/contact/subjects', name: 'app_contact_subjects')]
    public function subjects(Request $request): Response
    {
        // Liste de sujets pour l'exemple
        $subjects = [
            ['id' => 1, 'name' => 'Question technique'],
            ['id' => 2, 'name' => 'Demande de devis'],
            ['id' => 3, 'name' => 'Support'],
        ];

        $query = $request->query->get('q', '');
        $filtered = array_filter($subjects, function ($subject) use ($query) {
            return str_contains(
                strtolower($subject['name']),
                strtolower($query)
            );
        });

        return $this->render('contact/_subjects.html.twig', [
            'subjects' => array_values($filtered)
        ]);
    }
}
