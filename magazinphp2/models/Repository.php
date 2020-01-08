<?php


namespace app\models;


use app\engine\App;
use app\interfaces\IModels;

abstract class Repository implements IModels
{
    public function getLimit($from, $to) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT :from, :to";
        return App::call()->db->queryLimit($sql, $from, $to);
    }

    public function getWhereOne($field, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE $field = :value";
        return App::call()->db->queryObject($sql, ['value' => $value], $this->getEntityClass());
    }

    public function getCountWhere($field, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT count(*) as count FROM {$tableName} WHERE $field = :value";
        return App::call()->db->queryOne($sql, ['value' => $value])['count'];
    }

    public function getStatusWhere($field, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT status FROM {$tableName} WHERE $field = :value";
        return App::call()->db->queryOne($sql, ['value' => $value])['status'];
    }

    public function insert(Model $entity) {
        $tableName = $this->getTableName();

        foreach ($entity->props as $key => $value) {
            $params[":$key"] = $entity->$key;
            $keys[] = $key;
        }

        $keys = implode(', ', $keys);
        $values = implode(', ', array_keys($params));

        $sql = "INSERT INTO {$tableName} ({$keys}) VALUES ({$values})";

        App::call()->db->execute($sql, $params);

        $entity->id = App::call()->db->lastInsertId();
    }

    public function delete(Model $entity) {
        $tableName = $this->getTableName();

        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return App::call()->db->execute($sql, ["id" => $entity->id]);
    }

    public function update(Model $entity) {
        $tableName = $this->getTableName();
        foreach ($entity->props as $key => $value) {
            if ($value !== false) {
                $params[":$key"] = $value;
                $keys[] = $key . "=:" . $key;
            };
        }

        $keys = implode(', ', $keys);

        $sql = "UPDATE {$tableName} SET {$keys} WHERE id = :id";
        App::call()->db->execute($sql, $params);

        foreach ($entity->props as $keyProp => $prop) {
            $entity->props[$keyProp] = false;
        }
    }

    public function save(Model $entity) {
        if (is_null($entity->id))
            $this->insert($entity);
        else
            $this->update($entity);
    }

    public function getOne($id) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return App::call()->db->queryObject($sql, ['id' => $id], $this->getEntityClass());
    }

    public function getAll() {
        $tableName = $this->getTableName();

        $sql = "SELECT * FROM {$tableName}";
        return App::call()->db->queryAll($sql);
    }
}