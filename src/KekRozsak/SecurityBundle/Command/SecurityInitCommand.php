<?php
namespace KekRozsak\SecurityBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;
use Symfony\Component\Security\Acl\Exception\AclNotFoundException;

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
        $roleRepo = $container->get('doctrine')->getRepository('KekRozsakSecurityBundle:Role');
        $adminRole = $roleRepo->findOneByName('ROLE_ADMIN');

        $classNames = array(
            'KekRozsak\\FrontBundle\\Entity\\News',
            'KekRozsak\\FrontBundle\\Entity\\Article',
            'KekRozsak\\FrontBundle\\Entity\\Group',
            'KekRozsak\\FrontBundle\\Entity\\ForumTopicGroup',
            'KekRozsak\\SecurityBundle\\Entity\\User',
        );

        $securityIdentity = new RoleSecurityIdentity($adminRole);
        foreach ($classNames as $className) {
            $id = $className::ACL_OID;

            $objectIdentity = new ObjectIdentity($id, $className);
            try {
                $acl = $aclProvider->findAcl($objectIdentity, array($securityIdentity));
            } catch (AclNotFoundException $e) {
                $acl = $aclProvider->createAcl($objectIdentity);
            }
            $acl->insertClassAce($securityIdentity, MaskBuilder::MASK_OWNER);
            $aclProvider->updateAcl($acl);
        }
    }
}
