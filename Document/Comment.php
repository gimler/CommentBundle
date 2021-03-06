<?php

/**
 * This file is part of the FOS\CommentBundle.
 *
 * (c) Thibault Duplessis <thibault.duplessis@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace FOS\CommentBundle\Document;

use FOS\CommentBundle\Model\Comment as AbstractComment;

/**
 * Default ODM implementation of CommentInterface.
 *
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 */
class Comment extends AbstractComment
{
    /**
     * Thread of this comment
     *
     * @var Thread
     */
    protected $thread;

    /**
     * All ancestors of the comment
     *
     * @var array
     */
    protected $ancestors = array();

    /**
     * @return Thread
     */
    public function getThread()
    {
        return $this->thread;
    }

    /**
     * @param  Thread
     * @return null
     */
    public function setThread(Thread $thread)
    {
        $this->thread = $thread;
    }

    /**
     * @return array
     */
    public function getAncestors()
    {
        return $this->ancestors;
    }

    /**
     * @param  array
     * @return null
     */
    public function setAncestors(array $ancestors)
    {
        $this->ancestors = $ancestors;
        $this->depth = count($ancestors);
    }
}
