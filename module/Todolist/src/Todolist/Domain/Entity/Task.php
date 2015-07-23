<?php
namespace Todolist\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Task
 * @package Todolist\Domain\Entity
* @ORM\Entity(repositoryClass="Todolist\Domain\Repository\Tasks")
 * @ORM\Table(name="tasks")
 * @property int $id
 * @property string $title
 * @property string $text
 */
class Task
{
    /**
     * Primary Identifier
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     * @access protected
     */
    protected $id;

    /**
     * Textual content of our Todolist Task
     *
     * @ORM\Column(type="text")
     * @var string
     * @access protected
     */
    protected $text;

    /**
     * @ORM\Column(type="boolean")
     * @var boolean
     * @access protected
     */
    protected $done;

    /**
     * @param string $text
     */
    public function __construct($text)
    {
        $this->text = $text;
        $this->done = false;
    }

    /**
     * Returns the Identifier
     *
     * @access public
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the Text Content
     *
     * @param string $text
     * @access public
     * @return Task
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Returns the Text Content
     *
     * @access public
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set done
     * @param $done
     * @return $this
     */
    public function setDone($done)
    {
        $this->done = $done;
        return $this;
    }

    /**
     * @return bool
     */
    public function getDone()
    {
        return (bool)$this->done;
    }
}