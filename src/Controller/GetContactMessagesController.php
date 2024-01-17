<?php

namespace App\Controller;

use App\Service\GetMessageService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GetContactMessagesController
 */
class GetContactMessagesController extends AbstractController
{
    public function __construct(
        public readonly GetMessageService $getMessageService,
    ) {
    }

    #[Route('/api/messages', name: 'get_messages', methods: ['GET'])]
    public function index(Request $request): JsonResponse
    {
        try {
            return new JsonResponse(
                $this->getMessageService->getAllContactMessages()
            ,
            Response::HTTP_OK
            );
        } catch (Exception $exception) {
            return new JsonResponse([
                'status' => false,
                'message' => $exception->getMessage()
            ],
            Response::HTTP_NOT_ACCEPTABLE
            );
        }
    }
}
