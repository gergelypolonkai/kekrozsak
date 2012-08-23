<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20120731113533 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $this->addSql("CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, accepted_by_id INT DEFAULT NULL, username VARCHAR(50) NOT NULL, password VARCHAR(50) NOT NULL, display_name VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, registered_at DATETIME NOT NULL, last_login_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_1483A5E9F85E0677 (username), UNIQUE INDEX UNIQ_1483A5E9D5499347 (display_name), UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), INDEX IDX_1483A5E920F699D9 (accepted_by_id), PRIMARY KEY(id)) ENGINE = InnoDB");
        $this->addSql("ALTER TABLE users ADD CONSTRAINT FK_1483A5E920F699D9 FOREIGN KEY (accepted_by_id) REFERENCES users (id)");

        $this->addSql("CREATE TABLE user_data (user_id INT NOT NULL, email_public TINYINT(1) NOT NULL, real_name VARCHAR(100) DEFAULT NULL, real_name_public TINYINT(1) NOT NULL, self_description LONGTEXT DEFAULT NULL, msn_address VARCHAR(100) DEFAULT NULL, msn_address_public TINYINT(1) NOT NULL, google_talk VARCHAR(100) DEFAULT NULL, google_talk_public TINYINT(1) NOT NULL, skype VARCHAR(100) DEFAULT NULL, skype_public TINYINT(1) NOT NULL, phone_number VARCHAR(30) DEFAULT NULL, phone_number_public TINYINT(1) NOT NULL, PRIMARY KEY(user_id)) ENGINE = InnoDB");
        $this->addSql("ALTER TABLE user_data ADD CONSTRAINT FK_D772BFAAA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)");

        $this->addSql("CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, `default` TINYINT(1) NOT NULL, admin TINYINT(1) NOT NULL, superAdmin TINYINT(1) NOT NULL, description VARCHAR(150) DEFAULT NULL, short_description VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_B63E2EC75E237E06 (name), UNIQUE INDEX UNIQ_B63E2EC79BE5A5B1 (short_description), PRIMARY KEY(id)) ENGINE = InnoDB");

        $this->addSql("CREATE TABLE user_role (user_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_2DE8C6A3A76ED395 (user_id), INDEX IDX_2DE8C6A3D60322AC (role_id), PRIMARY KEY(user_id, role_id)) ENGINE = InnoDB");
        $this->addSql("ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3D60322AC FOREIGN KEY (role_id) REFERENCES roles (id) ON DELETE CASCADE");

        $this->addSql("CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, text LONGTEXT NOT NULL, created_at DATETIME NOT NULL, public TINYINT(1) NOT NULL, INDEX IDX_1DD39950B03A8386 (created_by_id), PRIMARY KEY(id)) ENGINE = InnoDB");
        $this->addSql("ALTER TABLE news ADD CONSTRAINT FK_1DD39950B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)");

        $this->addSql("CREATE TABLE documents (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, title VARCHAR(150) NOT NULL, slug VARCHAR(150) NOT NULL, created_at DATETIME NOT NULL, content LONGTEXT NOT NULL, updatedAt DATETIME DEFAULT NULL, updateReason LONGTEXT DEFAULT NULL, updatedBy_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_A2B072882B36786B (title), UNIQUE INDEX UNIQ_A2B07288989D9B62 (slug), INDEX IDX_A2B07288B03A8386 (created_by_id), INDEX IDX_A2B0728865FF1AEC (updatedBy_id), PRIMARY KEY(id)) ENGINE = InnoDB");
        $this->addSql("ALTER TABLE documents ADD CONSTRAINT FK_A2B07288B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)");
        $this->addSql("ALTER TABLE documents ADD CONSTRAINT FK_A2B0728865FF1AEC FOREIGN KEY (updatedBy_id) REFERENCES users (id)");

        $this->addSql("CREATE TABLE groups (id INT AUTO_INCREMENT NOT NULL, leader_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, slug VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, description LONGTEXT DEFAULT NULL, open TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_F06D39705E237E06 (name), UNIQUE INDEX UNIQ_F06D3970989D9B62 (slug), INDEX IDX_F06D397073154ED4 (leader_id), INDEX IDX_F06D3970B03A8386 (created_by_id), PRIMARY KEY(id)) ENGINE = InnoDB");
        $this->addSql("ALTER TABLE groups ADD CONSTRAINT FK_F06D397073154ED4 FOREIGN KEY (leader_id) REFERENCES users (id)");
        $this->addSql("ALTER TABLE groups ADD CONSTRAINT FK_F06D3970B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)");

        $this->addSql("CREATE TABLE user_group_memberships (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, group_id INT DEFAULT NULL, membership_accepted_by_id INT DEFAULT NULL, membership_requested_at DATETIME NOT NULL, membership_accepted_at DATETIME DEFAULT NULL, INDEX IDX_5BFDE39CA76ED395 (user_id), INDEX IDX_5BFDE39CFE54D947 (group_id), INDEX IDX_5BFDE39C768D2C12 (membership_accepted_by_id), UNIQUE INDEX UNIQ_5BFDE39CA76ED395FE54D947 (user_id, group_id), PRIMARY KEY(id)) ENGINE = InnoDB");
        $this->addSql("ALTER TABLE user_group_memberships ADD CONSTRAINT FK_5BFDE39CA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)");
        $this->addSql("ALTER TABLE user_group_memberships ADD CONSTRAINT FK_5BFDE39CFE54D947 FOREIGN KEY (group_id) REFERENCES groups (id)");
        $this->addSql("ALTER TABLE user_group_memberships ADD CONSTRAINT FK_5BFDE39C768D2C12 FOREIGN KEY (membership_accepted_by_id) REFERENCES users (id)");

        $this->addSql("CREATE TABLE group_document (group_id INT NOT NULL, document_id INT NOT NULL, INDEX IDX_D159C609FE54D947 (group_id), INDEX IDX_D159C609C33F7837 (document_id), PRIMARY KEY(group_id, document_id)) ENGINE = InnoDB");
        $this->addSql("ALTER TABLE group_document ADD CONSTRAINT FK_D159C609FE54D947 FOREIGN KEY (group_id) REFERENCES groups (id)");
        $this->addSql("ALTER TABLE group_document ADD CONSTRAINT FK_D159C609C33F7837 FOREIGN KEY (document_id) REFERENCES documents (id)");

        $this->addSql("CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, created_at DATETIME NOT NULL, title VARCHAR(100) NOT NULL, slug VARCHAR(100) NOT NULL, text LONGTEXT NOT NULL, main_page TINYINT(1) NOT NULL, public TINYINT(1) NOT NULL, source VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_BFDD31682B36786B (title), UNIQUE INDEX UNIQ_BFDD3168989D9B62 (slug), INDEX IDX_BFDD3168B03A8386 (created_by_id), PRIMARY KEY(id)) ENGINE = InnoDB");
        $this->addSql("ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)");

        $this->addSql("CREATE TABLE forum_topic_groups (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, createdAt DATETIME NOT NULL, slug VARCHAR(100) NOT NULL, title VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_6BB4FCEF989D9B62 (slug), UNIQUE INDEX UNIQ_6BB4FCEF2B36786B (title), INDEX IDX_6BB4FCEFB03A8386 (created_by_id), PRIMARY KEY(id)) ENGINE = InnoDB");
        $this->addSql("ALTER TABLE forum_topic_groups ADD CONSTRAINT FK_6BB4FCEFB03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)");

        $this->addSql("CREATE TABLE forum_topics (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, topic_group_id INT DEFAULT NULL, last_post_id INT DEFAULT NULL, created_at DATETIME NOT NULL, slug VARCHAR(100) NOT NULL, title VARCHAR(100) NOT NULL, INDEX IDX_895975E8B03A8386 (created_by_id), INDEX IDX_895975E88655441 (topic_group_id), UNIQUE INDEX UNIQ_895975E82D053F64 (last_post_id), UNIQUE INDEX UNIQ_895975E886554412B36786B (topic_group_id, title), UNIQUE INDEX UNIQ_895975E88655441989D9B62 (topic_group_id, slug), PRIMARY KEY(id)) ENGINE = InnoDB");
        $this->addSql("ALTER TABLE forum_topics ADD CONSTRAINT FK_895975E8B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)");
        $this->addSql("ALTER TABLE forum_topics ADD CONSTRAINT FK_895975E88655441 FOREIGN KEY (topic_group_id) REFERENCES forum_topic_groups (id)");

        $this->addSql("CREATE TABLE forum_posts (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, topic_id INT DEFAULT NULL, created_at DATETIME NOT NULL, text LONGTEXT NOT NULL, INDEX IDX_90291C2DB03A8386 (created_by_id), INDEX IDX_90291C2D1F55203D (topic_id), PRIMARY KEY(id)) ENGINE = InnoDB");
        $this->addSql("ALTER TABLE forum_posts ADD CONSTRAINT FK_90291C2DB03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)");
        $this->addSql("ALTER TABLE forum_posts ADD CONSTRAINT FK_90291C2D1F55203D FOREIGN KEY (topic_id) REFERENCES forum_topics (id)");
        $this->addSql("ALTER TABLE forum_topics ADD CONSTRAINT FK_895975E82D053F64 FOREIGN KEY (last_post_id) REFERENCES forum_posts (id)");

        $this->addSql("CREATE TABLE events (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, group_id INT DEFAULT NULL, start_date DATE NOT NULL, end_date DATE DEFAULT NULL, title VARCHAR(150) NOT NULL, slug VARCHAR(150) NOT NULL, description LONGTEXT NOT NULL, cancelled TINYINT(1) NOT NULL, start_time TIME NOT NULL, end_time TIME DEFAULT NULL, INDEX IDX_5387574AB03A8386 (created_by_id), INDEX IDX_5387574AFE54D947 (group_id), PRIMARY KEY(id)) ENGINE = InnoDB");
        $this->addSql("ALTER TABLE events ADD CONSTRAINT FK_5387574AB03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)");
        $this->addSql("ALTER TABLE events ADD CONSTRAINT FK_5387574AFE54D947 FOREIGN KEY (group_id) REFERENCES groups (id)");

        $this->addSql("CREATE TABLE event_attendees (event_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_4E5C551871F7E88B (event_id), INDEX IDX_4E5C5518A76ED395 (user_id), PRIMARY KEY(event_id, user_id)) ENGINE = InnoDB");
        $this->addSql("ALTER TABLE event_attendees ADD CONSTRAINT FK_4E5C551871F7E88B FOREIGN KEY (event_id) REFERENCES events (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE event_attendees ADD CONSTRAINT FK_4E5C5518A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE");
    }

    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $this->addSql("ALTER TABLE event_attendees DROP FOREIGN KEY FK_4E5C551871F7E88B");
        $this->addSql("ALTER TABLE event_attendees DROP FOREIGN KEY FK_4E5C5518A76ED395");
        $this->addSql("DROP TABLE event_attendees");

        $this->addSql("ALTER TABLE events DROP FOREIGN KEY FK_5387574AB03A8386");
        $this->addSql("ALTER TABLE events DROP FOREIGN KEY FK_5387574AFE54D947");
        $this->addSql("DROP TABLE events");

        $this->addSql("ALTER TABLE forum_topics DROP FOREIGN KEY FK_895975E82D053F64");
        $this->addSql("ALTER TABLE forum_posts DROP FOREIGN KEY FK_90291C2DB03A8386");
        $this->addSql("ALTER TABLE forum_posts DROP FOREIGN KEY FK_90291C2D1F55203D");
        $this->addSql("DROP TABLE forum_posts");

        $this->addSql("ALTER TABLE forum_topics DROP FOREIGN KEY FK_895975E8B03A8386");
        $this->addSql("ALTER TABLE forum_topics DROP FOREIGN KEY FK_895975E88655441");
        $this->addSql("DROP TABLE forum_topics");

        $this->addSql("ALTER TABLE forum_topic_groups DROP FOREIGN KEY FK_6BB4FCEFB03A8386");
        $this->addSql("DROP TABLE forum_topic_groups");

        $this->addSql("ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168B03A8386");
        $this->addSql("DROP TABLE articles");

        $this->addSql("ALTER TABLE group_document DROP FOREIGN KEY FK_D159C609FE54D947");
        $this->addSql("ALTER TABLE group_document DROP FOREIGN KEY FK_D159C609C33F7837");
        $this->addSql("DROP TABLE group_document");

        $this->addSql("ALTER TABLE user_group_memberships DROP FOREIGN KEY FK_5BFDE39CA76ED395");
        $this->addSql("ALTER TABLE user_group_memberships DROP FOREIGN KEY FK_5BFDE39CFE54D947");
        $this->addSql("ALTER TABLE user_group_memberships DROP FOREIGN KEY FK_5BFDE39C768D2C12");
        $this->addSql("DROP TABLE user_group_memberships");

        $this->addSql("ALTER TABLE groups DROP FOREIGN KEY FK_F06D397073154ED4");
        $this->addSql("ALTER TABLE groups DROP FOREIGN KEY FK_F06D3970B03A8386");
        $this->addSql("DROP TABLE groups");

        $this->addSql("ALTER TABLE documents DROP FOREIGN KEY FK_A2B07288B03A8386");
        $this->addSql("ALTER TABLE documents DROP FOREIGN KEY FK_A2B0728865FF1AEC");
        $this->addSql("DROP TABLE documents");

        $this->addSql("ALTER TABLE news DROP FOREIGN KEY FK_1DD39950B03A8386");
        $this->addSql("DROP TABLE news");

        $this->addSql("ALTER TABLE user_role DROP FOREIGN KEY FK_2DE8C6A3A76ED395");
        $this->addSql("ALTER TABLE user_role DROP FOREIGN KEY FK_2DE8C6A3D60322AC");
        $this->addSql("DROP TABLE user_role");

        $this->addSql("DROP TABLE roles");

        $this->addSql("ALTER TABLE user_data DROP FOREIGN KEY FK_D772BFAAA76ED395");
        $this->addSql("DROP TABLE user_data");

        $this->addSql("ALTER TABLE users DROP FOREIGN KEY FK_1483A5E920F699D9");
        $this->addSql("DROP TABLE users");
    }
}
