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

use AppBundle\Repository\CommentRepository;
use AppBundle\Entity\Comment;


use Doctrine\ORM\EntityManager;


class CommentService
{

    private $em;
    private $repoComment;

    public function __construct(EntityManager $entityManager, CommentRepository $commentRepository)
    {
        $this->em = $entityManager;
        $this->repoComment = $commentRepository;
    }

    public function getCommentOfAnArticle($article)
    {

    }

    public function createComment($comment)
    {
        $this->em->persist($comment);
        $this->em->flush();
    }

}