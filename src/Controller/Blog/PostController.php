<?php
namespace App\Controller\Blog;

use App\Repository\Post\PostRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PostController extends AbstractController{

    #[Route('/', name: 'post.index', methods: ['GET'])]
    public function index(PostRepository $postRepository)
    {   
        return $this->render('pages/blog/index.html.twig',
        ['posts' => $postRepository->findPublished()]);
    }
}