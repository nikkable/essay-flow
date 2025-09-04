<?php
/**
 * Class Report
 */
class Report extends YiiBase
{
    public $html = '';
    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
        $products = $order->products;

        $this->html = '
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	
	<style type="text/css">
	* {font-family: Montserrat,Arial,sans-serif;font-size: 14px;line-height: 14px;}
	table {margin: 0 0 15px 0;width: 100%;border-collapse: collapse;border-spacing: 0;}		
	table th {padding: 5px;font-weight: bold;}        
	table td {padding: 5px;}	
	.header {margin: 0 0 0 0;padding: 0 0 15px 0;font-size: 12px;line-height: 12px;text-align: center;}
	h1 {margin: 0 0 10px 0;padding: 10px 0;border-bottom: 2px solid #000;font-weight: bold;font-size: 20px;line-height: 1.2;}
		
	/* Реквизиты банка */
	.details td {padding: 3px 2px;border: 1px solid #000000;font-size: 12px;line-height: 12px;vertical-align: top;}
 
	/* Поставщик/Покупатель */
	.contract th {padding: 3px 0;vertical-align: top;text-align: left;font-size: 13px;line-height: 15px;}	
	.contract td {padding: 3px 0;}		
 
	/* Наименование товара, работ, услуг */
	.list thead, .list tbody  {border: 2px solid #000;}
	.list thead th {padding: 4px 0;border: 1px solid #000;vertical-align: middle;text-align: center;}	
	.list tbody td {padding: 0 2px;border: 1px solid #000;vertical-align: middle;font-size: 11px;line-height: 13px;}	
	.list tfoot th {padding: 3px 2px;border: none;text-align: right;}	
 
	/* Сумма */
	.total {margin: 0 0 20px 0;padding: 0 0 10px 0;border-bottom: 2px solid #000;}	
	.total p {margin: 0;padding: 0;}
		
	/* Руководитель, бухгалтер */
	.sign {position: relative;}
	.sign table {width: 60%;}
	.sign th {padding: 40px 0 0 0;text-align: left;}
	.sign td {padding: 40px 0 0 0;border-bottom: 1px solid #000;text-align: right;font-size: 12px;}
	.sign-1 {position: absolute;left: 149px;top: -44px;}	
	.sign-2 {position: absolute;left: 149px;top: 0;}	
	.printing {position: absolute;left: 271px;top: -15px;}
	</style>
</head>
<body>
    <p>
        <img src="' . Yii::app()->request->hostInfo . Yii::app()->getTheme()->getAssetsUrl() . '/images/logo-black.jpg' . '" alt="">
    </p>

	<h1>Invoice for payment #' . $this->order->orderNumber . ' </br>from ' . date('d.m.Y', strtotime($this->order->date)) . '.</h1>
	
	<table class="contract">
		<tbody>
			<tr>
				<td width="20%">Company site:</td>
				<th width="80%">' . Yii::app()->request->hostInfo . '</th>
			</tr>
			<tr>
				<td width="20%">Company name:</td>
				<th width="80%">Company name</th>
			</tr>
			<tr>
				<td width="20%">Company address:</td>
				<th width="80%">Company address</th>
			</tr>
			<tr>
				<td width="20%">Company reg number:</td>
				<th width="80%">Company reg number</th>
			</tr>
			<tr>
				<td width="20%">Company email:</td>
				<th width="80%">' . Yii::app()->getModule('yupe')->email . '</th>
			</tr>
		</tbody>
	</table>
 
	<table class="contract">
		<tbody>
			<tr>
				<td width="20%">Buyer:</td>
				<th width="80%">' . $this->order->name . '</th>
			</tr>
			<tr>
				<td width="20%">Buyer email:</td>
				<th width="80%">' . $this->order->email . '</th>
			</tr>
			<tr>
				<td width="20%">Buyer phone:</td>
				<th width="80%">' . $this->order->phone . '</th>
			</tr>
		</tbody>
	</table>
 
	<table class="list">
		<thead>
			<tr>
				<th width="10%">Number</th>
				<th width="50%">Product name</th>
				<th width="40%">Price</th>
			</tr>
		</thead>
		<tbody>';

        $nds = $this->order->getTotalTaxFormat();
        $total = $this->order->getTotalCurrency();
        $totalPrice = $this->order->getTotalPriceCurrency();
        $totalPre = $this->order->getTotalPriceCurrency() - $this->order->getTotalTax();
        $totalDiscount = $this->order->getTotalDiscountCurrency();

        foreach ($products as $i => $row) {
            $this->html .= '
			<tr>
				<td align="center">' . (++$i) . '</td>
				<td align="left">' . $row->product->name . '</td>
				<td align="right">' . self::format_price($row->getTotalPrice()) . '</td>
			</tr>';
        }

        $this->html .= '
		</tbody>
		<tfoot>
			<tr>
                <th></th>
                <th></th>
				<th>' . Yii::t("OrderModule.order", "Total") . ': ' . self::format_price($total) . ' ' . Yii::app()->controller->currency . '</th>
			</tr>
			<tr>
			    <th></th>
                <th></th>
				<th width="40%">' . Yii::t("OrderModule.order", "Discount") . ': ' . self::format_price($totalDiscount) . ' ' . Yii::app()->controller->currency . '</th>
			</tr>
			<tr>
			    <th></th>
                <th></th>
				<th width="40%">' . Yii::t("OrderModule.order", "Tax") . ': ' . $nds . '</th>
			</tr>
			<tr>
			    <th></th>
                <th></th>
				<th width="40%">' . Yii::t("OrderModule.order", "Total to be paid") . ': ' . self::format_price($totalPrice) . ' ' . Yii::app()->controller->currency . '</th>
			</tr>
		</tfoot>
	</table>
	
	<p class="header">' . Yii::t("OrderModule.order", "This is an electronically generated invoice, no signature is required.") . '</p>
</body>
</html>';
    }

    public function generate()
    {
        $dompdf = new Dompdf\Dompdf();
        $dompdf->set_option('isRemoteEnabled', TRUE);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->loadHtml($this->html, 'UTF-8');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('Invoice #' . $this->order->orderNumber);

        // Или сохранение на сервере:
        // $pdf = $dompdf->output();
        // file_put_contents(__DIR__ . '/schet.pdf', $pdf);
    }

    // Форматирование цен.
    function format_price($value)
    {
        return number_format($value, 2, ',', ' ');
    }

    // Сумма прописью.
    function str_price($value)
    {
        $value = explode('.', number_format($value, 2, '.', ''));

        $f = new NumberFormatter('ru', NumberFormatter::SPELLOUT);
        $str = $f->format($value[0]);

        // Первую букву в верхний регистр.
        $str = mb_strtoupper(mb_substr($str, 0, 1)) . mb_substr($str, 1, mb_strlen($str));

        // Склонение слова "рубль".
        $num = $value[0] % 100;
        if ($num > 19) {
            $num = $num % 10;
        }
        switch ($num) {
            case 1: $rub = 'рубль'; break;
            case 2:
            case 3:
            case 4: $rub = 'рубля'; break;
            default: $rub = 'рублей';
        }

        return $str . ' ' . $rub . ' ' . $value[1] . ' копеек.';
    }
}
