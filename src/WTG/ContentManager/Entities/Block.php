<?php

namespace WTG\ContentManager\Entities;

use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Support\HtmlString;
use WTG\Support\Concerns\Timestamps;
use Illuminate\Contracts\Support\Htmlable;

/**
 * Block Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="blocks")
 * @package     WTG\ContentManager
 * @subpackage  Entities
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class Block implements Htmlable
{
    use Timestamps;

    /**
     * @ORM\Id
     * @ORM\Column(type="uuid")
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $content;

    /**
     * Block entity constructor.
     *
     * @param  string  $name
     * @param  string  $title
     * @param  string  $content
     */
    public function __construct(string $name, string $title, string $content)
    {
        $now = Carbon::now();

        $this->name = $name;
        $this->title = $title;
        $this->content = $content;
        $this->created_at = $now;
        $this->updated_at = $now;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return HtmlString
     */
    public function getContent(): HtmlString
    {
        $html = new HtmlString($this->content);

        return $html;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toHtml();
    }

    /**
     * @return string
     */
    public function toHtml()
    {
        return (string) $this->getContent();
    }
}