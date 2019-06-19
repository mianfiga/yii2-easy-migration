<?php

namespace app\migrations;
use yii\db\Migration;

class EasyMigration extends Migration{
  public function addFK($refering_table, $refering_field, $refered_table = null, $refered_field = 'id', $options = []){
    // creates index for column `sale_id`
    if(!$refered_table){
      $guess_refered_table_arr = explode('_', $refering_field);
      array_pop($guess_refered_table_arr);
      $refered_table = implode('_', $guess_refered_table_arr); //\yii\helpers\Inflector::pluralize(
    }

    $this->createIndex(
      "idx-$refering_table-$refering_field",
      (isset(\Yii::$app->db->tablePrefix)? \Yii::$app->db->tablePrefix : '' ) . $refering_table,
      $refering_field
    );

    // add foreign key for table `sales`
    $this->addForeignKey(
      "fk-$refering_table-$refering_field",
      (isset(\Yii::$app->db->tablePrefix)? \Yii::$app->db->tablePrefix : '' ) . $refering_table,
      $refering_field,
      (isset(\Yii::$app->db->tablePrefix)? \Yii::$app->db->tablePrefix : '' ) . $refered_table,
      $refered_field,
      'CASCADE'
    );
  }
}
