<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
Use App\Repository\CategoryArticleRepository;
use App\Entity\CategoryArticle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    private $repoArticle;
    private $repoCategory;

    public function __construct(ArticleRepository $repoArticle, CategoryArticleRepository $repoCategory  )
    {
        $this->repoArticle = $repoArticle;
        $this->repoCategory = $repoCategory;
    }

    /**
     * @Route("/actualites", name="blog")
     */
public function index(): Response
    {
        $articles = $this->repoArticle->findAll();
        $categories = $this->repoCategory->findAll();
        // dd($categories);
        return 
            $this->render("blog/index.html.twig", [
            'articles' => $articles,
            'categories' => $categories,
        ]);

    }

    /**
     * @Route("/actualite/{id}", name="show")
     */
    public function show(Article $article): Response
    {
        if (!$article) {
            return $this->redirectToRoute('blog');
        }
        // dd($article);
        return $this->render("blog/show.html.twig", [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/details_categorie/{id}", name="categoryDetails")
     */
    public function showArticle(?CategoryArticle $category): Response
    {
        $categories = $this->repoCategory->findAll();

        if ($category) {            
            $articles = $category->getArticles()->getValues();
        } else {
            return $this->redirectToRoute('blog');
        };      
            // dd($articles);    
            return $this->render("blog/index.html.twig", [
                'articles' => $articles,
                'categories' => $categories,
            ]);
    }
}
