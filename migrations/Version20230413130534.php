<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230413130534 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE realisation (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, sub_title VARCHAR(255) DEFAULT NULL, date VARCHAR(255) DEFAULT NULL, thumbnail VARCHAR(255) DEFAULT NULL, full_image VARCHAR(255) DEFAULT NULL, content LONGTEXT DEFAULT NULL, online TINYINT(1) DEFAULT NULL, type_of_work VARCHAR(255) DEFAULT NULL, country VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE realisation_technical_stack (realisation_id INT NOT NULL, technical_stack_id INT NOT NULL, INDEX IDX_56BF817AB685E551 (realisation_id), INDEX IDX_56BF817A8BCDCFDF (technical_stack_id), PRIMARY KEY(realisation_id, technical_stack_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE technical_stack (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(50) NOT NULL, icon VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE realisation_technical_stack ADD CONSTRAINT FK_56BF817AB685E551 FOREIGN KEY (realisation_id) REFERENCES realisation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE realisation_technical_stack ADD CONSTRAINT FK_56BF817A8BCDCFDF FOREIGN KEY (technical_stack_id) REFERENCES technical_stack (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE realisation_technical_stack DROP FOREIGN KEY FK_56BF817AB685E551');
        $this->addSql('ALTER TABLE realisation_technical_stack DROP FOREIGN KEY FK_56BF817A8BCDCFDF');
        $this->addSql('DROP TABLE realisation');
        $this->addSql('DROP TABLE realisation_technical_stack');
        $this->addSql('DROP TABLE technical_stack');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
