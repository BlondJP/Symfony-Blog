<?php
/**
 * Created by PhpStorm.
 * User: jean-philippeblond
 * Date: 16/11/2016
 * Time: 17:38
 */

namespace MockedRepository;

class CategoryRepositoryMocked
{
    public function findAll()
    {
        $categories = [];
        $categories[0] = new \AppBundle\Entity\Category();
        $categories[1] = new \AppBundle\Entity\Category();
        $categories[2] = new \AppBundle\Entity\Category();
        return $categories;
    }

    public function findOneById($id)
    {
        return new \AppBundle\Entity\Category();
    }
}