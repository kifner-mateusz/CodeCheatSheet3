<?php

namespace App\Controller;

use App\Entity\ProgrammingLanguage;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\LanguagePartRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgrammingLanguageRepository;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[AsController]
class ProgrammingLanguageController extends AbstractController
{

    protected ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    #[Route('/api/languages.{_format}', name: 'api_languages_get',format:"json",methods: ['GET'])]
    /**
     * @param Request $request
     * @return Response 
    */
    public function index(Request $request,ProgrammingLanguageRepository $programming_language_repository): Response
    {
    //    dump($request);
        return $this->json($programming_language_repository->findAll());
    }

    #[Route('/api/languages/{lang}.{_format}', name: 'api_languages_get_language_parts',format:"json",methods: ['GET'])]
    
    /**
     * @param Request $request
     * @param string $lang
     * @return Response 
    */
    public function lang(Request $request,string $lang,ProgrammingLanguageRepository $programming_language_repository): Response
    {

        $lang_data = $programming_language_repository->findOneBy(['name'=>$lang]);
        if (!$lang_data){
            return $this->json(["message"=>"not found"],404);
        }
        $parts = [];
        foreach($lang_data->getParts() as $part) {
            
            array_push($parts,$part);

        }
        return $this->json($parts);
    }

    #[Route('/api/languages/{lang}/{part}.{_format}', name: 'api_languages_get_language_fields',format:"json",methods: ['GET'])]
    /**
     * @param string $lang
     * @param string $part
     * @return Response 
    */
    public function part(Request $request,string $lang,string $part,LanguagePartRepository $language_part_repository,ProgrammingLanguageRepository $programming_language_repository): Response
    {
        if (!$lang){
            return $this->json(["message"=>"invalid request"],403);
        }
        $lang_data = $programming_language_repository->findOneBy(['name'=>$lang]);
        if (!$lang_data){
            return $this->json(["message"=>"not found"],404);
        }
        $part_data = $language_part_repository->findOneBy(['name'=>$part,'programming_language'=>$lang_data->getId()]);
        if (!$part_data){
            return $this->json(["message"=>"not found"],404);
        }
        $fields = [];
        foreach($part_data->getFields() as $field) {
            array_push($fields,$field);
        }
        return $this->json($fields);
    }
}
