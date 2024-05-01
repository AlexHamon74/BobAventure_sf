<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function list(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findBy([], ['publishedAt' => 'DESC'], 3);

        return $this->render('index/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/actus/{id}' ,name:'index_article')]
    public function article(Article $article): Response
    {
        return $this->render('', [
            'article' => $article,
        ]);
    }
}
