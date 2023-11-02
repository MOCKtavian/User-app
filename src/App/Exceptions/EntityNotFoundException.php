<?php

namespace App\Exceptions;

use RuntimeException;

class EntityNotFoundException extends RuntimeException
{
    protected string $entity;

    protected array $ids = [];

    public static function missing(string $entity, int ...$ids): static
    {
        return (new static('Entity not found.'))
            ->setEntity($entity)
            ->setIds($ids);
    }

    protected function setEntity(string $entity): static
    {
        $this->entity = $entity;

        return $this;
    }

    public function getEntity(): string
    {
        return $this->entity;
    }

    protected function setIds(array $ids): static
    {
        $this->ids = $ids;

        return $this;
    }

    public function getIds(): array
    {
        return $this->ids;
    }
}
