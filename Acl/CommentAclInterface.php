<?php

/**
 * This file is part of the FOS\CommentBundle.
 *
 * (c) Tim Nagel <tim@nagel.com.au>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace FOS\CommentBundle\Acl;

use FOS\CommentBundle\Model\CommentInterface;

/**
 * Used for checking if the ACL system will allow specific actions
 * to occur.
 *
 * @author Tim Nagel <tim@nagel.com.au>
 */
interface CommentAclInterface
{
    /**
     * Checks if the user should be able to create a comment.
     *
     * @return boolean
     */
    function canCreate();

    /**
     * Checks if the user should be able to view a comment.
     *
     * @param CommentInterface $comment
     * @return boolean
     */
    function canView(CommentInterface $comment);

    /**
     * Checks if the user should be able to edit a comment.
     *
     * @param CommentInterface $comment
     * @return boolean
     */
    function canEdit(CommentInterface $comment);

    /**
     * Checks if the user should be able to delete a comment.
     *
     * @param CommentInterface $comment
     * @return boolean
     */
    function canDelete(CommentInterface $comment);

    /**
     * Sets the default Acl permissions on a comment.
     *
     * Note: this does not remove any existing Acl and should only
     * be called on new CommentInterface instances.
     *
     * @param CommentInterface $comment
     * @return void
     */
    function setDefaultAcl(CommentInterface $comment);

    /**
     * Installs the Default 'fallback' Acl entries for generic access.
     *
     * @return void
     */
    function installFallbackAcl();

    /**
     * Removes default Acl entries
     * @return void
     */
    function uninstallFallbackAcl();
}
