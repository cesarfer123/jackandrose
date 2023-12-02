<?php 

Trait Database{

    public function connect(){
        $conexion = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME , DBUSER , DBPASS);
        return $conexion;
    }

    public function query($query,$data=[]){
        $conexion=$this->connect();
        $stm=$conexion->prepare($query);
        $check=$stm->execute($data);
        if($check){
            $result=$stm->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result)>0){
                return $result;
            }
        }

        return false;
    }

    public function get_row($query, $data = [])
	{

		$con = $this->connect();
		$stm = $con->prepare($query);

		$check = $stm->execute($data);
		if($check)
		{
			$result = $stm->fetchAll(PDO::FETCH_OBJ);
			if(is_array($result) && count($result))
			{
				return $result[0];
			}
		}

		return false;
	}
	
}

// $app=new Database();
// show($app->connect());