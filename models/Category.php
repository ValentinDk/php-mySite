<?php
namespace models;

use components\Database;

class Category
{
    public static function getCategoriesList()
    {
        $db = Database::getConnection();

        $categoryList = [];
        
        $result = $db->query(
            'SELECT id, name
             FROM category
             WHERE status = "1"
             ORDER BY sort_order ASC'
        );
        $categoryList = $result->fetchAll();
        
        return $categoryList;
    }

    public static function getCategoryById(int $id)
    {
        $db = Database::getConnection();

        $query = $db->prepare(
            'SELECT * FROM category
             WHERE id = :id'
         );
        $query->execute(
            ['id' => $id]
        );
        return $query->fetch();
    }

    public static function create(string $name, int $sort_order, int $status)
    {
        $db = Database::getConnection();

        $query = $db->prepare(
            'INSERT INTO category(
                name,
                sort_order,
                status
            )
            VALUES (
                :name,
                :sort_order,
                :status
            )'
        );
        $query->execute(
            [
                'name' => $name,
                'sort_order' => $sort_order,
                'status' => $status,
            ]
        );
        return $result = true;
    }

    public static function edit(int $id, string $name, int $sort_order, int $status)
    {
         $db = Database::getConnection();

        $query = $db->prepare(
            'UPDATE category
             SET name = :name,
                 sort_order = :sort_order,
                 status = :status
             WHERE id = :id'    
        );
        $query->execute(
            [
                'id' => $id,
                'name' => $name,
                'sort_order' => $sort_order,
                'status' => $status,
            ]
        );
        return $result = true;
    }

    public static function delete(int $id)
    {
        $db = Database::getConnection();

        $query = $db->prepare('
            DELETE FROM category
            WHERE id= :id'
        );
        $query->execute(
            ['id' => $id]
        );
        return $result = true;
    }

    public static function getAllCategories()
    {
        $db = Database::getConnection();

        $query = $db->query(
            'SELECT id, name
             FROM category
             ORDER BY sort_order ASC'
        );
        $categoryList = $query->fetchAll();
        
        return $categoryList;
    }
}