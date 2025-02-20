<?php

/**
 * Classe responsavel por fazer conexão com o banco de dados,
 * nela há os metodos responsaveis por todas as querys feitas no banco de dados
 */

require_once __DIR__ . "/../database/connection.php";

class HomeModel extends Connection
{

    private $connectionPDO;

    // Construtor ira atribuir ao atributo connectionPDO a conexão
    public function __construct()
    {
        $this->connectionPDO = $this->connect();
    }

    // metodo responsavel de buscar todas as contas
    public function fetch()
    {
        $queryContas = $this->connectionPDO->query("SELECT contas.valor, DATE_FORMAT(contas.data_pagar, '%d/%m/%Y') as data_pagar, contas.pago, contas.id_conta_pagar, empresa.nome as empresa FROM tbl_conta_pagar as contas INNER JOIN tbl_empresa as empresa ON contas.id_empresa = empresa.id_empresa");
        $queryContas->execute();

        return $queryContas->fetchAll(PDO::FETCH_ASSOC);
    }

    // metodo responsavel de buscar as companias
    public function companys()
    {
        $queryEmpresa = $this->connectionPDO->query("SELECT * FROM tbl_empresa");
        $queryEmpresa->execute();        
        
        return $queryEmpresa->fetchAll(PDO::FETCH_ASSOC);
    }

    // metodo responsavel de cadastrar uma conta
    public function create($price, $date, $company)
    {

        $id = rand(1, 999999);
        $company = intval($company);

        try {
            $sql = "INSERT INTO tbl_conta_pagar (id_conta_pagar, valor, data_pagar, pago, id_empresa) VALUES (:id,:price,:date,:paid,:company)";
            $queryInsert = $this->connectionPDO->prepare($sql);

            $queryInsert->bindValue(':id', $id);
            $queryInsert->bindValue(':price', $price);
            $queryInsert->bindValue(':date', $date);
            $queryInsert->bindValue(':paid', 0);
            $queryInsert->bindValue(':company', $company);

            $queryInsert->execute();
        } catch (PDOException $e) {
            return $e;
        }
    }

    // metodo responsavel de pagar uma conta
    public function pay($id, $value)
    {
        $value = preg_replace("/,/", "", $value);
        try {
            $sql = "UPDATE tbl_conta_pagar SET pago='1', valor=:value WHERE id_conta_pagar=:id";

            $update = $this->connectionPDO->prepare($sql);
            $update->bindValue(":id", $id);
            $update->bindValue(":value", $value);

            $update->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    // metodo responsavel de editar uma conta
    public function edit($id, $price, $date)
    {

        try {
            $sql = "UPDATE tbl_conta_pagar SET valor=:price, data_pagar=:date WHERE  id_conta_pagar=:id";

            $update = $this->connectionPDO->prepare($sql);
            $update->bindValue(":id", $id);
            $update->bindValue(":price", $price);
            $update->bindValue(":date", $date);

            $update->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    // metodo responsavel de apagar uma conta
    public function delete($id)
    {
        try {
            $sql = "DELETE FROM tbl_conta_pagar WHERE id_conta_pagar=:id";

            $update = $this->connectionPDO->prepare($sql);
            $update->bindValue(":id", $id);

            $update->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    // metodo responsavel por fazer o filtro das contas
    public function filter($params)
    {
        $filter = implode(" AND ", $params);

        $query = "SELECT contas.valor, DATE_FORMAT(contas.data_pagar, '%d/%m/%Y') as data_pagar, 
            contas.pago, contas.id_conta_pagar, empresa.nome as empresa
            FROM tbl_conta_pagar as contas INNER JOIN tbl_empresa as empresa
            ON contas.id_empresa = empresa.id_empresa WHERE $filter";

        try {
            $result = $this->connectionPDO->prepare($query);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
        }
    }

    // metodo responsavel de buscar uma conta pelo identificador
    public function getBill($id)
    {
        $sql = "SELECT valor, data_pagar FROM tbl_conta_pagar WHERE id_conta_pagar=:id";

        $queryContas = $this->connectionPDO->prepare($sql);
        $queryContas->bindValue(":id", $id);

        $queryContas->execute();

        return $queryContas->fetch(PDO::FETCH_ASSOC);
    }
}
