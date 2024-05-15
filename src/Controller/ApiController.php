<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    #[Route('/api/articles', name: 'api_articles')]
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->json(
            $articleRepository->findAll(),
            context: ['groups' => 'articles:read',
            DateTimeNormalizer::FORMAT_KEY =>'d/m/Y'
            ]
        );
    }
}
