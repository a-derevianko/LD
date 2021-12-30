<?php

namespace App\Traits;

use App\Types\Timestamp as TimestampType;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;

trait Timestamp
{
    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(name: 'created_at', type: TimestampType::TIMESTAMP, nullable: true)]
    protected $createdAt;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(name: 'updated_at', type: TimestampType::TIMESTAMP, nullable: true)]
    protected $updatedAt;

    public function getCreatedAt(): ?Carbon
    {
        if (is_null($this->createdAt)) {
            return null;
        }

        if ($this->createdAt instanceof Carbon) {
            return $this->createdAt;
        }

        return Date::parse(time: $this->createdAt);
    }

    public function getUpdatedAt(): ?Carbon
    {
        if (is_null($this->createdAt)) {
            return null;
        }

        if ($this->updatedAt instanceof Carbon) {
            return $this->updatedAt;
        }

        return Date::parse(time: $this->updatedAt);
    }

    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = Date::parse(time: $createdAt);
    }

    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = Date::parse(time: $updatedAt);
    }
}