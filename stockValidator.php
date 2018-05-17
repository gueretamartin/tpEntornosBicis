<?php
class StockValidator {
    private $bikeType;
    private $dateFrom;
    private $dateTo;
    private $stock;

    function __construct($bikeType, $dateFrom, $dateTo) {
        $this->bikeType = $bikeType;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->stock = getStock($bikeType);
    }

    function getStock($bikeType) {
        include ("connection.inc");
        $preparedStatement = $link->prepare("SELECT stock FROM bikeType WHERE id = ?");
        $preparedStatement->bind_param('i', $bikeType);
        $result = $preparedStatement->execute();
        $preparedStatement->close();
        return $result;
    }

    function countBookings() {
        include ("connection.inc");
        $preparedStatement = $link->prepare("SELECT count(*) FROM booking WHERE (dateFrom between ? and ? ) or (dateTo between ? and ?) and (status = 1 or status = 2) group_by id ");
        $preparedStatement->bind_param('ssss', $dateTo, $dateFrom, $dateTo, $dateFrom);
        $result = $preparedStatement->execute();
        $preparedStatement->close();
        return $result;
    }

    function isAvailable() {
        return countBookings() < $stock
    }

}
?>
