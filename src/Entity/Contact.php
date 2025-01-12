<?php

namespace App\Entity;

class Contact
{
    private ?int $id = null;
    private ?string $subject = null;
    private ?int $subjectId = null;

    // Getters et Setters
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;
        return $this;
    }

    public function getSubjectId(): ?int
    {
        return $this->subjectId;
    }

    public function setSubjectId(?int $subjectId): self
    {
        $this->subjectId = $subjectId;
        return $this;
    }
}
