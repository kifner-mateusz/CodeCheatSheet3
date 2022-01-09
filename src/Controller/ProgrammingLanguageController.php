<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProgrammingLanguageController extends AbstractController
{

    protected ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    #[Route('/api/language/{lang}', name: 'api_language')]
    public function index(Request $request,string $lang): Response
    {
        dump($request);
        dump($lang);
        $em = $this->doctrine->getManager();;
        $lang = $em->find('ProgrammingLanguage', 1);
        return $this->json(
            $lang
        );
    }
}
