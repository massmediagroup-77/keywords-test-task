<?php

namespace App\Controller;

use App\Form\ChecklistType;
use App\Form\Handler\FormHandler;
use App\Service\KeywordService;
use App\ValueObject\Checklist;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

class ChecklistController extends AbstractFOSRestController
{
    private $formHandler;
    private $keywordService;

    public function __construct(FormHandler $formHandler, KeywordService $keywordService)
    {
        $this->formHandler = $formHandler;
        $this->keywordService = $keywordService;
    }

    /**
     * @Rest\Post("/api/checklist")
     * @Rest\View()
     *
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function postAction(Request $request)
    {
        $checklist = $this->formHandler->handleWithSubmit($request->request->all(), ChecklistType::class, new Checklist());
        if (!$checklist instanceof Checklist) {
            return $this->view(
                $checklist,
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        return $checklist->handle(
            $this->keywordService->getKeywordsArray()
        );
    }
}