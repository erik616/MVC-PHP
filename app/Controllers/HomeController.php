<?php

require_once __DIR__ . "/../Utils/RenderView.php";
require_once __DIR__ . "/../Models/HomeModel.php";

class HomeController extends RenderView
{

    private $homeModel;

    public function __construct()
    {
        $this->homeModel = new HomeModel();
    }

    public function index()
    {
        $bills = $this->homeModel->fetch();
        $company = $this->homeModel->companys();

        $this->loadView("home", [
            "bills" => $bills,
            "companys" => $company
        ]);
    }

    public function create()
    {
        $price = $_POST['price'];
        $date = $_POST['date'];
        $company = $_POST['company'];
        $priceFormat = $this->formatPrice($price);

        $this->homeModel->create($priceFormat, $date, $company);

        header("Location: /home");
    }

    public function pay($id)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $dataLocal = date("Y-m-d", time());

        $bill = $this->homeModel->getBill($id[0]);

        ['valor' => $value, 'data_pagar' => $date] = $bill;

        [$year, $mounth, $day] = explode("-", $dataLocal);
        [$year_bill, $mounth_bill, $day_bill] = explode("-", $date);

        if ($year_bill >= $year) {
            if ($mounth <= $mounth_bill && $day < $day_bill) {
                $value *= 0.95;
            } else if ($day > $day_bill) {
                $value *= 1.1;
            }
        }

        $this->homeModel->pay($id[0], number_format($value, 2));

        header("Location: /home");
    }


    public function edit($id)
    {
        $price = $_POST['price'];
        $date = $_POST['date'];

        $priceFormat = $this->formatPrice($price);

        $this->homeModel->edit($id[0], $priceFormat, $date);

        header("Location: /home");
    }

    public function delete($id)
    {
        $this->homeModel->delete($id[0]);

        header("Location: /home");
    }

    public function filter()
    {
        $price = $_POST['price'];
        $date = $_POST['date'];
        $company = $_POST['company'];
        $operation = $_POST['operation'];

        $filter = [];

        if (!empty($price) && !empty($operation)) {
            $priceFormat = $this->formatPrice($price);
            array_push($filter, "contas.valor $operation $priceFormat");
        }

        if (!empty($date)) {
            array_push($filter, "contas.data_pagar = $date");
        }

        if ($company != "Empresas") {
            array_push($filter, "empresa.id_empresa = $company");
        }

        $response = $this->homeModel->filter($filter);
        $companys  = $this->homeModel->companys();

        $this->loadView("home", [
            "bills" => $response,
            "companys" => $companys
        ]);
    }

    private function formatPrice($price)
    {
        return preg_replace('/[^0-9 | .]|( )+/', "", preg_replace("/,/", ".", $price));
    }
}
