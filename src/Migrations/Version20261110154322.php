<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261110154322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allergie_restriction (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE article_course (id INT AUTO_INCREMENT NOT NULL, quantite NUMERIC(10, 2) DEFAULT NULL, est_achete TINYINT DEFAULT NULL, liste_courses_id INT DEFAULT NULL, ingredient_id INT DEFAULT NULL, unite_id INT DEFAULT NULL, INDEX IDX_7C59F839EBC3CE12 (liste_courses_id), INDEX IDX_7C59F839933FE08C (ingredient_id), INDEX IDX_7C59F839EC4A74AB (unite_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, token_partage VARCHAR(255) DEFAULT NULL, date_creation DATETIME DEFAULT NULL, createur_id INT DEFAULT NULL, INDEX IDX_4B98C2173A201E5 (createur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE groupe_membre (id INT AUTO_INCREMENT NOT NULL, role VARCHAR(255) DEFAULT NULL, date_adhesion DATETIME DEFAULT NULL, groupe_id INT DEFAULT NULL, utilisateur_id INT DEFAULT NULL, INDEX IDX_9D8A07137A45358C (groupe_id), INDEX IDX_9D8A0713FB88E14F (utilisateur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, calories_100g NUMERIC(10, 2) DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE ingredient_allergie_restriction (ingredient_id INT NOT NULL, allergie_restriction_id INT NOT NULL, INDEX IDX_7FD60063933FE08C (ingredient_id), INDEX IDX_7FD60063AF0B2432 (allergie_restriction_id), PRIMARY KEY (ingredient_id, allergie_restriction_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE liste_courses (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, date_creation DATETIME DEFAULT NULL, date_modification DATETIME DEFAULT NULL, planning_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_189FC21D3D865311 (planning_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE planning (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, est_defaut TINYINT DEFAULT NULL, date_debut DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, date_creation DATETIME DEFAULT NULL, createur_id INT DEFAULT NULL, INDEX IDX_D499BFF673A201E5 (createur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE planning_groupe (planning_id INT NOT NULL, groupe_id INT NOT NULL, INDEX IDX_6498AE4E3D865311 (planning_id), INDEX IDX_6498AE4E7A45358C (groupe_id), PRIMARY KEY (planning_id, groupe_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE profil (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) DEFAULT NULL, prenom VARCHAR(100) DEFAULT NULL, date_naissance DATE DEFAULT NULL, categorie VARCHAR(255) DEFAULT NULL, sexe VARCHAR(255) DEFAULT NULL, utilisateur_id INT DEFAULT NULL, INDEX IDX_E6D6B297FB88E14F (utilisateur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE profil_regime_alimentaire (profil_id INT NOT NULL, regime_alimentaire_id INT NOT NULL, INDEX IDX_82BFBAAD275ED078 (profil_id), INDEX IDX_82BFBAAD7B2EE792 (regime_alimentaire_id), PRIMARY KEY (profil_id, regime_alimentaire_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE profil_allergie_restriction (profil_id INT NOT NULL, allergie_restriction_id INT NOT NULL, INDEX IDX_B5FA2634275ED078 (profil_id), INDEX IDX_B5FA2634AF0B2432 (allergie_restriction_id), PRIMARY KEY (profil_id, allergie_restriction_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE recette (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, instructions LONGTEXT DEFAULT NULL, temps_preparation SMALLINT DEFAULT NULL, temps_cuisson SMALLINT DEFAULT NULL, nombre_portions SMALLINT DEFAULT NULL, type_repas VARCHAR(255) DEFAULT NULL, type_saveur VARCHAR(255) DEFAULT NULL, origine VARCHAR(255) DEFAULT NULL, est_transportable TINYINT DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, date_creation DATETIME DEFAULT NULL, date_modification DATETIME DEFAULT NULL, createur_id INT DEFAULT NULL, INDEX IDX_49BB639073A201E5 (createur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE recette_regime_alimentaire (recette_id INT NOT NULL, regime_alimentaire_id INT NOT NULL, INDEX IDX_B9E5485189312FE9 (recette_id), INDEX IDX_B9E548517B2EE792 (regime_alimentaire_id), PRIMARY KEY (recette_id, regime_alimentaire_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE recette_ingredient (id INT AUTO_INCREMENT NOT NULL, quantite NUMERIC(10, 2) DEFAULT NULL, recette_id INT DEFAULT NULL, ingredient_id INT DEFAULT NULL, unite_id INT DEFAULT NULL, INDEX IDX_17C041A989312FE9 (recette_id), INDEX IDX_17C041A9933FE08C (ingredient_id), INDEX IDX_17C041A9EC4A74AB (unite_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE regime_alimentaire (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) DEFAULT NULL, description LONGTEXT DEFAULT NULL, date_creation DATETIME DEFAULT NULL, date_modification DATETIME DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE repas (id INT AUTO_INCREMENT NOT NULL, date_repas DATE DEFAULT NULL, creneau VARCHAR(255) DEFAULT NULL, preference_repas VARCHAR(255) DEFAULT NULL, temps_disponible SMALLINT DEFAULT NULL, nombre_personnes SMALLINT DEFAULT NULL, etat_generation VARCHAR(255) DEFAULT NULL, taille_quantite VARCHAR(255) DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, planning_id INT DEFAULT NULL, recette_id INT DEFAULT NULL, INDEX IDX_A8D351B33D865311 (planning_id), INDEX IDX_A8D351B389312FE9 (recette_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE repas_profil (repas_id INT NOT NULL, profil_id INT NOT NULL, INDEX IDX_8F20EF181D236AAA (repas_id), INDEX IDX_8F20EF18275ED078 (profil_id), PRIMARY KEY (repas_id, profil_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE unite_mesure (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) DEFAULT NULL, abreviation VARCHAR(20) DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) DEFAULT NULL, prenom VARCHAR(100) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, mot_de_passe VARCHAR(255) DEFAULT NULL, date_inscription DATETIME DEFAULT NULL, date_derniere_connexion DATETIME DEFAULT NULL, actif TINYINT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id))');
        $this->addSql('ALTER TABLE article_course ADD CONSTRAINT FK_7C59F839EBC3CE12 FOREIGN KEY (liste_courses_id) REFERENCES liste_courses (id)');
        $this->addSql('ALTER TABLE article_course ADD CONSTRAINT FK_7C59F839933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE article_course ADD CONSTRAINT FK_7C59F839EC4A74AB FOREIGN KEY (unite_id) REFERENCES unite_mesure (id)');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C2173A201E5 FOREIGN KEY (createur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE groupe_membre ADD CONSTRAINT FK_9D8A07137A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id)');
        $this->addSql('ALTER TABLE groupe_membre ADD CONSTRAINT FK_9D8A0713FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE ingredient_allergie_restriction ADD CONSTRAINT FK_7FD60063933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_allergie_restriction ADD CONSTRAINT FK_7FD60063AF0B2432 FOREIGN KEY (allergie_restriction_id) REFERENCES allergie_restriction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_courses ADD CONSTRAINT FK_189FC21D3D865311 FOREIGN KEY (planning_id) REFERENCES planning (id)');
        $this->addSql('ALTER TABLE planning ADD CONSTRAINT FK_D499BFF673A201E5 FOREIGN KEY (createur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE planning_groupe ADD CONSTRAINT FK_6498AE4E3D865311 FOREIGN KEY (planning_id) REFERENCES planning (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE planning_groupe ADD CONSTRAINT FK_6498AE4E7A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B297FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE profil_regime_alimentaire ADD CONSTRAINT FK_82BFBAAD275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profil_regime_alimentaire ADD CONSTRAINT FK_82BFBAAD7B2EE792 FOREIGN KEY (regime_alimentaire_id) REFERENCES regime_alimentaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profil_allergie_restriction ADD CONSTRAINT FK_B5FA2634275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profil_allergie_restriction ADD CONSTRAINT FK_B5FA2634AF0B2432 FOREIGN KEY (allergie_restriction_id) REFERENCES allergie_restriction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB639073A201E5 FOREIGN KEY (createur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE recette_regime_alimentaire ADD CONSTRAINT FK_B9E5485189312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_regime_alimentaire ADD CONSTRAINT FK_B9E548517B2EE792 FOREIGN KEY (regime_alimentaire_id) REFERENCES regime_alimentaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_ingredient ADD CONSTRAINT FK_17C041A989312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE recette_ingredient ADD CONSTRAINT FK_17C041A9933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE recette_ingredient ADD CONSTRAINT FK_17C041A9EC4A74AB FOREIGN KEY (unite_id) REFERENCES unite_mesure (id)');
        $this->addSql('ALTER TABLE repas ADD CONSTRAINT FK_A8D351B33D865311 FOREIGN KEY (planning_id) REFERENCES planning (id)');
        $this->addSql('ALTER TABLE repas ADD CONSTRAINT FK_A8D351B389312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE repas_profil ADD CONSTRAINT FK_8F20EF181D236AAA FOREIGN KEY (repas_id) REFERENCES repas (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE repas_profil ADD CONSTRAINT FK_8F20EF18275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_course DROP FOREIGN KEY FK_7C59F839EBC3CE12');
        $this->addSql('ALTER TABLE article_course DROP FOREIGN KEY FK_7C59F839933FE08C');
        $this->addSql('ALTER TABLE article_course DROP FOREIGN KEY FK_7C59F839EC4A74AB');
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY FK_4B98C2173A201E5');
        $this->addSql('ALTER TABLE groupe_membre DROP FOREIGN KEY FK_9D8A07137A45358C');
        $this->addSql('ALTER TABLE groupe_membre DROP FOREIGN KEY FK_9D8A0713FB88E14F');
        $this->addSql('ALTER TABLE ingredient_allergie_restriction DROP FOREIGN KEY FK_7FD60063933FE08C');
        $this->addSql('ALTER TABLE ingredient_allergie_restriction DROP FOREIGN KEY FK_7FD60063AF0B2432');
        $this->addSql('ALTER TABLE liste_courses DROP FOREIGN KEY FK_189FC21D3D865311');
        $this->addSql('ALTER TABLE planning DROP FOREIGN KEY FK_D499BFF673A201E5');
        $this->addSql('ALTER TABLE planning_groupe DROP FOREIGN KEY FK_6498AE4E3D865311');
        $this->addSql('ALTER TABLE planning_groupe DROP FOREIGN KEY FK_6498AE4E7A45358C');
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B297FB88E14F');
        $this->addSql('ALTER TABLE profil_regime_alimentaire DROP FOREIGN KEY FK_82BFBAAD275ED078');
        $this->addSql('ALTER TABLE profil_regime_alimentaire DROP FOREIGN KEY FK_82BFBAAD7B2EE792');
        $this->addSql('ALTER TABLE profil_allergie_restriction DROP FOREIGN KEY FK_B5FA2634275ED078');
        $this->addSql('ALTER TABLE profil_allergie_restriction DROP FOREIGN KEY FK_B5FA2634AF0B2432');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB639073A201E5');
        $this->addSql('ALTER TABLE recette_regime_alimentaire DROP FOREIGN KEY FK_B9E5485189312FE9');
        $this->addSql('ALTER TABLE recette_regime_alimentaire DROP FOREIGN KEY FK_B9E548517B2EE792');
        $this->addSql('ALTER TABLE recette_ingredient DROP FOREIGN KEY FK_17C041A989312FE9');
        $this->addSql('ALTER TABLE recette_ingredient DROP FOREIGN KEY FK_17C041A9933FE08C');
        $this->addSql('ALTER TABLE recette_ingredient DROP FOREIGN KEY FK_17C041A9EC4A74AB');
        $this->addSql('ALTER TABLE repas DROP FOREIGN KEY FK_A8D351B33D865311');
        $this->addSql('ALTER TABLE repas DROP FOREIGN KEY FK_A8D351B389312FE9');
        $this->addSql('ALTER TABLE repas_profil DROP FOREIGN KEY FK_8F20EF181D236AAA');
        $this->addSql('ALTER TABLE repas_profil DROP FOREIGN KEY FK_8F20EF18275ED078');
        $this->addSql('DROP TABLE allergie_restriction');
        $this->addSql('DROP TABLE article_course');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE groupe_membre');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE ingredient_allergie_restriction');
        $this->addSql('DROP TABLE liste_courses');
        $this->addSql('DROP TABLE planning');
        $this->addSql('DROP TABLE planning_groupe');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE profil_regime_alimentaire');
        $this->addSql('DROP TABLE profil_allergie_restriction');
        $this->addSql('DROP TABLE recette');
        $this->addSql('DROP TABLE recette_regime_alimentaire');
        $this->addSql('DROP TABLE recette_ingredient');
        $this->addSql('DROP TABLE regime_alimentaire');
        $this->addSql('DROP TABLE repas');
        $this->addSql('DROP TABLE repas_profil');
        $this->addSql('DROP TABLE unite_mesure');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
