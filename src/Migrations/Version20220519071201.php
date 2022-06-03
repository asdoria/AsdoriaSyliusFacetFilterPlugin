<?php

declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220519071201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'create a asdoria facet filter schema';
    }

    public function up(Schema $schema): void
    {
        if($schema->hasTable('asdoria_facet')) return;

        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE asdoria_facet (id INT AUTO_INCREMENT NOT NULL, facet_filter_id INT NOT NULL, facet_group_id INT DEFAULT NULL, code VARCHAR(255) NOT NULL, position INT NOT NULL, facetType_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_1E574C9FBE43C8FC (facetType_id), INDEX IDX_1E574C9F96750B65 (facet_filter_id), INDEX IDX_1E574C9FC1B1976A (facet_group_id), UNIQUE INDEX UNIQ_1E574C9F96750B6577153098 (facet_filter_id, code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asdoria_facet_filter (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asdoria_facet_group (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, code VARCHAR(255) NOT NULL, position INT DEFAULT NULL, INDEX IDX_D6A900E6727ACA70 (parent_id), UNIQUE INDEX UNIQ_D6A900E677153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asdoria_facet_group_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT NOT NULL, name VARCHAR(255) NOT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_7F2C48312C2AC5D3 (translatable_id), UNIQUE INDEX UNIQ_7F2C48314180C6985E237E06 (locale, name), UNIQUE INDEX asdoria_facet_group_translation_uniq_trans (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asdoria_facet_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_170765062C2AC5D3 (translatable_id), UNIQUE INDEX asdoria_facet_translation_uniq_trans (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asdoria_facet_type (id INT AUTO_INCREMENT NOT NULL, product_attribute_id INT DEFAULT NULL, product_option_id INT DEFAULT NULL, taxon_id INT DEFAULT NULL, type VARCHAR(100) NOT NULL, discr VARCHAR(255) NOT NULL, INDEX IDX_EEDD779C3B420C91 (product_attribute_id), INDEX IDX_EEDD779CC964ABE2 (product_option_id), INDEX IDX_EEDD779CDE13F470 (taxon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE asdoria_facet ADD CONSTRAINT FK_1E574C9FBE43C8FC FOREIGN KEY (facetType_id) REFERENCES asdoria_facet_type (id)');
        $this->addSql('ALTER TABLE asdoria_facet ADD CONSTRAINT FK_1E574C9F96750B65 FOREIGN KEY (facet_filter_id) REFERENCES asdoria_facet_filter (id)');
        $this->addSql('ALTER TABLE asdoria_facet ADD CONSTRAINT FK_1E574C9FC1B1976A FOREIGN KEY (facet_group_id) REFERENCES asdoria_facet_group (id)');
        $this->addSql('ALTER TABLE asdoria_facet_group ADD CONSTRAINT FK_D6A900E6727ACA70 FOREIGN KEY (parent_id) REFERENCES asdoria_facet_group (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE asdoria_facet_group_translation ADD CONSTRAINT FK_7F2C48312C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES asdoria_facet_group (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE asdoria_facet_translation ADD CONSTRAINT FK_170765062C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES asdoria_facet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE asdoria_facet_type ADD CONSTRAINT FK_EEDD779C3B420C91 FOREIGN KEY (product_attribute_id) REFERENCES sylius_product_attribute (id)');
        $this->addSql('ALTER TABLE asdoria_facet_type ADD CONSTRAINT FK_EEDD779CC964ABE2 FOREIGN KEY (product_option_id) REFERENCES sylius_product_option (id)');
        $this->addSql('ALTER TABLE asdoria_facet_type ADD CONSTRAINT FK_EEDD779CDE13F470 FOREIGN KEY (taxon_id) REFERENCES sylius_taxon (id)');
        $this->addSql('ALTER TABLE sylius_taxon ADD facetFilterCode VARCHAR(255) DEFAULT NULL');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asdoria_facet_translation DROP FOREIGN KEY FK_170765062C2AC5D3');
        $this->addSql('ALTER TABLE asdoria_facet DROP FOREIGN KEY FK_1E574C9F96750B65');
        $this->addSql('ALTER TABLE asdoria_facet DROP FOREIGN KEY FK_1E574C9FC1B1976A');
        $this->addSql('ALTER TABLE asdoria_facet_group DROP FOREIGN KEY FK_D6A900E6727ACA70');
        $this->addSql('ALTER TABLE asdoria_facet_group_translation DROP FOREIGN KEY FK_7F2C48312C2AC5D3');
        $this->addSql('ALTER TABLE asdoria_facet DROP FOREIGN KEY FK_1E574C9FBE43C8FC');
        $this->addSql('DROP TABLE asdoria_facet');
        $this->addSql('DROP TABLE asdoria_facet_filter');
        $this->addSql('DROP TABLE asdoria_facet_group');
        $this->addSql('DROP TABLE asdoria_facet_group_translation');
        $this->addSql('DROP TABLE asdoria_facet_translation');
        $this->addSql('DROP TABLE asdoria_facet_type');;
        $this->addSql('ALTER TABLE sylius_taxon DROP facetFilterCode');
    }
}
