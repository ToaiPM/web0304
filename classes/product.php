<?php
    class product{
        public function countTotal($timkiem_header, $boloc_category_id, $boloc_product_name, $boloc_product_status, $boloc_product_purchase_price, $boloc_product_price_1, $boloc_product_price_2){
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
                * 
                FROM
                    product p
                LEFT JOIN category c ON p.category_id = c.category_id 
                WHERE ";
            }
            $service = new dataservice();
            $rs = $service->ExecuteQuery($sql);
            return isset($rs) ? $rs[0]['tongsodong'] : 0;
        }
    }
?>