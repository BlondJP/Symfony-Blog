<?php
/**
 * Created by PhpStorm.
 * User: jean-philippeblond
 * Date: 16/11/2016
 * Time: 13:37
 */

namespace AppBundle\Beta;

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;


class BetaHTML
{
    // Méthode pour ajouter le « bêta » à une réponse
    public function displayBeta(Response $response, $remainingDays)
    {
        $content = $response->getContent();

        // Code à rajouter
        $betaMention = '<span style="color: #ff0000; font-size: 0.5em;"> - Beta J-' .(int) $remainingDays.' !</span>';


        /* ICI ON PEUT CUSTOMISER LA REPONSE(CONTENT) HTTP*/

        // Modification du contenu dans la réponse
        $response->setContent($content);

        return $response;
    }
}