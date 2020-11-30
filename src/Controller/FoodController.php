<?php

namespace App\Controller;

use App\Entity\Food;
use App\Form\FoodType;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\FoodRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use DateTime;

class FoodController extends AbstractController
{
    /**
     * create article food
     *
     * @IsGranted("ROLE_USER")
     * @Route("/food/new", name="food_create")
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $food = new Food();
        $form = $this->createForm(FoodType::class, $food);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $food->setAuthor($this->getUser());
            $manager->persist($food);
            $manager->flush();  

            $this->addFlash(
                'success',
                "The article <strong>{$food->getName()}</strong> has been saved successfully !"
            );
            return $this->redirectToRoute('food_show', [
                'category' => $food->getCategory(),
                'name'     => $food->getName()
            ]);

        }
        return $this->render('food/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * show category of food
     * 
     *@Route("/food/{category}", name="food")
     * @return Response
     */
    public function index($category, FoodRepository $repo)
    {
         $foods = $repo->findByCategory($category);
         return $this->render('food/index.html.twig', [
             'foods' => $foods,
             'category' => $category
         ]);
    }

    /**
     * for edit the article
     * 
     *@Route("/food/{category}/{name}/edit", name="food_edit")
     *@Security("is_granted('ROLE_USER') and user === food.getAuthor()", message="This article does not belong to you, you cannot edit it")
     * @return Response
     */
    public function edit(Food $food, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(FoodType::class, $food);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

            $manager->persist($food);
            $manager->flush();
             
            $this->addFlash(
                'success',
                "The changes to the article <strong>{$food->getName()}</strong> have been saved !"
            );
            return $this->redirectToRoute('food_show', [
                'category' => $food->getCategory(),
                'name'     => $food->getName()
            ]);

        }

        return $this->render('food/edit.html.twig', [
            'form' => $form->createView(),
            'food'   => $food
        ]);
    }

    /**
     * to show one food
     *
     * @Route("/food/{category}/{name}", name="food_show")
     * 
     * @param Request $request
     * @param EntityManagerInterface $manager
     * 
     * @return Response
     */
    public function show($name, FoodRepository $repo, Request $request, EntityManagerInterface $manager)
    {
        
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        $food = $repo->findOneByName($name);
        if($form->isSubmitted() && $form->isValid())
        {
            $comment->setFood($food)
                    ->setAuthor($this->getUser())
                    ->setCreatedAt(new DateTime('now'));

            $manager->persist($comment);
            $manager->flush();
            
            $this->addFlash(
                'success',
                'Your comment was saved succefully !'
            );
            return $this->redirectToRoute("food", [
                'category' => $food->getCategory()
            ]);
        }
        return $this->render('food/foodShow.html.twig', [
            'food' => $food,
            'form' => $form->createView()
        ]);

    }

    /**
     * delete the article
     *
     *@Route("/food/{category}/{name}/delete", name="food_delete")
     * @Security("is_granted('ROLE_USER') and user == food.getAuthor()", message="you do not have the right to access this resource.")
     * 
     * @param Food $food
     * 
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Food $food, EntityManagerInterface $manager)
    {

        $manager->remove($food);
        $manager->flush();

        $this->addFlash(
            'success',
            "The article <strong>{$food->getName()}</strong> has been deleted !"
        );

        return $this->redirectToRoute("food", [
            'category' => $food->getCategory()
        ]);

    }
    
}
