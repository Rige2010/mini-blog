<?php error_reporting(-1);

class Database
{
    private $host = "localhost";
    private $dbname = "mini_blog";
    private $dbtable = "posts";
    private $username = "root";
    private $password = "";
    private $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    private $db;

    public function __construct()
    {
        $this->db = new PDO(
            "mysql:host=$this->host;dbname=$this->dbname;",
            $this->username,
            $this->password,
            $this->options
        );
    }

    public function get_posts()
    {
        $stmt = $this->db->prepare("SELECT * FROM `$this->dbtable` ORDER BY `id` DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function get_post($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM `$this->dbtable` WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function add_post($title, $content)
    {
        $stmt = $this->db->prepare("INSERT INTO `$this->dbtable` (`title`, `content`) VALUES (?,?)");
        if ($stmt->execute([$title, $content])) {
            return true;
        } else {
            return false;
        }
    }
}
