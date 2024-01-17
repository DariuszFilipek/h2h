<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\ContactRepository;

/**
 * Class GetMessageService
 */
class GetMessageService
{
    /**
     * @param ContactRepository $contactRepository
     */
    public function __construct(
        private readonly ContactRepository $contactRepository,
    ) {
    }

    /**
     * @return array
     */
    public function getAllContactMessages(): array
    {
        return $this->contactRepository->findAllContactMessages();
    }
}