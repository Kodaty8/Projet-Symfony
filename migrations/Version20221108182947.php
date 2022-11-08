<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221108182947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description CLOB NOT NULL, mail VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE offer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, company_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description CLOB NOT NULL, CONSTRAINT FK_29D6873E979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_29D6873E979B1AD6 ON offer (company_id)');
        $this->addSql('CREATE TABLE offer_skill (offer_id INTEGER NOT NULL, skill_id INTEGER NOT NULL, PRIMARY KEY(offer_id, skill_id), CONSTRAINT FK_DD10999E53C674EE FOREIGN KEY (offer_id) REFERENCES offer (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_DD10999E5585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_DD10999E53C674EE ON offer_skill (offer_id)');
        $this->addSql('CREATE INDEX IDX_DD10999E5585C142 ON offer_skill (skill_id)');
        $this->addSql('CREATE TABLE offer_user (offer_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(offer_id, user_id), CONSTRAINT FK_736BF85E53C674EE FOREIGN KEY (offer_id) REFERENCES offer (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_736BF85EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_736BF85E53C674EE ON offer_user (offer_id)');
        $this->addSql('CREATE INDEX IDX_736BF85EA76ED395 ON offer_user (user_id)');
        $this->addSql('CREATE TABLE skill (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, description CLOB DEFAULT NULL)');
        $this->addSql('CREATE TABLE user_skill (user_id INTEGER NOT NULL, skill_id INTEGER NOT NULL, PRIMARY KEY(user_id, skill_id), CONSTRAINT FK_BCFF1F2FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BCFF1F2F5585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_BCFF1F2FA76ED395 ON user_skill (user_id)');
        $this->addSql('CREATE INDEX IDX_BCFF1F2F5585C142 ON user_skill (skill_id)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE offer_skill');
        $this->addSql('DROP TABLE offer_user');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_skill');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
