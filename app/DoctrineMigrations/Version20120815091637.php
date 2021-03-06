<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20120815091637 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $this->addSql("CREATE TABLE role_hierarchy (parent_role_id INT NOT NULL, child_role_id INT NOT NULL, INDEX IDX_AB8EFB72A44B56EA (parent_role_id), INDEX IDX_AB8EFB72B4B76AB7 (child_role_id), PRIMARY KEY(parent_role_id, child_role_id)) ENGINE = InnoDB");
        $this->addSql("ALTER TABLE role_hierarchy ADD CONSTRAINT FK_AB8EFB72A44B56EA FOREIGN KEY (parent_role_id) REFERENCES roles (id)");
        $this->addSql("ALTER TABLE role_hierarchy ADD CONSTRAINT FK_AB8EFB72B4B76AB7 FOREIGN KEY (child_role_id) REFERENCES roles (id)");
        $this->addSql("ALTER TABLE roles DROP admin, DROP superAdmin");
    }

    public function down(Schema $schema)
    {
        // this down() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $this->addSql("DROP TABLE role_hierarchy");
        $this->addSql("ALTER TABLE roles ADD admin TINYINT(1) NOT NULL, ADD superAdmin TINYINT(1) NOT NULL");
    }
}
