<?php
/**
 * Created by PhpStorm.
 * User: jean-philippeblond
 * Date: 16/11/2016
 * Time: 17:33
 */

namespace MockedService;

use MockedRepository\CategoryRepositoryMocked;

class CategoryServiceMocked
{
    //private $em;
    private $repoCategory;

    public function __construct($voidDoNotUse , CategoryRepositoryMocked $categoryRepository)
    {
        //$this->em = $entityManager;
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
