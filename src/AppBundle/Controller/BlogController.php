<?php
/**
 * Created by PhpStorm.
 * User: jean-philippeblond
 * Date: 09/11/2016
 * Time: 10:04
 */
namespace AppBundle\Controller;


use AppBundle\Entity\Article;
use AppBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Form\ArticleForm;
use AppBundle\Form\CommentForm;

class BlogController extends Controller
{

    /**
     * @Route("/")
     */
    public function homeAction()
    {
        return $this->redirectToRoute('articles');
    }

    /**
     * @Route("login")

    public function loginAction()
    {
        return $this->render("FOSUserBundle::layout.html.twig", []);
    }*/

    /**
     * @Route("/articles", name="articles")
     */
    public function indexAction()
    {
        $articleService = $this->get('app.article');
        $articles = $articleService->getArticlesOrderByDate();

        return $this->render("blog/articles.html.twig", ['articles' => $articles]);
    }

    /**
     * @Route("/article/get/{id}", name="article_show")
     */
    public function getAction(Request $request, $id)
    {
        /* existing comments */
        $articleService = $this->get('app.article');
        $article = $articleService->getOneArticle(['id' => $id]);
        /* Handling Comment creation */
        $comment = new Comment();
        $formComment = $this->createForm(CommentForm::class, $comment);
        $formComment->handleRequest($request);
        if ($formComment->isSubmitted() && $formComment->isValid())
        {
            $commentService = $this->get('app.comment');
            $comment->setDate(new \DateTime());
            $comment->setArticle($article);
            $commentService->createComment($comment);
        }

        return $this->render("blog/article.html.twig", ['article' => $article, 'formComment' => $formComment->createView(), 'comments' => $article->getComments()]);
    }

    /**
     * @Route("/article/create", name="create")
     */
    public function createAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleForm::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $articleService = $this->get('app.article');
            $articleService->createArticle($article);
            return $this->redirectToRoute('articles');
        }

        return $this->render("blog/article-add.html.twig", ['form' => $form->createView()]);
    }

    /**
     * @Route("/article/update/{id}", name="article_update")
     */
    public function updateAction(Request $request, $id)
    {
        $articleService = $this->get('app.article');
        $article = $articleService->getOneArticle(['id' => $id]);
        $form = $this->createForm(ArticleForm::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $articleService->updateArticle($article);
            return $this->redirectToRoute('articles');
        }

        return $this->render("blog/article-update.html.twig", ['form' => $form->createView()]);
    }

    /**
     * @Route("/article/delete/{id}", name="delete")
     */
    public function deleteAction($id)
    {
        $articleService = $this->get('app.article');
        $article = $articleService->getOneArticle(['id' => $id]);
        $articleService->deleteArticle($article);

        return $this->redirectToRoute('articles');
    }

}