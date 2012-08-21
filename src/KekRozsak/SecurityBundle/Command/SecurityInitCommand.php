<?php
namespace KekRozsak\SecurityBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;

class SecurityInitCommand extends ContainerAwareCommand
{
    private $verbose;

    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setName('kekrozsak:security:init')
            ->setDescription('Initializes ACLs')
            ->setHelp(<<<EOF
The <info>%command.full_name%</info> command fills up the ACL tables with default ACLs.

<info>php %command.full_name%</info>

ACL lists are currently hard-coded.
EOF
            )
        ;
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);
        $this->verbose = $input->getOption('verbose');
    }

    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();

        $securityContext = $container->get('security.context');
        $aclProvider = $container->get('security.acl.provider');

        $securityIdentity = new RoleSecurityIdentity('ADMIN');
        $objectIdentity = new ObjectIdentity('class', 'KekRozsak\\FrontBundle\\Entity\\News');
	// TODO: Check if the ACL exists, and if so, if it has the same permission mask
        $acl = $aclProvider->createAcl($objectIdentity);
        $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_OWNER);
        $aclProvider->updateAcl($acl);
    }
}
