<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230417075426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE portfolio (id INT AUTO_INCREMENT NOT NULL, portfolio_class_id INT DEFAULT NULL, title VARCHAR(50) NOT NULL, image VARCHAR(100) NOT NULL, INDEX IDX_A9ED1062968A5188 (portfolio_class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portfolio_portfolio_tag (portfolio_id INT NOT NULL, portfolio_tag_id INT NOT NULL, INDEX IDX_ADDF8FD7B96B5643 (portfolio_id), INDEX IDX_ADDF8FD7BC398E24 (portfolio_tag_id), PRIMARY KEY(portfolio_id, portfolio_tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portfolio_class (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portfolio_tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE portfolio ADD CONSTRAINT FK_A9ED1062968A5188 FOREIGN KEY (portfolio_class_id) REFERENCES portfolio_class (id)');
        $this->addSql('ALTER TABLE portfolio_portfolio_tag ADD CONSTRAINT FK_ADDF8FD7B96B5643 FOREIGN KEY (portfolio_id) REFERENCES portfolio (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE portfolio_portfolio_tag ADD CONSTRAINT FK_ADDF8FD7BC398E24 FOREIGN KEY (portfolio_tag_id) REFERENCES portfolio_tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE portfolio DROP FOREIGN KEY FK_A9ED1062968A5188');
        $this->addSql('ALTER TABLE portfolio_portfolio_tag DROP FOREIGN KEY FK_ADDF8FD7B96B5643');
        $this->addSql('ALTER TABLE portfolio_portfolio_tag DROP FOREIGN KEY FK_ADDF8FD7BC398E24');
        $this->addSql('DROP TABLE portfolio');
        $this->addSql('DROP TABLE portfolio_portfolio_tag');
        $this->addSql('DROP TABLE portfolio_class');
        $this->addSql('DROP TABLE portfolio_tag');
    }
}
