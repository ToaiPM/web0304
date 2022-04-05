<?php
    class user{
        public function Login($username, $password){
            $sql = "SELECT 
            u.user_id,
            u.user_name,
            u.user_fullname,
            u.user_email,
            u.user_phone,
            u.user_address,
            r.role_name
            FROM 
            user u LEFT JOIN role r ON u.role_id = r.role_id 
            WHERE u.user_name='$username' AND u.user_password='$password'";
            $service = new dataservice();
            $res = $service->ExecuteQuery($sql);
            return ($res==true) ? $res[0] : 0;
        }
    }
?>