<?php
require_once('database.php');
Class API extends DBConnection{
    public function __construct(){
        parent::__construct();
    }
    public function __destruct(){
        parent::__destruct();
    }

    private function get_client_info() {
        $ip = $_SERVER['REMOTE_ADDR'];
        $hostname = gethostbyaddr($ip);
        return "{$hostname} ({$ip})";
    }

    function save_member(){
        $data = "";
        $id = $_POST['id'];
        $user = $this->get_client_info(); // Capture client information
        foreach($_POST as $k => $v){
            // excluding id and user
            if(!in_array($k, array('id'))){
                // add comma if data variable is not empty
                if(!empty($data)) $data .= ", ";
                $data .= " `{$k}` = '{$v}' ";
            }
        }
        $data .= ", `user` = '{$user}', `last_update` = NOW() "; // add user and last_update columns

        if(empty($id)){
            // Insert New Member
            $sql = "INSERT INTO `members` set {$data}";
        }else{
            // Update Member's Details
            $sql = "UPDATE `members` set {$data} where id = '{$id}'";
        }
        $save = $this->conn->query($sql);
        if($save && !$this->conn->error){
            $resp['status'] = 'success';
            if(empty($id))
                $resp['msg'] = 'New Doctor successfully added';
            else
                $resp['msg'] = 'Doctor\'s Details successfully updated';
        }else{
            $resp['status'] = 'failed';
            $resp['msg'] = 'There\'s an error occurred while saving the data';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }

    function delete_member(){
        $id = $_POST['id'];
        $delete = $this->conn->query("DELETE FROM `members` where id = '{$id}'");
        if($delete){
            $resp['status'] = 'success';
        }else{
            $resp['status'] = 'failed';
            $resp['msg'] = 'There\'s an error occurred while deleting the data';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }
}

$action = isset($_GET['action']) ? $_GET['action'] : '';
$api = new API();
switch ($action){
    case 'save':
        echo $api->save_member();
        break;
    case 'delete':
        echo $api->delete_member();
        break;
    default:
        echo json_encode(array('status'=>'failed','error'=>'unknown action'));
        break;
}
?>
