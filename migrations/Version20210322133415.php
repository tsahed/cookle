<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210322133415 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recipe_ingredient (recipe_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_22D1FE1359D8A214 (recipe_id), INDEX IDX_22D1FE13933FE08C (ingredient_id), PRIMARY KEY(recipe_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipe_ingredient ADD CONSTRAINT FK_22D1FE1359D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe_ingredient ADD CONSTRAINT FK_22D1FE13933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cooking_history ADD recipe_id INT NOT NULL');
        $this->addSql('ALTER TABLE cooking_history ADD CONSTRAINT FK_C4FFEE8359D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('CREATE INDEX IDX_C4FFEE8359D8A214 ON cooking_history (recipe_id)');
        $this->addSql('ALTER TABLE evaluation ADD recipe_id INT NOT NULL');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A57559D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('CREATE INDEX IDX_1323A57559D8A214 ON evaluation (recipe_id)');
        $this->addSql('ALTER TABLE recipe ADD coursetype_id INT DEFAULT NULL, ADD source_id INT NOT NULL');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B1379247AA5D FOREIGN KEY (coursetype_id) REFERENCES course_type (id)');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137953C1C61 FOREIGN KEY (source_id) REFERENCES source (id)');
        $this->addSql('CREATE INDEX IDX_DA88B1379247AA5D ON recipe (coursetype_id)');
        $this->addSql('CREATE INDEX IDX_DA88B137953C1C61 ON recipe (source_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE recipe_ingredient');
        $this->addSql('ALTER TABLE cooking_history DROP FOREIGN KEY FK_C4FFEE8359D8A214');
        $this->addSql('DROP INDEX IDX_C4FFEE8359D8A214 ON cooking_history');
        $this->addSql('ALTER TABLE cooking_history DROP recipe_id');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A57559D8A214');
        $this->addSql('DROP INDEX IDX_1323A57559D8A214 ON evaluation');
        $this->addSql('ALTER TABLE evaluation DROP recipe_id');
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B1379247AA5D');
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137953C1C61');
        $this->addSql('DROP INDEX IDX_DA88B1379247AA5D ON recipe');
        $this->addSql('DROP INDEX IDX_DA88B137953C1C61 ON recipe');
        $this->addSql('ALTER TABLE recipe DROP coursetype_id, DROP source_id');
    }
}
