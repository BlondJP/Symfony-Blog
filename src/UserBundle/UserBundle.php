<?php
/**
 * Created by PhpStorm.
 * User: jean-philippeblond
 * Date: 14/11/2016
 * Time: 14:09.
 */

namespace UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class UserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
