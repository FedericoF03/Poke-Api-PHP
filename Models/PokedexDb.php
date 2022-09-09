<?php 

class PokedexDb {
    private $host = 'bcvtanquc4e5oru0kyzs-mysql.services.clever-cloud.com';
    private $user = 'uvyw2c4bgg0eiycv';
    private $db_name = 'bcvtanquc4e5oru0kyzs';
    private $pass = 'NM7G8vyALQQswLSBPYNM';  /* Censurado por seguridad */
    private $query;
    protected $rows = array();


    public function set_query($query) {
        $this->query = $query;
    }

    public function get_query() {
        try {
            $db = new PDO('mysql:host='.$this->host.";dbname=".$this->db_name, $this->user, $this->pass);
            $db->exec("SET CHARACTER SET utf8");
            $db = $db->prepare($this->query);
            $db->execute();
            
            while($data = $db->fetch(PDO::FETCH_ASSOC)) { array_push($this->rows, $data); }
            $db->closeCursor();
            return $this->rows;
        } catch (PDOException $e) {
            $template_error ='<div>
            <p>Error'. $e->getMessage().'</p>
            </div>';

            print($template_error);
        } finally {
            $db = null;
        }
        
    }
    public function set() {
        isset($_POST['is_legendary']) ? $legendary = 1 : $legendary = 0;
        isset($_POST['is_mythical'])? $mythical = 1 :  $mythical = 0;
        $route = $_FILES['image']['tmp_name'];
        $size = $_FILES['image']['size'];
        $archive = fopen($route, "r");
        $cont = fread($archive, $size);
        fclose($archive);
        try {
            $db = new PDO('mysql:host='.$this->host.";dbname=".$this->db_name, $this->user, $this->pass);
            $db->exec("SET names utf8");
            $db = $db->prepare($this->query);
            $db->execute(array(
             $_POST['name'],
             $_POST['weight'],
             $_POST['height'],
             $_POST['types'],
             $_POST['types2'],
             $_POST['abilities'],
             $_POST['abilities2'],
             $_POST['hp'],
             $_POST['attack'],
             $_POST['defense'],
             $_POST['special_attack'],
             $_POST['special_defense'],
             $_POST['speed'],
             $_FILES['image']['type'],
             $_FILES['image']['name'],
             $cont,
             time(),
             $_POST['pokes_chain'],
             $legendary,
             $mythical,
            ));
            $db->fetch();
            $db->closeCursor();
        } catch (PDOException $e) {
            $template_error ='<div>
            <p>Error'. $e->getMessage().'</p>
            </div>';

            print($template_error);
        } finally {
            $db = null;
        }
        
    }
}      
?>