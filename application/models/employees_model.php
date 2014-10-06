<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employees_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  /*
  * List of Employees and who they report to.
  * * Output: Employee, Reports To (Employee they report to)
  */
  function get_all_employees() {
    $query_string =
      'SELECT "LastName" || $$, $$ || "FirstName" AS "Name"
      FROM employees';
    $all_employees = $this->db->query($query_string);
    return $all_employees;
  }

  /*
  * Biggest Sale per Employee
  * * Output: Employee, Order ID, Customer, Order Amount, Order Date, Ship Date
  * * Clue: An order is already shipped if ShippedDate is not null.
  * * Sales = sum of unitprice * (1 - discount) * quantity per product ordered
  */
  function get_biggest_sale() {
    $query_string =
      'SELECT "LastName" || $$, $$ || "FirstName" AS "Name"
      FROM employees';
    $biggest_sale = $this->db->query($query_string);
    return $biggest_sale;
  }

  /*
  * Ranking of Employees by sales for a given year
  * * Given: year (e.g., 1995)
  * * Output: Employee, Sales
  * * Employee ranking must be from highest to lowest sales
  * * Clue: You have to use SUM and ORDER BY
  */
  function get_rank_by_year($year) {
    $query_string =
      'SELECT "LastName" || $$, $$ || "FirstName" AS "Name", "OrderID",
        "ShippedDate"
      FROM employees NATURAL JOIN orders
      WHERE EXTRACT(YEAR FROM "ShippedDate") = ?';
    $rank_by_year = $this->db->query($query_string, array($year));
    return $rank_by_year;
  }

}
