<?php
/**
 * Created by PhpStorm.
 * User: jean-philippeblond
 * Date: 16/11/2016
 * Time: 13:44
 */

namespace AppBundle\Beta;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class BetaListener
{
    // Notre processeur
    protected $betaHTML;

    // La date de fin de la version bêta :
    // - Avant cette date, on affichera un compte à rebours (J-3 par exemple)
    // - Après cette date, on n'affichera plus le « bêta »
    protected $endDate;

    public function __construct(BetaHTML $betaHTML, $endDate)
    {
        $this->betaHTML = $betaHTML;
        $this->endDate  = new \Datetime($endDate);
    }

    // L'argument de la méthode est un FilterResponseEvent
    public function processBeta(FilterResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $remainingDays = $this->endDate->diff(new \Datetime())->format('%d');

//        dump($remainingDays); die;

        $remainingDays = intval($remainingDays);
        //dump($remainingDays); die;

        // Si la date est dépassée, on ne fait rien
        if ($remainingDays <= 0) {
            return;
        }

        //dump('lol'); die;

        // On utilise notre BetaHRML
        $response = $this->betaHTML->displayBeta($event->getResponse(), $remainingDays);
        //dump($response); die;

        // On met à jour la réponse avec la nouvelle valeur
       return $event->setResponse($response);
    }

    public function ignoreBeta()
    {

    }
}