<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\ContactRepository;

/**
 * Class GetContactService
 */
class GetContactService
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
    public function getContact(): array
    {
        return $this->contactRepository->findAllContacts();
    }
}