<?php
/**
 * @Entity @Table(name="messages")
 **/
class Message implements JsonSerializable
{
    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     **/
    protected $id;

    /**
     * @Column(type="integer", name="user_id")
     **/
    protected $userId;

    /**
     * @Column(type="datetime", name="created_at")
     **/
    protected $createdAt;

    /**
     * @Column(type="string")
     **/
    protected $message;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="messages")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    public function getId()
    {
        return $this->id;
    }

    public function getCreatedAt()
    {
        return (is_null($this->createdAt)) ? null : $this->createdAt->format('Y-m-d H:i:s');
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime("now");
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setUser(User $user = null)
    {
        $this->user = $user;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'user_id' => $this->getUserId(),
            'created_at' => $this->getCreatedAt(),
            'message' => $this->message,
            'user' => $this->getUser(),
            'some' => 'other'
        ];
    }
}
