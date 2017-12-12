<?php

// src/MyProject/MyBundle/Entity/Comment.php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\CommentBundle\Entity\Comment as BaseComment;
use FOS\CommentBundle\Model\SignedCommentInterface;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Comment extends BaseComment implements SignedCommentInterface {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Author of the comment
     *
     * @ORM\ManyToOne(targetEntity="Esprit\MoocBundle\Entity\Utilisateur")
     * @var Utilisateur
     */
    protected $author;

    /**
     * Thread of this comment
     *
     * @var Thread
     * @ORM\ManyToOne(targetEntity="Esprit\MoocBundle\Entity\Thread")
     */
    protected $thread;

    public function setAuthor(UserInterface $author) {
        $this->author = $author;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getAuthorName() {
        if (null === $this->getAuthor()) {
            return 'Anonymous';
        }

        return $this->getAuthor()->getUsername();
    }

}
