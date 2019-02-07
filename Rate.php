<?php
require_once "DBController.php";

class Rate extends DBController
{

    function updateRatingCount($rating, $id)
    {
        $query = "UPDATE tbl_tutorial SET  rating = ? WHERE id= ?";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $rating
            ),
            array(
                "param_type" => "i",
                "param_value" => $id
            )
        );
        
        $this->updateDB($query, $params);
    }
}
