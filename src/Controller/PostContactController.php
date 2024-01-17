<?php

namespace App\Controller;

use App\Dto\ContactDto;
use App\Service\AddContactService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PostContactController
 */
class PostContactController extends AbstractController
{
    public function __construct(
        public readonly AddContactService $addContactService,
    ) {
    }

    #[Route('/api/contacts', name: 'add_contact', methods: ['POST'])]
    public function index(#[MapRequestPayload] ContactDto $contactDto): JsonResponse
    {
        try {
            return new JsonResponse(
                $this->addContactService->addContact($contactDto),
                Response::HTTP_CREATED
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
