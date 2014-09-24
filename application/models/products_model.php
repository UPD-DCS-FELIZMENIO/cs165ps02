<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  /*
  * Products Exceeding Quota Sales for a given year
  * * Given: year (e.g., 1995), Quota Sales (amount)
  * * Output: Category, Product, Sales
  * * Sort by Category; for each Category sort product sales from highest to
  *   lowest sales
  */
  function get_quota_sales($year, $quota) {
    $query_string =
      'SELECT "ProductID", "ProductName"
      FROM products';
    $quota_sales = $this->db->query($query_string, array($year, $quota));
    return $quota_sales;
  }

  /*
  * No. of Products Per Category and most expensive product Per Category
  * * Output: Category ID, Category Name, No. of Products, Product, Unit Price
  * * Sort by Unit Price (from highest to lowest)
  */
  function get_category_summary() {
    $query_string =
      'SELECT "CategoryID", "CategoryName"
      FROM categories';
    $category_summary = $this->db->query($query_string);
    return $category_summary;
  }

  /*
  * Products Still Supplied by Supplier (products that are still available)
  * * Given: Supplier ID
  * * Output: Product ID, Product Name, Category Name
  */
  function get_products_still_supplied($supplierid) {
    $query_string =
      'SELECT "ProductID", "ProductName"
        FROM products';
    $products_still_supplied = $this->db->query($query_string,
      array($supplierid));
    return $products_still_supplied;
  }

  /*
  * Products that have fallen below reorder level that have not yet been
  * reordered OR products that have fallen below reorder level but do NOT have
  * pending orders (i.e., there are no orders that are still for shipment)
  * * Output: Product, Supplier, Units in Stock, Reorder Level
  */
  function get_products_below_reorder_level() {
    $query_string =
      'SELECT "ProductID", "ProductName"
        FROM products';
    $products_below_reorder_level = $this->db->query($query_string);
    return $products_below_reorder_level;
  }

  /*
  * List of discontinued products
  * * Output: Category, Product, Supplier
  * * Sort by Category
  */
  function get_discontinued_products() {
    $query_string =
      'SELECT "ProductID", "ProductName"
        FROM products';
    $discontinued_products = $this->db->query($query_string);
    return $discontinued_products;
  }
}
