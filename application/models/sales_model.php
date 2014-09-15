<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  /*
  * Summary of Product Sales given a date range.
  * * Given: start date, end date
  * * Output: Category, Product, Sales
  * * Sort by Category; for each Category sort product sales from highest to
  *   lowest sales
  */
  function get_product_sales($start, $end) {
    $query_string =
      'SELECT "CategoryName",
        "ProductName",
        SUM("UnitPrice" * "Quantity") AS "Sales"
      FROM categories NATURAL JOIN
        products NATURAL JOIN
        order_details NATURAL JOIN
        orders
      WHERE "ShippedDate" >= ? AND "ShippedDate" < ?
      GROUP BY "CategoryName", "ProductName"
      ORDER BY "CategoryName", "Sales"';
    $product_sales = $this->db->query($query_string, array($start, $end));
    return $product_sales;
  }

  /*
  * Sales per month (from the earliest shipment to the latest)
  * * Output: Month Year (e.g., August 1994), Total Sales
  * * Sort by Month (include all months even those with no sales)
  * * Hint: You may create a table for Months
  */
  function get_monthly_sales() {
    $query_string =
      'SELECT COUNT(*)
      FROM orders';
    $monthly_sales = $this->db->query($query_string);
    return $monthly_sales;
  }

  /*
  * Sales of Employees per month (from the earliest shipment to the latest)
  * * Output: Employee, Month (e.g., August 1994), Sales
  * * Sort by Month per Employee (include all months for each employee even
  *   those month-employee pairs with no sales)
  */
  function get_sales_by_employee() {
    $query_string =
      'SELECT "LastName" AS "Last Name", "FirstName" AS "First Name", "Title"
      FROM employees';
    $sales_by_employee = $this->db->query($query_string);
    return $sales_by_employee;
  }

}
