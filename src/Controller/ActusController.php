<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ActusController extends AbstractController
{
    #[Route('/actus', name: 'actus')]
    public function list(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();


        return $this->render('actus/actus.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/actus/{id}', name:'actus_article')]
    public function article(Article $article): Response
    {
        return $this->render('actus/article.html.twig', [
            'article' => $article,
        ]);

    }
}
