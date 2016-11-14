<?php
/**
 * Created by PhpStorm.
 * User: jean-philippeblond
 * Date: 09/11/2016
 * Time: 12:19
 */

namespace AppBundle\Service;

use AppBundle\Repository\ArticleRepository;
use AppBundle\Entity\Article;


use Doctrine\ORM\EntityManager;


class ArticleService
{

    private $em;
    private $repoArticle;

    public function __construct(EntityManager $entityManager, ArticleRepository $articleRepository)
    {
        $this->em = $entityManager;
        $this->repoArticle = $articleRepository;
    }

    public function getArticles()
    {
        $articles = $this->repoArticle->findAll();

        return $articles;
    }

    public function getArticlesOrderByDate()
    {
        $query = $this->repoArticle->createQueryBuilder('p')
            ->orderBy('p.date', 'DESC')
            ->getQuery();
        $articles = $query->getResult();

        return $articles;
    }

    public function getOneArticle($id)
    {
        $article = $this->repoArticle->findOneBy($id);

        return $article;
    }

    public function createArticle($article)
    {
        $article->setDate(new \DateTime('now'));
        $this->em->persist($article);
        $this->em->flush();
    }

    public function updateArticle()
    {
        $this->em->flush();
    }

    public function deleteArticle($article)
    {
        $this->em->remove($article);
        $this->em->flush();
    }

}