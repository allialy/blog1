<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Form\ArticleType;
use App\Repository\ArticlesRepository;
use Doctrine\DBAL\Types\TextType;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    private $articlesRepository;

    public function __construct(ArticlesRepository $articlesRepository)
    {
        $this->articlesRepository = $articlesRepository;
    }

    /**
     * @Route("/blog", name="blog")
     */
    public function index(): Response
    {
        return $this->render('blog/index.html.twig', [
            'articles'=>$this->articlesRepository->findAll()
        ]);
    }
    /**
     * @Route("/blog/new", name="blog_show")
     */
    public function create(Request $request): Response
    {
        $article = new Articles();
        $form =$this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entity=$this->getDoctrine()->getManager();
            $article= $form->getData();
            $entity->persist($article);
            $entity->flush();
        }
        return $this->renderForm('blog/show.html.twig',[
            'formArticles'=>$form
        ]);
    }
    /**
     * @Route("/blog/{id}", name="blogS")
     */
    public function articleById($id) :Response
    {
        return $this->render('blog/index.html.twig', [
            'article'=>$this->articlesRepository->find($id)
            ]);
    }


}
