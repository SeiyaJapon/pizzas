<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250329151321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates the basic tables for the Pizza House application: pizza, order, ingredient, employee, promotion, and receipt.';
    }

    public function up(Schema $schema): void
    {
        // Table for the Kitchen domain (Pizzas)
        $this->addSql('
            CREATE TABLE pizza (
                id VARCHAR(255) NOT NULL,
                name VARCHAR(255) NOT NULL,
                ingredients JSON NOT NULL,
                PRIMARY KEY(id)
            )
        ');

        // Table for the RestaurantRoom domain (Orders)
        $this->addSql('
            CREATE TABLE "order" (
                id VARCHAR(255) NOT NULL,
                table_number VARCHAR(255) NOT NULL,
                details JSON NOT NULL,
                status VARCHAR(50) NOT NULL,
                PRIMARY KEY(id)
            )
        ');

        // Table for the Storage domain (Ingredients)
        $this->addSql('
            CREATE TABLE ingredient (
                id VARCHAR(255) NOT NULL,
                name VARCHAR(255) NOT NULL,
                available_quantity INT NOT NULL,
                PRIMARY KEY(id)
            )
        ');

        // Table for the Personnel domain (Employees)
        $this->addSql('
            CREATE TABLE employee (
                id VARCHAR(255) NOT NULL,
                name VARCHAR(255) NOT NULL,
                role VARCHAR(255) NOT NULL,
                PRIMARY KEY(id)
            )
        ');

        // Table for the SalesPromotion domain (Promotions)
        $this->addSql('
            CREATE TABLE promotion (
                id VARCHAR(255) NOT NULL,
                description VARCHAR(255) NOT NULL,
                discount DOUBLE PRECISION NOT NULL,
                PRIMARY KEY(id)
            )
        ');

        // Table for the receipt (generated in Kitchen)
        $this->addSql('
            CREATE TABLE receipt (
                id VARCHAR(255) NOT NULL,
                order_id VARCHAR(255) NOT NULL,
                total_amount DOUBLE PRECISION NOT NULL,
                PRIMARY KEY(id)
            )
        ');

        // Relationship between receipt and order (assuming each receipt is associated with an order)
        $this->addSql('
            ALTER TABLE receipt
            ADD CONSTRAINT FK_receipt_order
            FOREIGN KEY (order_id) REFERENCES "order" (id)
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE receipt DROP FOREIGN KEY FK_receipt_order');
        $this->addSql('DROP TABLE pizza');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE promotion');
        $this->addSql('DROP TABLE receipt');
    }
}