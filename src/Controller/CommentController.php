<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\User;
use App\Form\CommentType;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class CommentController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/ajouter-un-commentaire/{id}", name="comment")
     */
    public function index(Request $request, $id): Response
    {
        $comment = new Comment;
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $date = new \DateTime();

            /** Récupérer l'entité Product et rechercher le produit par son id passé en paramètre */
            $entityManager = $this->getDoctrine()->getManager();
            $product = $entityManager->getRepository(Product::class)->find($id);

            /** Récupérer l'entité User grâce à la fonction getUser */
            $user = $this->getUser();

            /** Récupérer les données issues du formulaire */
            $comment = $form->getData();
            $comment->setCreatedAt($date);
            $comment->setProduct($product);   // On assigne la relation avec l'entité Product
            $comment->setUser($user);         // On assigne la relation avec l'entité User
          
            // dd($comment);

            $this->entityManager->persist($comment);
            $this->entityManager->flush();
            
            return $this->redirectToRoute('products');

        }

        return $this->render('comment/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
