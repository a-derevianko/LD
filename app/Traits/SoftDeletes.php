<?php

namespace App\Traits;

use App\Types\Timestamp as TimestampType;
use DateTime;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;

trait SoftDeletes
{
    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var DateTime|null
     */
    #[ORM\Column(name: 'deleted_at', type: Types::DATETIME_MUTABLE, nullable: true)]
    protected $deletedAt;

    /**
     * Set or clear the deleted at timestamp.
     *
     * @return self
     */
    public function setDeletedAt(DateTime $deletedAt = null)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get the deleted at timestamp value. Will return null if
     * the entity has not been soft deleted.
     *
     * @return DateTime|null
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Check if the entity has been soft deleted.
     *
     * @return bool
     */
    public function isDeleted()
    {
        return null !== $this->deletedAt;
    }
//    #[ORM\Column(name: 'deleted_at', type: TimestampType::TIMESTAMP, nullable: true)]
//    protected $deletedAt;
//
//    public function getDeletedAt(): ?Carbon
//    {
//        if (is_null($this->deletedAt)) {
//            return null;
//        }
//
//        if ($this->deletedAt instanceof Carbon) {
//            return $this->deletedAt;
//        }
//
//        return Date::parse(time: $this->deletedAt);
//    }
//
//    public function setDeletedAt($deletedAt = null)
//    {
//        $this->deletedAt = Date::parse(time: $deletedAt);
//    }
//
//    public function restore()
//    {
//        $this->deletedAt = null;
//    }
//
//    public function isDeleted(): bool
//    {
//        return $this->deletedAt && Date::now() >= $this->deletedAt;
//    }
}