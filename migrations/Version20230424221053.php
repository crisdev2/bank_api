<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230424221053 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE accounts (id INT AUTO_INCREMENT NOT NULL, id_customer_id INT NOT NULL, number INT NOT NULL, balance DOUBLE PRECISION NOT NULL, activation DATETIME NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_CAC89EAC8B870E04 (id_customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, idnumber VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, age INT NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, occupation VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transactions (id INT AUTO_INCREMENT NOT NULL, id_customer_id INT NOT NULL, id_account_id INT NOT NULL, created DATETIME NOT NULL, commercename VARCHAR(255) NOT NULL, current_balance DOUBLE PRECISION NOT NULL, final_balance DOUBLE PRECISION NOT NULL, status INT NOT NULL, INDEX IDX_EAA81A4C8B870E04 (id_customer_id), INDEX IDX_EAA81A4C3EE1DF6D (id_account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, idnumber VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, age INT NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE accounts ADD CONSTRAINT FK_CAC89EAC8B870E04 FOREIGN KEY (id_customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4C8B870E04 FOREIGN KEY (id_customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4C3EE1DF6D FOREIGN KEY (id_account_id) REFERENCES accounts (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accounts DROP FOREIGN KEY FK_CAC89EAC8B870E04');
        $this->addSql('ALTER TABLE transactions DROP FOREIGN KEY FK_EAA81A4C8B870E04');
        $this->addSql('ALTER TABLE transactions DROP FOREIGN KEY FK_EAA81A4C3EE1DF6D');
        $this->addSql('DROP TABLE accounts');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE transactions');
        $this->addSql('DROP TABLE `user`');
    }
}
