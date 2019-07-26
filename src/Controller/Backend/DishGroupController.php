<?php

namespace App\Controller\Backend;

use App\Entity\DishGroup;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DishGroupController extends BaseController
{
    /**
     * @Route("/backend/groups", name="backend_dish_group_list")
     */
    public function listGroups()
    {
        $this->preDispatch();
        $this->templateVars["dishGroups"] = $this->getDoctrine()->getManager()->getRepository(DishGroup::class)->findAll();

        return $this->render('backend/dish_group/index.html.twig', $this->templateVars);
    }

    /**
     * @Route("/backend/group/edit/{id}", name="backend_dish_group_edit", defaults={"id"="new"})
     */
    public function editGroup($id, Request $request)
    {
        $this->preDispatch();

        if($id == "new" || empty($id)) {
            $dishGroup = new DishGroup();
        } else {
            $dishGroup = $this->getDoctrine()->getManager()->getRepository(DishGroup::class)->find($id);
        }

        $dishForm = $this->createDishGroupForm($dishGroup);
        $dishForm->handleRequest($request);

        if ($dishForm->isSubmitted() && $dishForm->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dishGroup);
            $entityManager->flush();

            $this->templateVars["successMessage"] = sprintf("Gruppe %s Erfolgreich gespeichert!", $dishGroup->getId());

            $this->redirectToRoute('backend_dish_group_edit', ["id" => $dishGroup->getNumber()]);
        }

        $this->templateVars["dishGroupForm"] = $dishForm->createView();
        $this->templateVars["title"] = 'Gruppe bearbeiten';

        return $this->render('backend/dish_group/dish_group.html.twig', $this->templateVars);
    }

    /**
     * @Route("/backend/group/delete", name="backend_dish_group_delete")
     */
    public function deleteGroup()
    {
        $this->preDispatch();

        return $this->render('backend/dish_group/index.html.twig', $this->templateVars);
    }

    private function createDishGroupForm($dishGroup)
    {
        $form = $this->createFormBuilder($dishGroup)
            ->add('name', TextType::class, ['label' => 'Name'])
            ->add('save', SubmitType::class, ['label' => 'Speichern']);

        return $form->getForm();
    }
}