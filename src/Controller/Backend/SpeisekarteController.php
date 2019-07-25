<?php

namespace App\Controller\Backend;

use App\Entity\Dish;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SpeisekarteController extends BaseController
{
    /**
     * @Route("/backend/speisekarte", name="backend_speisekarte")
     */
    public function index()
    {
        $this->preDispatch();

        $this->templateVars["speisekarte"] = $this->getDoctrine()->getRepository(Dish::class)->getSpeisekarte();
        $this->templateVars["title"] = 'Übersicht Speisekarte';

        return $this->render('backend/speisekarte/index.html.twig', $this->templateVars);
    }

    /**
     * @Route("/backend/artikel/{number}", name="backend_dish")
     */
    public function editDish($number, Request $request)
    {
        $this->preDispatch();

        $dish = $this->getDoctrine()->getRepository(Dish::class)->findOneBy(["number" => $number]);

        $form = $this->createFormBuilder($dish)
            ->add('number', IntegerType::class, ['label' => 'Nummer'])
            ->add('name', TextType::class, ['label' => 'Name'])
            ->add('description', TextType::class, ['label' => 'Beschreibung'])
            ->add('price', MoneyType::class, ['label' => 'Preis'])
            ->add('save', SubmitType::class, ['label' => 'Speichern'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            /** @var Dish $data */
            $data = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($data);
            $entityManager->flush();

            $this->templateVars["successMessage"] = "Erfolgreich gespeichert!";

            $this->redirectToRoute('backend_dish', ["number" => $data->getNumber()]);
        }

        $this->templateVars["form"] = $form->createView();
        $this->templateVars["title"] = 'Übersicht Speisekarte';

        return $this->render('backend/speisekarte/dish.html.twig', $this->templateVars);
    }
}