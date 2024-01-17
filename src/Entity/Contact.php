<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Contact
{
    // dodać elementy null i asset
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255, nullable: false)]
    #[NotBlank(message: 'First name is required')]
    #[NotNull(message: 'First name is required')]
    #[Length(min: 1, max: 255, minMessage: 'First name to short', maxMessage: 'First name to long')]
    private string $firstName;

    #[ORM\Column(length: 255, nullable: false)]
    #[NotBlank(message: 'Last name is required')]
    #[NotNull(message: 'Last name is required')]
    #[Length(min: 1, max: 255, minMessage: 'Last name to short', maxMessage: 'Last name to long')]
    private string $lastName;

    #[ORM\Column(length: 255, nullable: false)]
    #[NotBlank(message: 'E-mail is required')]
    #[NotNull(message: 'E-mail is required')]
    #[Email(message: 'E-mail address not in correct form')]
    #[Length(min: 1, max: 255, minMessage: 'Email address is to short', maxMessage: 'Email address is to long')]
    private string $email;

    #[ORM\Column(type: Types::TEXT, nullable: false)]
    #[NotBlank(message: 'Message content is required')]
    #[NotNull(message: 'Message content is required')]
    private string $message;

    #[ORM\Column (type: Types::BOOLEAN, nullable: false)]
    #[NotBlank(message: 'Personal data processing agree is required to be set to true')]
    #[NotNull(message: 'Personal data processing agree is required to be set to true')]
    private bool $personalDataProcessingAgree;

    #[ORM\Column]
    private DateTimeImmutable $creationDate;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function isPersonalDataProcessingAgree(): bool
    {
        return $this->personalDataProcessingAgree;
    }

    public function setPersonalDataProcessingAgree(bool $personalDataProcessingAgree): self
    {
        $this->personalDataProcessingAgree = $personalDataProcessingAgree;

        return $this;
    }

    public function getCreationDate(): DateTimeImmutable
    {
        return $this->creationDate;
    }

    public function setCreationDate(DateTimeImmutable $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    #[ORM\PrePersist]
    public function setCreationDateValue(): void
    {
        $this->creationDate = new DateTimeImmutable();
    }
}
