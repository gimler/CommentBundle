<?php

/**
 * This file is part of the FOS\CommentBundle.
 *
 * (c) Tim Nagel <tim@nagel.com.au>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace FOS\CommentBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * This command installs global access control entries (ACEs)
 *
 * @author Tim Nagel <tim@nagel.com.au>
 */
class InstallAcesCommand extends Command
{
    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setName('fos:comment:installAces')
            ->setDescription('Installs global ACEs')
            ->setDefinition(array(
                new InputOption('flush', null, InputOption::VALUE_NONE, 'Flush existing Acls'),
            ))
            ->setHelp(<<<EOT
This command should be run once during the installation process of the entire bundle or
after enabling Acl for the first time.

If you have been using CommentBundle previously without Acl and are just enabling it, you
will also need to run fos:comment:fixAces.
EOT
            );
    }

    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$this->container->has('security.acl.provider')) {
            $output->writeln('You must setup the ACL system, see the Symfony2 documentation for how to do this.');
            return;
        }

        $threadAcl = $this->container->get('fos_comment.acl.thread');
        $commentAcl = $this->container->get('fos_comment.acl.comment');
        $voteAcl = $this->container->get('fos_comment.acl.vote');

        if ($input->getOption('flush')) {
            $output->writeln('Flushing Global ACEs');

            $threadAcl->uninstallFallbackAcl();
            $commentAcl->uninstallFallbackAcl();
            $voteAcl->uninstallFallbackAcl();
        }

        $threadAcl->installFallbackAcl();
        $commentAcl->installFallbackAcl();
        $voteAcl->installFallbackAcl();

        $output->writeln('Global ACEs have been installed.');
    }
}
