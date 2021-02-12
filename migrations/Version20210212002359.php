<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210212002359 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vendas (id INT AUTO_INCREMENT NOT NULL, vendedor_id INT NOT NULL, data_venda DATETIME NOT NULL, valor_venda NUMERIC(10, 2) NOT NULL, valor_comissao NUMERIC(10, 2) NOT NULL, INDEX IDX_1CA62EEE8361A8B8 (vendedor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vendedor (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vendas ADD CONSTRAINT FK_1CA62EEE8361A8B8 FOREIGN KEY (vendedor_id) REFERENCES vendedor (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vendas DROP FOREIGN KEY FK_1CA62EEE8361A8B8');
        $this->addSql('DROP TABLE vendas');
        $this->addSql('DROP TABLE vendedor');
    }
}
