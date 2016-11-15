<?php
/**
 * Created by PhpStorm.
 * User: jean-philippeblond
 * Date: 15/11/2016
 * Time: 10:00.
 */

namespace AppBundle\Twig;

use AppBundle\Repository\CategoryRepository;
use Doctrine\ORM\EntityManager;

class AppExtension extends \Twig_Extension
{
    private $repoCategory;

    public function __construct(EntityManager $entityManager, CategoryRepository $categoryRepository)
    {
        $this->repoCategory = $categoryRepository;
    }

    public function getGlobals()
    {
        $categories = $this->repoCategory->findAll();

        return ['categories' => $categories];
    }

    public function getName()
    {
        return 'app_extension';
    }
}
