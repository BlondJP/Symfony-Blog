<?php
/**
 * Created by PhpStorm.
 * User: jean-philippeblond
 * Date: 16/11/2016
 * Time: 17:12
 */

use AppBundle\Entity\Comment;

class CommentTest extends\PHPUnit_Framework_TestCase
{
    private $comment;

    public function setUp()
    {
        $this->comment = new Comment();

    }

    public function testGetId()
    {
        $this->assertNull($this->comment->getId());
    }



    public function testGetAuthor()
    {
        $this->comment->setAuthor('Sam');
        $this->assertEquals($this->comment->getAuthor(), 'Sam');
    }



}