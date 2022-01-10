<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use App\Repository\LanguagePartRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgrammingLanguageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProgrammingLanguageController extends AbstractController
{

    protected ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    #[Route('/api/languages.{_format}', name: 'api_lan',format:"json")]
    public function index(Request $request,ProgrammingLanguageRepository $programming_language_repository): Response
    {
       
        return $this->json($programming_language_repository->findAll());
    }

    #[Route('/api/language/{lang}.{_format}', name: 'api_language',format:"json")]
    public function lang(Request $request,string $lang,ProgrammingLanguageRepository $programming_language_repository): Response
    {
        // dump($request);
        // dump($lang);
        // $em = $this->doctrine->getManager();;
        $lang = $programming_language_repository->findOneBy(['name'=>$lang]);
        $parts = [];
        foreach($lang->getParts() as $part) {
            
            array_push($parts,$part);
            // foreach($part->getFields() as $field) {
            // }
            // $fields = array_merge($fields,$part->getFields());
        }
        return $this->json($parts);
    }

    #[Route('/api/language/{lang}/{part}.{_format}', name: 'api_language_part',format:"json")]
    public function part(Request $request,string $lang,string $part,LanguagePartRepository $language_part_repository,ProgrammingLanguageRepository $programming_language_repository): Response
    {
        // dump($request);
        // dump($lang);
        // $em = $this->doctrine->getManager();;
        $lang = $programming_language_repository->findOneBy(['name'=>$lang]);
        $part = $language_part_repository->findOneBy(['name'=>$part,'programming_language'=>$lang->getId()]);
        // dump($part);
        $fields = [];
        foreach($part->getFields() as $field) {
            array_push($fields,$field);
        }
        return $this->json($fields);
    }
}
