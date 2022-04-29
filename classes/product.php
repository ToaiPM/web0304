<?php
    class product{
        public function countTotal($timkiem_header, $boloc_category_id, $boloc_product_name, $boloc_product_status, $boloc_created_at, $boloc_product_price_1, $boloc_product_price_2){
            $sql = "";
            if($timkiem_header != ''){
                $sql = "SELECT
                count(p.product_id) tongsodong
                FROM
                    product p
                LEFT JOIN category c ON p.category_id = c.category_id
                WHERE c.category_name LIKE '%$timkiem_header%' OR p.product_title LIKE '%$timkiem_header%'";
            }else{
                $sql = "SELECT
                count(p.product_id) tongsodong 
                FROM
                    product p
                LEFT JOIN category c ON p.category_id = c.category_id 
                WHERE c.category_id LIKE '%$boloc_category_id%' 
                AND p.product_title LIKE '%$boloc_product_name%' 
                AND p.product_public LIKE '%$boloc_product_status%' 
                AND p.created_at LIKE '%$boloc_created_at%'";
                if($boloc_product_price_1!='' && $boloc_product_price_2!=''){ 
                    $sql .= "AND p.product_purchase_price BETWEEN '$boloc_product_price_1' AND '$boloc_product_price_2'";
                }
            }
            $service = new dataservice();
            $rs = $service->ExecuteQuery($sql);
            return isset($rs) ? $rs[0]['tongsodong'] : 0;
        }

        public function DanhSach($timkiem_header, $boloc_category_id, $boloc_product_name, $boloc_product_status, $boloc_created_at, $boloc_product_price_1, $boloc_product_price_2, $Start=null, $Limit=null){
            $sql = "";
            if($timkiem_header != ''){
                $sql = "SELECT
                *
                FROM
                    product p
                LEFT JOIN category c ON p.category_id = c.category_id
                WHERE c.category_name LIKE '%$timkiem_header%' OR p.product_title LIKE '%$timkiem_header%'";
                $sql .= " LIMIT " . $Start . ", " . $Limit;
            }else{
                $sql = "SELECT
                * 
                FROM
                    product p
                LEFT JOIN category c ON p.category_id = c.category_id 
                WHERE c.category_id LIKE '%$boloc_category_id%' 
                AND p.product_title LIKE '%$boloc_product_name%' 
                AND p.product_public LIKE '%$boloc_product_status%' 
                AND p.created_at LIKE '%$boloc_created_at%'";
                if($boloc_product_price_1!='' && $boloc_product_price_2!=''){ 
                    $sql .= "AND p.product_purchase_price BETWEEN '$boloc_product_price_1' AND '$boloc_product_price_2'";
                }
                $sql .= " LIMIT " . $Start . ", " . $Limit;
            }
            $service = new dataservice();
            return $service->ExecuteQuery($sql);
        }

        public function SanPhamChiaSe($product_id){
            $sql = "UPDATE product SET product_public=1-product_public WHERE product_id=$product_id";
            $service = new dataservice();
            return $service->ExecuteNonQuery($sql);
        }

        public function Them($category_id,$product_title,$product_purchase_price,$product_price,$product_discount,$product_description,$product_amount,$product_public,$ten_moi){
            $sql = "INSERT INTO product (category_id,product_title,product_purchase_price,product_price,product_discount,product_description,product_amount,product_public,product_thumbnail) VALUES($category_id,'$product_title',$product_purchase_price,$product_price,$product_discount,'$product_description',$product_amount,$product_public,'$ten_moi')";
            $service = new dataservice();
            return $service->ExecuteNonQuery($sql);
        }

        public function Xoa($chuoiID){
            $sql = "DELETE FROM product WHERE product_id IN ($chuoiID)";
            $service = new dataservice();
            return $service->ExecuteNonQuery($sql);
        }

        public function ChiTiet($id){
            $sql = "SELECT h.product_id, h.product_thumbnail 
            FROM product h 
            WHERE h.product_id=$id";
            $service = new dataservice();
            $rs = $service->ExecuteQuery($sql);
            return isset($rs) ? $rs[0] : '';
        }
    }
?>