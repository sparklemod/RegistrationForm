<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="Users")
 */
class User extends BaseEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="string")
     */
    private string $email;

    /**
     * @ORM\Column(type="string")
     */
    private string $pass;

    /**
     * @ORM\Column(type="string")
     */
    private string $icon;

    /**
     * @ManyToMany(targetEntity="Book")
     * @JoinTable(name="Users_Books",
     *      joinColumns={@JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="book_id", referencedColumnName="id")}
     *      )
     * @var Collection<int, Book>
     */
    private Collection $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return User
     */
    public function setId(?int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPass(): string
    {
        return $this->pass;
    }

    /**
     * @param string $pass
     * @return User
     */
    public function setPass(string $pass): User
    {
        $this->pass = $pass;
        return $this;
    }

    /**
     * @return Book[]
     */
    public function getBooks(): array
    {
        return $this->books->toArray();
    }

    /**
     * @param Book[] $books
     * @return User
     */
    public function setBooks(array $books): User
    {
        $this->books = new ArrayCollection($books);
        return $this;
    }

    /**
     * @param Book $book
     * @return $this
     */
    public function addBook(Book $book): User
    {

        $this->books->add($book);
        return $this;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): User
    {
        $this->icon = $icon;
        return $this;
    }

    //alt + insert = добавить геттеры сеттеры
    protected function getArray(): array
    {
        return get_object_vars($this);

    }
}