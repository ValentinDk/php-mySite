<?php
namespace models;

use components\Database;

class Product
{
    const SHOW_BY_DEFAULT = 3;


    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);
        $db = Database::getConnection();

        $productsList = array();

        $result = $db->query(
            'SELECT id, name, price, is_new  
             FROM product
             WHERE status = "1"
             ORDER BY id DESC
             LIMIT ' . $count
        );

        $productsList = $result->fetchAll();

        return $productsList;
    }

    public static function getProductsListByCategory($categoryId = false, $page = 1)
    {
        if ($categoryId) {

            $page = intval($page);
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

            $db = Database::getConnection();
            $products = array();
            $query = $db->prepare(
                "SELECT id, name, price, is_new  
                 FROM product
                 WHERE status = '1' AND category_id = :category_id 
                 ORDER BY id desc
                 LIMIT :count
                 OFFSET :offset"
            );

            $query->execute(
                [
                    "category_id" => $categoryId,
                    "count" => self::SHOW_BY_DEFAULT,
                    "offset" => $offset
                ]
            );

        $products = $query->fetchAll();

        return $products;
        }
    }

    public static function getProductById($id)
    {
        $id = intval($id);

        if ($id) {

            $db = Database::getConnection();
            
            $query = $db->prepare(
                'SELECT * FROM product
                 WHERE id = :id'
            );

            $query->execute(
                ['id' => $id]
            );

            $result = $query->fetch();

        return $result;
        
        }
    }
    public static function getTotalProductsInCategory($categoryId)
    {
        $db = Database::getConnection();

        $query = $db->prepare(
            'SELECT count(id) AS count
            FROM product
            WHERE status = "1" AND category_id = :category_id'
        );

        $query->execute(
            [
                "category_id" => $categoryId
            ]
        );

        $row = $query->fetch();

        return $row['count'];
    }

    public static function getProductsByIds($idsArray)
    {
        $products = array();

        $db = Database::getConnection();

        $idsString = implode(',', $idsArray);

        $query = $db->query(
            "SELECT * FROM product
             WHERE status='1' AND id IN ($idsString)"
        );
        $result = $query->fetchAll();

        return $result;
    }

    public static function getProductsByPage($page)
    {
        $page = intval($page);
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $db = Database::getConnection();

        $query = $db->prepare(
            'SELECT * FROM product
             WHERE status = "1"
             ORDER BY id DESC
             LIMIT :limit
             OFFSET :offset'
        );
        $query->execute(
            [
                'limit' => self::SHOW_BY_DEFAULT,
                'offset' => $offset
            ]
        );
        $result = $query->fetchAll();

        return $result;
    }

    public static function getTotalProducts()
    {
        $db = Database::getConnection();

        $result = $db->query(
            'SELECT count(id) AS count FROM product
             WHERE status = "1"'
        );

        $row = $result->fetch();

        return $row['count'];
    }

    public static function getRecommendedProducts()
    {
        $db = Database::getConnection();

        $query = $db->query(
            'SELECT * FROM product
            WHERE status = "1" AND is_recommended = "1"'
        );

        return $result = $query->fetchAll();
    }

    public static function getHiddenProducts()
    {
        $db = Database::getConnection();

        $query = $db->query(
            'SELECT * FROM product
             WHERE status = "0"'
        );

        return $result = $query->fetchAll();
    }

    public static function edit($id, $name, $category_id, $code, $price, $availability, $brand, $description, $is_new, $is_recommended, $status)
    {
        $db = Database::getConnection();

        $query = $db->prepare(
            'UPDATE product
             SET name = :name,
                category_id = :category_id,
                code = :code,
                price = :price,
                availability = :availability,
                brand = :brand,
                description = :description,
                is_new = :is_new,
                is_recommended = :is_recommended,
                status = :status
             WHERE id = :id'
        );
        $query->execute(
            [
                'id' => $id,
                'name' => $name,
                'category_id' => $category_id,
                'code' => $code,
                'price' => $price,
                'availability' => $availability,
                'brand' => $brand,
                'description' => $description,
                'is_new' => $is_new,
                'is_recommended' => $is_recommended,
                'status' => $status
            ]
        );

        return $result = true;
    }

    public static function delete($id)
    {
        $db = Database::getConnection();

        $query = $db->prepare(
            'DELETE FROM product
             WHERE id = :id'
        );
        $query->execute(
            ['id' => $id]
        );

        return $result = true;
    }

    public static function create($name, $category_id, $code, $price, $availability, $brand, $description, $is_new, $is_recommended, $status)
    {
        $db = Database::getConnection();

        $query = $db->prepare(
            'INSERT INTO product(
                name,
                category_id,
                code,
                price,
                availability,
                brand,
                description,
                is_new,
                is_recommended,
                status
            ) 

            VALUES (
                :name,
                :category_id,
                :code,
                :price,
                :availability,
                :brand,
                :description,
                :is_new,
                :is_recommended,
                :status
            )'
        );

        $query->execute(
            [
                'name' => $name,
                'category_id' => $category_id,
                'code' => $code,
                'price' => $price,
                'availability' => $availability,
                'brand' => $brand,
                'description' => $description,
                'is_new' => $is_new,
                'is_recommended' => $is_recommended,
                'status' => $status
            ]
        );
        $id = self::getLastId();

        return $id;
    }

    public static function getLastId()
    {
        $db = Database::getConnection();

        $query = $db->query(
            'SELECT MAX(id) as id
             FROM product'
         );
        $lastId = $query->fetch();

        return $lastId['id'];
    }

    public static function setImage($id)
    {
        if ($_FILES['image']['size'] != 0) {
            if (file_exists(ROOT."/template/images/products/$id.jpg")) {
                self::deleteImage($id);
            }
            $name = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];
            move_uploaded_file($tmp_name, ROOT."/template/images/products/$id.jpg");
        }
    }

    public static function deleteImage($id)
    {
        if (file_exists(ROOT."/template/images/products/$id.jpg")) {
            unlink(ROOT."/template/images/products/$id.jpg");
        }
    }

    public static function getImage($id)
    {
        $path = "/template/images/products/$id.jpg";
        if (file_exists(ROOT.$path)) {
            return $path;
        } else {
            return "/template/images/products/default.jpg";
        }
    }
}
