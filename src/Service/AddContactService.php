<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\ContactDto;
use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class AddContactService
 */
class AddContactService
{
    /**
     * @param EntityManagerInterface $manager
     */
    public function __construct(
        private readonly EntityManagerInterface $manager,
    ) {
    }

    public function addContact(ContactDto $contactDto): array
    {
        $contact = new Contact();

        $contact
            ->setFirstName($contactDto->getFirstName())
            ->setLastName($contactDto->getLastName())
            ->setEmail($contactDto->getEmail())
            ->setMessage($contactDto->getMessage())
            ->setPersonalDataProcessingAgree($contactDto->getPersonalDataProcessingAgree())
        ;

        $this->manager->persist($contact);
        $this->manager->flush();

        return [
            'status' => true,
            'message' => 'Contact added into DB',
            'id' => $contact->getId(),
        ];
    }
}