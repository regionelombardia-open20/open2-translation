<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\translation\migrations
 * @author    Aria S.p.A. <protocollo@pec.ariaspa.it>
 * @license   GNU General Public License v3.0 <https://www.gnu.org/licenses/gpl-3.0.html>
 * @link      https://www.ariaspa.it/
 *
 * This file is part of OPEN 2.0.
 *
 * OPEN 2.0 is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OPEN 2.0 is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OPEN 2.0. If not, see <https://www.gnu.org/licenses/>.
 */

/**
 * Class m170613_150734_create_table_user_language
 */
class m170613_150734_create_table_user_language extends \yii\db\Migration
{
    const TABLE = '{{%translation_user_language_mm}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableName = $this->db->getSchema()->getRawTableName(self::TABLE);

        if ($this->db->schema->getTableSchema(self::TABLE, true) === null) {
            try {
                $this->createTable(self::TABLE, [
                    'user_id' => $this->integer()->notNull(),
                    'language' => $this->string()->notNull(),
                    'created_at' => $this->dateTime()->null(),
                    'updated_at' => $this->dateTime()->null(),
                    'deleted_at' => $this->dateTime()->null(),
                    'created_by' => $this->integer()->null(),
                    'updated_by' => $this->integer()->null(),
                    'deleted_by' => $this->integer()->null(),
                ], $this->db->driverName === 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
                $this->addPrimaryKey('pk_' . $tableName, self::TABLE, ['user_id', 'language']);
                $this->addForeignKey('fk_' . $tableName . '_user_idTr1', self::TABLE, 'user_id', 'user', 'id');
                $this->addForeignKey('fk_' . $tableName . '_languageTr2', self::TABLE, 'language', 'language', 'language_id');
            } catch (Exception $e) {
                echo "Errore durante la creazione della tabella " . $tableName . "\n";
                echo $e->getMessage() . "\n";
                return false;
            }
        } else {
            echo "Nessuna creazione eseguita in quanto la tabella " . $tableName . " esiste gia'\n";
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        try {
            $this->dropTable(self::TABLE);
        } catch (Exception $e) {
            echo "Errore durante la cancellazionedella tabella " . self::TABLE . "\n";
            echo $e->getMessage() . "\n";
            return false;
        }

        return true;
    }
}
