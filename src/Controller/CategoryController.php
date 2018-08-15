<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Validation\Article;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Validation;

class CategoryController extends AbstractController
{
    /**
     * @Route("/categories", name="category_list")
     */
    public function indexAction()
    {
        $repo = $this->getDoctrine()->getRepository(Category::class);

        $categories = $repo->findAll();

        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/category/create", name="category_create")
     * @Route("/category/{id}/edit/", name="category_edit")
     */
    public function form(Category $category = null, Request $request, ObjectManager $manager)
    {
        if (!$category){
            $category = new Category();
        }

        $form = $this->createFormBuilder($category)
                     ->add('name')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            if(!$category->getId()){
                $category->SetCreateDate(new \DateTime());
            }

            $manager->persist($category);
            $manager->flush();

            return $this->redirectToRoute('category_list');
            
        }
        
        return $this->render('category/create.html.twig', [
            'formCategory' => $form->createView(),
            'editMode' => $category->getId() !== null,
        ]);
    }

    /**
     * @Route("/category/delete/{id}", name="category_delete")
     */
    public function deleteAction(Request $request)
    {
    }
}
