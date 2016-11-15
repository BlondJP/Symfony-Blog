<?php
/**
 * Created by PhpStorm.
 * User: jean-philippeblond
 * Date: 14/11/2016
 * Time: 17:23
 */


namespace AppBundle\Controller;


use AppBundle\Entity\Article;
use AppBundle\Entity\Category;
use AppBundle\Entity\Comment;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Form\CommentForm;
use Symfony\Component\HttpFoundation\Response;


class CategoryController extends Controller
{
    /**
     * @Route("/articles/bycategory/{categoryId}", name="articles_by_category")
     */
    public function showArticleByCategory($categoryId)
    {
        $categoryService = $this->get('app.category');
        $category = $categoryService->getCategory($categoryId);

        return $this->render("blog/articles.html.twig", ['articles' => $category->getArticles()]);
    }

    /**
     * @Route("/article/generate")
     */
    public function generateAction()
    {
        $cat = new Category();
        $cat->setName('Diététique');
        $em = $this->getDoctrine()->getManager();
        $em->persist($cat);
        $em->flush();

        return new Response('Catégorie généré');
    }

}

