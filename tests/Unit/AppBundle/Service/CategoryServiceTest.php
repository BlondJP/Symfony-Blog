<?php
/**
 * Created by PhpStorm.
 * User: jean-philippeblond
 * Date: 16/11/2016
 * Time: 17:32
 */
namespace Test;

use AppBundle\Entity\Category;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Service\CategoryService;
use Doctrine\ORM\EntityManager;
use MockedRepository\CategoryRepositoryMocked;
use MockedService\CategoryServiceMocked;

class CategoryServiceTest extends \PHPUnit_Framework_TestCase
{
    private $service;

    public function setUp()
    {
        $emMock = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()->getMock();
        $categoryRepositoryMock = $this->getMockBuilder(CategoryRepository::class)
            ->disableOriginalConstructor()->getMock();

        $categoryRepositoryMock->method('findAll')->willReturn(array(
            (new Category())->setName('hello')
        ));

        $this->service = new CategoryService($emMock, $categoryRepositoryMock);
    }

    public function testGetCategories()
    {
        $categories = $this->service->getCategories();
        $this->assertEquals('hello', $categories[0]->getName());
    }
}