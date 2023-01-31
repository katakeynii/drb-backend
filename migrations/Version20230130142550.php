<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230130142550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE talk_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE talk (id INT NOT NULL, speaker_id INT DEFAULT NULL, meetup_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, niveau VARCHAR(255) DEFAULT NULL, tags JSON DEFAULT NULL, cover_filename VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, youtube_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9F24D5BBD04A0F27 ON talk (speaker_id)');
        $this->addSql('CREATE INDEX IDX_9F24D5BB591E2316 ON talk (meetup_id)');
        $this->addSql('ALTER TABLE talk ADD CONSTRAINT FK_9F24D5BBD04A0F27 FOREIGN KEY (speaker_id) REFERENCES speaker (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE talk ADD CONSTRAINT FK_9F24D5BB591E2316 FOREIGN KEY (meetup_id) REFERENCES meetup (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE talk_id_seq CASCADE');
        $this->addSql('ALTER TABLE talk DROP CONSTRAINT FK_9F24D5BBD04A0F27');
        $this->addSql('ALTER TABLE talk DROP CONSTRAINT FK_9F24D5BB591E2316');
        $this->addSql('DROP TABLE talk');
    }
}
