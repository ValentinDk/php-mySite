<?php
namespace models;

use components\Database;

class Order 
{
	public static function save(
	    string $userName,
        string $userPhone,
        string $userComment,
        int $userId,
        array $products,
        float $price
    )
	{
		$db = Database::getConnection();
		$products = json_encode($products);

		$query = $db->prepare(
            'INSERT INTO product_order(
                user_name,
                user_phone,
                user_comment,
                user_id,
                products,
                price
            )
            VALUES (
                :user_name,
                :user_phone,
                :user_comment,
                :user_id,
                :products,
                :price
            )'
        );
        $query->execute(
            [
                'user_name' => $userName,
                'user_phone' => $userPhone,
                'user_comment' => $userComment,
                'user_id' => $userId,
                'products' => $products,
                'price' => $price,
            ]
        );
        return $query;
	}

    public static function getAllOrders()
    {
        $db = Database::getConnection();

        $ordersList = [];

        $query = $db->query(
            'SELECT
                id,
                user_name,
                user_phone,
                user_comment,
                date,
                status
            FROM product_order
            ORDER BY date DESC'
        );
        $ordersList = $query->fetchAll();

        return $ordersList;
    }

    public static function getOrderById(int $id)
    {
        $db = Database::getConnection();

        $query = $db->prepare(
            'SELECT
                id,
                user_name,
                user_phone,
                user_comment,
                products,
                date,
                status
             FROM product_order
             WHERE id = :id'
        );
        $query->execute(
            ['id' => $id]
        );
        return $query->fetch();
    }

    public static function delete(int $id)
    {
        $db = Database::getConnection();

        $query = $db->prepare(
            'DELETE FROM product_order
             WHERE id = :id'
        );
        $query->execute(
            ['id' => $id]
        );
        return true;
    }

    public static function getOrderByUserId(int $userId)
    {
        $db = Database::getConnection();

        $query = $db->prepare(
            'SELECT
                id,
                user_phone,
                user_comment,
                products,
                date,
                price,
                status
             FROM product_order
             WHERE user_id = :user_id
             ORDER BY date DESC'
        );
        $query->execute(
            ['user_id' => $userId]
        );
        return $query->fetchAll();
    }
}