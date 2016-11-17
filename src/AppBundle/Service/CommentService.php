<?php
/**
 * Created by PhpStorm.
 * User: jean-philippeblond
 * Date: 09/11/2016
 * Time: 12:19.
 */

namespace AppBundle\Service;

use AppBundle\Repository\CommentRepository;
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

    public function addition($a, $b)
    {
        return $a + $b;
    }

    public function testAddition()
    {
        $res = $this->addition(1, 1);
        $this->assertEquals($res, 2, "non égal !");
    }
}
