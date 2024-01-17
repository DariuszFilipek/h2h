<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

/**
 * Class ContactDto
 */
class ContactDto
{
    public function __construct(
        #[NotBlank(message: 'First name is required')]
        #[NotNull(message: 'First name is required')]
        #[Length(min: 1, max: 255, minMessage: 'First name to short', maxMessage: 'First name to long')]
        #[Type('string')]
        private readonly string $firstName,

        #[NotBlank(message: 'Last name is required')]
        #[NotNull(message: 'Last name is required')]
        #[Length(min: 1, max: 255, minMessage: 'Last name to short', maxMessage: 'Last name to long')]
        #[Type('string')]
        private readonly string $lastName,

        #[NotBlank(message: 'E-mail is required')]
        #[NotNull(message: 'E-mail is required')]
        #[Email(message: 'E-mail address not in correct form')]
        #[Length(min: 1, max: 255, minMessage: 'Email address is to short', maxMessage: 'Email address is to long')]
        #[Type('string')]
        private readonly string $email,

        #[NotBlank(message: 'Message content is required')]
        #[NotNull(message: 'Message content is required')]
        #[Type('string')]
        // tutaj daję bez ograniczenia ale normalnie dopytałbym jakie powinno na to pole istnieć ograniczenie
        private readonly string $message,

        #[NotBlank(message: 'Personal data processing agree is required to be set to true')]
        #[NotNull(message: 'Personal data processing agree is required to be set to true')]
        #[Type('bool')]
        private readonly bool $personalDataProcessingAgree,
    ) {
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getPersonalDataProcessingAgree(): bool
    {
        return $this->personalDataProcessingAgree;
    }
}