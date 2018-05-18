<?php
class StockValidator {
    private $bikeType;
    private $dateFrom;
    private $dateTo;

    function __construct($bikeType, $dateFrom, $dateTo) {
        $this->bikeType = $bikeType;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }

    function getStock() {
        include ("connection.inc");
        $query = 'SELECT stock FROM biketype WHERE id = '.$this->bikeType;
                $resultados = mysqli_query($link, $query) or die (mysqli_error($link));
        $result = $resultados->fetch_assoc();

        return $result["stock"];
    }

    function countBookings() {
        include ("connection.inc");
        //$preparedStatement = $link->prepare('SELECT count(*) FROM booking WHERE (dateFrom between ? and ? ) or (dateTo between ? and ?)  or ( dateFrom <= ? and dateTo >= ? ) and status = 2 group_by id ');

        $query ='SELECT count(*) as reservas FROM booking WHERE ((dateFrom between \''.$this->dateFrom.'\' and \''.$this->dateTo.'\' ) or (dateTo between \''.$this->dateFrom.'\' and \''.$this->dateTo.'\')  or ( dateFrom <= \''.$this->dateFrom.'\' and dateTo >= \''.$this->dateTo.'\' )) and status = 2 and idTypeBike = '.$this->bikeType;
        $resultados = mysqli_query($link, $query) or die (mysqli_error($link));
        $result = $resultados->fetch_assoc();


        // $preparedStatement->bind_param('ssssss', $this->dateFrom, $this->dateTo, $this->dateFrom,$this->dateTo, $this->dateFrom,$this->dateTo);
        // $result = $preparedStatement->execute();
        // $preparedStatement->close();

        return $result["reservas"];
    }

    public function isAvailable() { 
        $exito = true;
        $stockDisponible = $this->getStock();
        $cantidadReservas = $this->countBookings();

        if($cantidadReservas >= $stockDisponible )
            $exito = false;
        

        return $exito;
        //return (3 < getStock($bikeType));
    }

}
?>
