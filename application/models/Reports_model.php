<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_model extends CI_Model {

  public $examinersTable = 'oes_examiners';
  public $usersTable  = 'oes_users';
  public $topicsTable = 'oes_topics';

 function reports($page, $limit) {
    $reports = $this->db
      ->query("SELECT DISTINCT
        e.examiner_topic_date_taken AS dateTaken,
        e.examiner_score AS score,
        u.user_id AS id,
        u.user_name AS name,
        t.topic_id AS tid,
        t.topic_title AS title
        FROM oes_examiners AS e
        INNER JOIN oes_users AS u
        ON u.user_id = e.examiner_id
        INNER JOIN oes_topics AS t
        ON e.examiner_topics = t.topic_id
        WHERE e.examiner_score != '' LIMIT $page, $limit")
      ->result();

    return $reports;
  }

  function countReports() {
    $countReports = $this->db
      ->query("SELECT DISTINCT
        e.examiner_topic_date_taken AS dateTaken,
        e.examiner_score AS score,
        u.user_id AS id,
        u.user_name AS name,
        t.topic_title AS title
        FROM oes_examiners AS e
        INNER JOIN oes_users AS u
        ON u.user_id = e.examiner_id
        INNER JOIN oes_topics AS t
        ON e.examiner_topics = t.topic_id
        WHERE e.examiner_score != ''")
      ->num_rows();

    return $countReports;
  }

 function searchHistory($term, $page, $limit) {
    $reports = $this->db
      ->query("SELECT DISTINCT
        e.examiner_topic_date_taken AS dateTaken,
        e.examiner_score AS score,
        e.examiner_no AS eno,
        u.user_id AS id,
        u.user_name AS name,
        t.topic_title AS title
        FROM oes_examiners AS e
        INNER JOIN oes_users AS u
        ON u.user_id = e.examiner_id
        INNER JOIN oes_topics AS t
        ON e.examiner_topics = t.topic_id
        WHERE e.examiner_topics = $term && e.examiner_score != '' LIMIT $page, $limit")
      ->result();

    return $reports;
  }

  function countSearchHistory($term) {
    $countReports = $this->db
      ->query("SELECT DISTINCT
        e.examiner_topic_date_taken AS dateTaken,
        e.examiner_score AS score,
        u.user_id AS id,
        u.user_name AS name,
        t.topic_title AS title
        FROM oes_examiners AS e
        INNER JOIN oes_users AS u
        ON u.user_id = e.examiner_id
        INNER JOIN oes_topics AS t
        ON e.examiner_topics = t.topic_id
        WHERE e.examiner_topics = $term && e.examiner_score != '' ")
      ->num_rows();

    return $countReports;
  }

  function getAllUsers() {
    $getAllExaminersById = $this->db
      ->get($this->usersTable)
      ->num_rows();
    return $getAllExaminersById;
  }

  function getGoogleUsers() {
    $getGoogleUsers = $this->db
      ->where('user_google_login', 1)
      ->get($this->usersTable)
      ->num_rows();
    return $getGoogleUsers;
  }

  function getRegisteredUsers() {
    $getRegisteredUsers = $this->db
      ->where('user_google_login', 0)
      ->get($this->usersTable)
      ->num_rows();
    return $getRegisteredUsers;
  }

  function getAllTopics() {
    $getAllTopics = $this->db
      ->get($this->topicsTable)
      ->num_rows();
    return $getAllTopics;
  }

}