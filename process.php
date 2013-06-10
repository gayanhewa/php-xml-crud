<?php
/**
 * Created by Gayan Hewa
 * User: Gayan
 * Date: 6/7/13
 * Time: 3:12 AM
 */
class Process
{
    protected $_xml;
    protected $path;

    public function __construct()
    {
        $this->_xml = simplexml_load_file("data.xml");
    }

    public function getXml()
    {
        return $this->_xml;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    public function userlist()
    {

        echo "
        <table border='1'>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Job</td>
                    <td>Personality</td>
                    <td>Salary</td>
                    <td>Email</td>
                    <td>User Notes</td>
                    <td>Action</td>
                </tr>
            </thead>
        ";

        foreach ($this->_xml as $user) {
            echo "
            <tr>
                    <td>{$user->attributes()->id}</td>
                    <td>{$user->name}</td>
                    <td>{$user->job}</td>
                    <td>{$user->personality}</td>
                    <td>{$user->salary}</td>
                    <td>{$user->email}</td>
                    <td>{$user->user_notes}</td>
                    <td>
                     <a href='process.php?edit=" . $user->attributes()->id . "'>Edit</a> |
                     <a href='process.php?delete=" . $user->attributes()->id . "'>Delete</a>
                    </td>
            </tr>
            ";
        }
        echo "</table>";
    }

    public function filterList($post)
    {
        $xml = $this->_xml->xpath('user[personality="' . strtolower($post) . '"]');

        echo "
        <table border='1'>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Job</td>
                    <td>Personality</td>
                    <td>Salary</td>
                    <td>Email</td>
                    <td>User Notes</td>
                </tr>
            </thead>
        ";

        foreach ($xml as $user) {

            echo "
            <tr>
                    <td>{$user->attributes()->id}</td>
                    <td>{$user->name}</td>
                    <td>{$user->job}</td>
                    <td>{$user->personality}</td>
                    <td>{$user->salary}</td>
                    <td>{$user->email}</td>
                    <td>{$user->user_notes}</td>
            </tr>
            ";
        }
        echo "</table>";
    }

    public function adduser($post)
    {
        if ($post["name"] != "" &&
            $post["id"] != "" &&
            $post["job"] != "" &&
            $post["personality"] != "" &&
            $post["salary"] != "" &&
            $post["email"] != "" &&
            $post["user_notes"] != ""
        ) {

            $xml = $this->_xml;
            $user = $xml->addChild('user');
            $name = $user->addChild("name", $post["name"]);
            $job = $user->addChild("job", $post["job"]);
            $pers = $user->addChild("personality", $post["personality"]);
            $salary = $user->addChild("salary", $post["salary"]);
            $email = $user->addChild("email", $post["email"]);
            $user_notes = $user->addChild("user_notes", $post["user_notes"]);
            $user->addAttribute("id", $post["id"]);
            $xml->asXML($this->path);
        }
    }

    public function getUserById($id)
    {
        $user = $this->_xml->xpath('//user[@id="' . $id . '"]');
        return $user[0];
    }

    public function updateUser($post)
    {
        $user = $this->_xml->xpath('//user[@id="' . $post['id'] . '"]');

//        $user[0]['id'] = (int) $post["id"];
        $user[0]->name = $post["name"];
        $user[0]->job = $post["job"];
        $user[0]->personality = $post["personality"];
        $user[0]->salary = $post["salary"];
        $user[0]->user_notes = $post["user_notes"];
        $user[0]->email = $post["email"];
        $this->_xml->asXML($this->path);
    }
}

//Include template
include 'index.php';


//$xml->user[0]->name = "Gayan, Hewa";
//$xml->asXML($completeurl);


//Controller
$param = $_SERVER['QUERY_STRING'];
$arr = explode("=", $param);
if (count($arr) > 1) {
    $param = $arr[0];
}
$path = getcwd()."/data.xml";
$process = new Process();
$process->setPath($path);
if ($param == "list") {
    $process->userlist();
}
if ($param == "add") {
    $post = $_POST;
    $process->adduser($post);
    include 'user.php';
}
if ($param == "filter") {
    $post = $_POST["pers"];
    $process->filterList($post);
}

if ($param == "delete") {
    $id = $arr[1];
    $i = 0;
    foreach ($process->getXml() as $user){
        if ($user->attributes()->id == $id){
            unset($process->getXml()->user[$i]);
            $process->getXml()->asXML($path);
            break;
        }
        $i++;
    }
}

if ($param == "edit") {
    $id = $arr[1];
    $user = $process->getUserById($id);
    include 'user.php';
}

if ($param == "update") {
    $post = $_POST;
    $process->updateUser($post);
}