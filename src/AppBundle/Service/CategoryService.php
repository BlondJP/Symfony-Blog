<?php
/**
 * Created by PhpStorm.
 * User: jean-philippeblond
 * Date: 15/11/2016
 * Time: 09:36
 */

namespace AppBundle\Service;

use AppBundle\Repository\ArticleRepository;
use AppBundle\Entity\Article;

use AppBundle\Repository\CategoryRepository;
use AppBundle\Entity\Category;


use Doctrine\ORM\EntityManager;


class CategoryService
{

    private $em;
    private $repoCategory;

    public function __construct(EntityManager $entityManager, CategoryRepository $categoryRepository)
    {
        $this->em = $entityManager;
        $this->repoCategory = $categoryRepository;
    }

    public function getCategories()
    {
        $categories = $this->repoCategory->findAll();
        return $categories;
    }

    public function getCategory($id)
    {
        $category = $this->repoCategory->findOneBy(['id' => $id]);
        return $category;
    }

}