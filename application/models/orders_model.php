<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  /*
  * Orders not yet shipped by given cut-off date
  * * Given: Cut-off Date
  * * Output: Order ID, Customer, Required Date, Shipped Date
  * * Note: Include all orders that are not yet shipped, order must be created
  * *       before the cutoff date
  * *
  */
  function get_not_yet_shipped($cutoff) {
    $query_string =
      'SELECT "OrderID", "RequiredDate", "ShippedDate"
      FROM orders
      WHERE "ShippedDate" > ?';
    $biggest_sale = $this->db->query($query_string, array($cutoff, $cutoff));
    return $biggest_sale;
  }

  /*
  * Total Freight Cost Incurred for Delivery per City, Country
  * * Output: Country, City, Total Freight Cost
  * * Sort by Country
  */
  function get_freight_cost() {
    $query_string =
      'SELECT  "ShipCountry", "ShipCity",
        SUM("Freight") AS "Total Freight Cost"
      FROM orders
      GROUP BY "ShipCountry", "ShipCity"
      ORDER BY "ShipCountry", "ShipCity"';
    $freight_cost = $this->db->query($query_string);
    return $freight_cost;
  }

  /*
  * No. of Shipment per Country
  * * Output: Country, No. of Shipment (delivered orders)
  * * Sort alphabetically by Country
  */
  function get_shipment_summary() {
    $query_string =
      'SELECT  "OrderID", "ShipCountry", "ShippedDate"
      FROM orders';
    $shipment_summary = $this->db->query($query_string);
    return $shipment_summary;
  }

  /*
  * Late shipment by Employee
  * * Given: Last Name, First Name
  * * Output: Order ID, Customer, Order Amount, Date Required, Ship Date
  */
  function get_late_shipments($lastName, $firstName) {
    $query_string =
      'SELECT  "OrderID"
      FROM orders';
    $late_shipments = $this->db->query($query_string,
      array($lastName, $firstName));
    return $late_shipments;
  }

  /*
  * Latest Order per Customer
  * * Output: Customer, Order ID, Order Date, Ship Date (may be null)
  * * Sort by Order Date (from latest to earliest)
  */
  function get_latest_orders() {
    $query_string =
      'SELECT  "OrderID"
      FROM orders';
    $latest_orders = $this->db->query($query_string);
    return $latest_orders;
  }

}
