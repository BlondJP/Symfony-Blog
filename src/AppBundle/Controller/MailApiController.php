<?php
/**
 * Created by PhpStorm.
 * User: jean-philippeblond
 * Date: 18/11/2016
 * Time: 14:53
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Mail;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use \Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class MailApiController extends Controller
{
    private $serializer;

    public function __construct()
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $this->serializer = new Serializer($normalizers, $encoders);
    }

    /**
     * @return Response
     * @Route("api/mail")
     * @Method({"GET"})
     */
    public function getMails()
    {
        $service = $this->get('app.mail');
        $mails = $service->getAllMails();
        $json = $this->serializer->serialize($mails, 'json');
        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @return Response
     * @Route("api/mail/{id}")
     * @Method({"GET"})
     */
    public function getMail(Mail $mail)
    {
        $json = $this->serializer->serialize($mail, 'json');
        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @return Response
     * @Route("api/mail/{id}")
     * @Method({"DELETE"})
     */
    public function deleteMail(Mail $mail, $id)
    {
        $service = $this->get('app.mail');
        $service->deleteMail($mail);

        $json = $this->serializer->serialize($mail, 'json');
        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @return Response
     * @Route("api/mail")
     * @Method({"POST"})
     */
    public function createMail(Request $request)
    {
        $author = $request->request->get('author');
        $content = $request->request->get('content');
        $target = $request->request->get('target');
        $response = new Response();
        if ($author && $content && $target)
        {
            $service = $this->get('app.mail');
            $mail = $service->createMail($author, $content, $target);
            $json = $this->serializer->serialize($mail, 'json');
            $response->setContent($json);
            $response->headers->set('Content-Type', 'application/json');
        }
        else
        {
            $response->setStatusCode(400);
            $response->setContent("Bad Request, Bad Parameters Given : need : author, content, target");
        }

        return $response;
    }

    /**
     * @return Response
     * @Route("api/mail/{id}")
     * @Method({"PUT"})
     */
    public function updateMail(Mail $mail, Request $request)
    {
        $author = $request->request->get('author');
        $content = $request->request->get('author');
        $target = $request->request->get('target');
        $response = new Response();
        if ($author && $content && $target)
        {
            $service = $this->get('app.mail');
            $mail = $service->updateMail($mail, $author, $content, $target);
            $json = $this->serializer->serialize($mail, 'json');
            $response->setContent($json);
            $response->headers->set('Content-Type', 'application/json');
        }
        else
        {
            $response->setStatusCode(400);
            $response->setContent("Bad Request, Bad Parameters Given : need : author, content, target");
        }

        return $response;
    }

}