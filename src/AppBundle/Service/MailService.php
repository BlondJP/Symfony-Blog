<?php

namespace AppBundle\Service;

use AppBundle\Entity\Mail;
use AppBundle\Repository\MailRepository;
use Doctrine\ORM\EntityManager;

class MailService
{
    private $em;
    private $mailRepository;

    public function __construct(EntityManager $em, MailRepository $mailRepository)
    {
        $this->em = $em;
        $this->mailRepository = $mailRepository;
    }

    public function getAllMails()
    {
        $mails = $this->mailRepository->findAll();

        return $mails;
    }

    public function deleteMail($mail)
    {
        $this->em->remove($mail);
        $this->em->flush();
    }

    public function createMail($author, $content, $target)
    {
        $mail = new Mail();
        $mail->setAuthor($author);
        $mail->setContent($content);
        $mail->setTarget($target);
        $mail->setCreationDate(new \DateTime('now'));
        $this->em->persist($mail);
        $this->em->flush();

        return $mail;
    }

    public function updateMail($mail, $author, $content, $target)
    {
        $mail->setAuthor($author);
        $mail->setContent($content);
        $mail->setTarget($target);
        $mail->setCreationDate(new \DateTime('now'));
        $this->em->flush();

        return $mail;
    }
}
