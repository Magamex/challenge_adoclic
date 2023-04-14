<?php

class UserStatsModel {
    private $conn;
    private $table_name = "user_stats";

    private $id;
    private $user_id;
    private $views;
    private $clicks;
    private $conversions;
    private $date;
    
    public function __construct($db) {
        $this->conn = $db;
    }

    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getUserId() {
        return $this->user_id;
    }
    
    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }
    
    public function getViews() {
        return $this->views;
    }
    
    public function setViews($views) {
        $this->views = $views;
    }
    
    public function getClicks() {
        return $this->clicks;
    }
    
    public function setClicks($clicks) {
        $this->clicks = $clicks;
    }
    
    public function getConversions() {
        return $this->conversions;
    }
    
    public function setConversions($conversions) {
        $this->conversions = $conversions;
    }
    
    public function getDate() {
        return $this->date;
    }
    
    public function setDate($date) {
        $this->date = $date;
    }

    public function selectStats(string $dateFrom, string $dateTo, string $totalClicks = null): mysqli_result{
        $sql = "SELECT CONCAT(u.first_name, ' ', u.last_name) AS full_name, 
                    SUM(us.views) AS total_views, 
                    SUM(us.clicks) AS total_clicks, 
                    SUM(us.conversions) AS total_conversions, 
                    ROUND((SUM(us.conversions) / SUM(us.clicks)) * 100, 2) AS cr, 
                    MAX(us.date) AS last_date 
                    FROM user_stats us 
                    INNER JOIN users u ON us.user_id = u.id 
                    WHERE us.date >= ? AND us.date <= DATE_ADD(?, INTERVAL 1 DAY) AND u.status = 'active'
                    GROUP BY u.id";

        if (!is_null($totalClicks)) {
            $sql .= " HAVING total_clicks >= ?";
        }

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param('ssi', $dateFrom, $dateTo, $totalClicks);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result;
    }
}
