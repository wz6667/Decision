<?php
/**
 * Created by PhpStorm.
 * User: wangzhen19
 * Date: 2016/1/7
 * Time: 16:18
 * user表操作
 */
class userModel extends baseModel{
    protected $db;
    protected $table = 'user';

    public function __construct(){
        $this->db = baseModel::getInstance();
    }

    public function insert($email,$passwd){
        $sql = "insert into $this->table(email,pwd)values('$email','$passwd')";
        $this->db->mysqli->query($sql);
        if ($this->db->mysqli->error){
            log::warning($sql,"log.wf");
            return false;
        }
        log::notice($sql,"log.nf");
        return true;
    }

    public function select($email,$passwd){
        $sql = "select email from $this->table where email='$email' and pwd='$passwd'";
        $ret = $this->db->mysqli->query($sql);
        if ($this->db->mysqli->error){
            log::warning($sql,"log.wf");
            return false;
        }
        log::notice($sql,"log.nf");
        return $ret;
    }

    public function selectUid($email){
        $sql = "select userId from $this->table where email='$email' ";
        $ret = $this->db->mysqli->query($sql);
        if ($this->db->mysqli->error){
            log::warning($sql,"log.wf");
            return false;
        }
        log::notice($sql,"log.nf");
        return $ret;
    }

}