<?php

namespace App\Controller\Backend;

use App\Entity\Dish;
use App\Entity\DishGroup;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DishController extends BaseController
{
    /**
     * @Route("/backend/dishes", name="backend_dish_list")
     */
    public function listDishes()
    {
        $this->preDispatch();

        $this->templateVars["speisekarte"] = $this->getDoctrine()->getRepository(Dish::class)->getAllDishes();
        $this->templateVars["title"] = 'Übersicht Speisekarte';

        return $this->render('backend/dish/list.html.twig', $this->templateVars);
    }

    /**
     * @Route("/backend/dish/{number}", name="backend_dish_edit", defaults={"number"="new"})
     */
    public function editDish($number, Request $request)
    {
        $this->preDispatch();

        if($number == "new" || empty($number)) {
            $dish = new Dish();
        } else {
            $dish = $this->getDoctrine()->getManager()->getRepository(Dish::class)->findOneBy(["number" => $number]);
        }

        $dishForm = $this->createDishForm($dish);
        $dishForm->handleRequest($request);

        if ($dishForm->isSubmitted() && $dishForm->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dish);
            $entityManager->flush();

            $this->templateVars["successMessage"] = sprintf("Artikel %s Erfolgreich gespeichert!", $dish->getNumber());

            $this->redirectToRoute('backend_dish', ["number" => $dish->getNumber()]);
        }

        $this->templateVars["dishForm"] = $dishForm->createView();
        $this->templateVars["title"] = 'Artikel bearbeiten';

        return $this->render('backend/dish/dish.html.twig', $this->templateVars);
    }

    /**
     * @Route("/backend/dish/delete/{number}", name="backend_dish_delete")
     */
    public function deleteDish($number)
    {
        $this->preDispatch();
        $dish = $this->getDoctrine()->getRepository(Dish::class)->findOneBy(["number" => $number]);

        $this->getDoctrine()->getManager()->remove($dish);
        $this->getDoctrine()->getManager()->flush();

        $this->templateVars["successMessage"] = "Artikel Nummer $number gelöscht!";

        $this->redirectToRoute('backend_dish_list', $this->templateVars);
    }

    protected function createDishForm($dish)
    {
        $form = $this->createFormBuilder($dish)
            ->add('number', IntegerType::class)
            ->add('name', TextType::class, [
                'label' => 'Name'
            ])
            ->add('description', TextType::class, [
                'label' => 'Beschreibung'
            ])
            ->add('DishGroup', EntityType::class, [
                'class' => DishGroup::class,
                'choice_label' => 'name',
                'label' => 'Gruppe'
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Preis'
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Speichern'
            ]);

        return $form->getForm();
    }
}