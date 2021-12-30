<?php

namespace App\Entities;

use App\Traits\SoftDeletes as SoftDeletesTrait;
use App\Traits\Timestamp as TimestampTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity]
#[ORM\Table(name: 'posts')]
#[Gedmo\SoftDeleteable(['fieldName' => 'deleted_at', 'timeAware' => false, 'hardDelete' => false])]
class Post
{
    use TimestampTrait, SoftDeletesTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    protected int $id;

    #[ORM\ManyToOne(targetEntity: Author::class, inversedBy: "posts")]
    protected $author;

    #[ORM\Column(type: Types::STRING)]
    protected string $name;
}