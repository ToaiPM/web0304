<?php
    class category
    {
        public function countTotal($search, $search_ma, $search_ten){
            $sql = '';
            if($search != ''){
                $sql = "SELECT
                        count(h.category_id) tongsodong
                    FROM
                    category h 
                    WHERE h.category_code LIKE '%$search%' OR h.category_name LIKE '%$search%'";
                    $service = new dataservice();
                    $rs = $service->ExecuteQuery($sql);
                    return isset($rs) ? $rs[0]['tongsodong'] : 0;
            }else{
                $sql = "SELECT
                        count(h.category_id) tongsodong
                    FROM
                    category h 
                    WHERE h.category_code LIKE '%$search_ma%' AND h.category_name LIKE '%$search_ten%'";
                    $service = new dataservice();
                    $rs = $service->ExecuteQuery($sql);
                    return isset($rs) ? $rs[0]['tongsodong'] : 0;
            }
        }

        public function DanhSach($search, $search_ma, $search_ten, $Start=null, $Limit=null){
            $sql = '';
            if($search != ''){
                $sql = "SELECT h.category_id, h.category_code, h.category_name 
                FROM category h 
                WHERE h.category_code LIKE '%$search%' OR h.category_name LIKE '%$search%' ";
                $sql .= " LIMIT " . $Start . ", " . $Limit;
                $service = new dataservice();
                return $service->ExecuteQuery($sql);
            }else{
                $sql = "SELECT h.category_id, h.category_code, h.category_name 
                FROM category h 
                WHERE h.category_code LIKE '%$search_ma%' AND h.category_name LIKE '%$search_ten%' ";
                $sql .= " LIMIT " . $Start . ", " . $Limit;
                $service = new dataservice();
                return $service->ExecuteQuery($sql);
            }
        }
        
        public function Them($ma, $ten){
            $sql = "INSERT INTO category (category_code, category_name) VALUES('$ma','$ten')";
            $service = new dataservice();
            return $service->ExecuteNonQuery($sql);
        }

        public function ChiTiet($id){
            $sql = "SELECT h.category_id, h.category_code, h.category_name 
            FROM category h 
            WHERE h.category_id=$id";
            $service = new dataservice();
            $rs = $service->ExecuteQuery($sql);
            return isset($rs) ? $rs[0] : '';
        }

        public function CapNhat($id, $ma, $ten){
            $sql = "UPDATE category 
            SET category_code ='$ma', category_name ='$ten' 
            WHERE category_id =$id";
            $service = new dataservice();
            return $service->ExecuteNonQuery($sql);
        }
        
        public function Xoa($chuoiID){
            $sql = "DELETE FROM category WHERE category_id IN ($chuoiID)";
            $service = new dataservice();
            return $service->ExecuteNonQuery($sql);
        }

        public function getInfo(){
            $sql = "SELECT c.category_id,c.category_name FROM category c";
            $service = new dataservice();
            return $service->ExecuteQuery($sql);
        }
    }
?>