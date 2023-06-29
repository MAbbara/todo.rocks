<?php

class ListModel {
    private $db;

    private $listID;

    private $listName;

    function __construct($db, $listID = null)
    {
        $this->db = $db;
        $this->listID = $listID;
    }

    function createList(String $name) : String
    {
        $listID = $this->randomId();

        $stmt = $this->db->prepare("INSERT INTO lists (`listID`, `listName`) VALUES (?, ?)");
        $stmt->bind_param("ss", $listID, $name);
        if ($stmt->execute()) {
            return $listID;
        }

        return false;
    }

    function setListID(String $listID)
    {
        $listID = $this->db->real_escape_string($listID);
        $this->listID = $listID;
    }

    function getUpcoming() : int
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS c FROM list_items WHERE listID=? AND dueDate > UNIX_TIMESTAMP(CURDATE())");
        $stmt->bind_param("s", $this->listID);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        $upcoming = intval($res['c']);

        return $upcoming;
    }

    function getOverDue() : int
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS c FROM list_items WHERE listID=? AND UNIX_TIMESTAMP(CURDATE()) > (dueDate+(24*3600)) AND dueDate != 0");
        $stmt->bind_param("s", $this->listID);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        $overDue = intval($res['c']);

        return $overDue;
    }

    function getAllItems() : array
    {
        $items = array();
        $stmt = $this->db->prepare("SELECT itemID, item, `description`, dueDate, checked FROM list_items WHERE listID=? ORDER BY dueDate ASC, checked ASC");
        $stmt->bind_param("s", $this->listID);
        $stmt->execute();
        $res = $stmt->get_result();
        
        while ($row = $res->fetch_assoc()) {
            $row['item'] = Encryption::decrypt($this->listID, $row['item']);
            $row['passed'] = time() > strtotime($row['dueDate']);
            $row['description'] = $row['description'] != null ? Encryption::decrypt($this->listID, $row['description']) : null;
            array_push($items, $row);
        }

        return $items;
    }

    function getListName() : String
    {
        if ($this->listName == null) {
            $stmt = $this->db->prepare("SELECT listName FROM lists WHERE listID=?");
            $stmt->bind_param("s", $this->listID);
            $stmt->execute();

            $res = $stmt->get_result();
            $res = $res->fetch_assoc();

            $this->listName = $res['listName'];
        }

        return $this->listName;
    }
    
    function addItem(String $item, String $description = null, String $dueDate = null, String $listID = null) : bool
    {
        if ($listID != null || $this->listID != null) {
            $this->listID = $listID != null ? $listID : $this->listID;
            $item = Encryption::encrypt($this->listID, $item);
            $description = Encryption::encrypt($this->listID, $description);
            $stmt = $this->db->prepare("INSERT INTO list_items (`listID`, `item`, `description`, `dueDate`) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $this->listID, $item, $description, $dueDate);
            return $stmt->execute();
        }

        return false;
    }

    function updateItem(int $itemID, int $checked, String $listID = null) : bool
    {   
        if ($listID != null || $this->listID != null) {
            $this->listID = $listID != null ? $listID : $this->listID;
            $stmt = $this->db->prepare("UPDATE list_items SET checked=? WHERE listID=? AND itemID=?");
            $stmt->bind_param("isi", $checked, $this->listID, $itemID);
            return $stmt->execute();
        }
        return false;
    }

    function deleteItem(int $itemID, String $listID = null) : bool
    {
        if ($listID != null || $this->listID != null) {
            $this->listID = $listID != null ? $listID : $this->listID;
            $stmt = $this->db->prepare("DELETE FROM list_items WHERE listID=? AND itemID=?");
            $stmt->bind_param("si", $this->listID, $itemID);
            return $stmt->execute();
        }
        return false;
    }

    function randomId() : String
    {
        $length = random_int(5, 8);
        $chars='0123456789abcdefghijklmnopqrstuvwxyz';

        $totalChars = strlen($chars);

        $totalRepeat = ceil($length/$totalChars);

        $repeatString = str_repeat($chars, $totalRepeat);

        $shuffleString = str_shuffle($repeatString);

        $listID = substr($shuffleString,1,$length);

        if ($this->idExists($listID)) {
            return $this->randomId();
        } 

        return $listID;
    }

    function idExists(String $listID = null) : bool
    {   
        $this->listID = $listID != null ? $listID : $this->listID;
        $stmt = $this->db->prepare("SELECT listID FROM lists WHERE listID=?");
        $stmt->bind_param("s", $this->listID);
        $stmt->execute();

        $res = $stmt->get_result();

        return $res->num_rows > 0;
    }

    function deleteAllItems(String $listID = null) : bool
    {
        if ($listID != null || $this->listID != null) {
            $this->listID = $listID != null ? $listID : $this->listID;
            $stmt = $this->db->prepare("DELETE FROM list_items WHERE listID=?");
            $stmt->bind_param("s", $this->listID);
            return $stmt->execute();
        }

        return false;
    }

    function deleteList(String $listID = null) : bool
    {
        if ($listID != null || $this->listID != null) {
            $this->listID = $listID != null ? $listID : $this->listID;
            
            if ($this->deleteAllItems()) {
                $stmt = $this->db->prepare("DELETE FROM lists WHERE listID=?");
                $stmt->bind_param("s", $this->listID);
                return $stmt->execute();
            }
        }

        return false;
    }
}