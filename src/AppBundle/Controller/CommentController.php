<?php
/**
 * Created by PhpStorm.
 * User: jean-philippeblond
 * Date: 10/11/2016
 * Time: 14:06.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    /**
     * @Route("/comment/generate/{id}")
     */
    public function generateAction($id)
    {
        $nb = mt_rand(0, 100);
        $articleId = $id;

        $comment = new Comment();
        $comment->setAuthor('JP');
        $comment->setContent('Hello World 0'.$nb);
        $comment->setDate(new \DateTime());

        $articleService = $this->get('app.article');
        $article = $articleService->getOneArticle(['id' => $articleId]);
        $comment->setArticle($article);

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->persist($comment);
        $em->flush();

        return new Response('Commentaire généré');
    }
}
