<?php


//;extension = gd    EN  PHP.INI
require_once('TCPDF/tcpdf.php'); //Llamando a la Libreria TCPDF
require_once('./database/connection.php'); //Llamando a la conexión para BD
date_default_timezone_set('America/Bogota');


ob_end_clean(); //limpiar la memoria


class MYPDF extends TCPDF{
      
    	public function Header() {
            $bMargin = $this->getBreakMargin();
            $auto_page_break = $this->AutoPageBreak;
            $this->SetAutoPageBreak(false, 0);
            $img_file = dirname( __FILE__ ) .'/images/logo.png';
            $this->Image($img_file, 80, 8, 40, 40, '', '', '', false, 30, '', false, false, 0);
            $this->SetAutoPageBreak($auto_page_break, $bMargin);
            $this->setPageMark();
	    }
}


//Iniciando un nuevo pdf
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, 'mm', 'Letter', true, 'UTF-8', false);
 
//Establecer margenes del PDF
$pdf->SetMargins(10, 35, 10);
$pdf->SetHeaderMargin(20);
$pdf->setPrintFooter(false);
$pdf->setPrintHeader(true); //Eliminar la linea superior del PDF por defecto
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM); //Activa o desactiva el modo de salto de página automático
 
//Informacion del PDF
$pdf->SetCreator('UrianViera');
$pdf->SetAuthor('UrianViera');
$pdf->SetTitle('Informe de Empleados');
 
/** Eje de Coordenadas
 *          Y
 *          -
 *          - 
 *          -
 *  X ------------- X
 *          -
 *          -
 *          -
 *          Y
 * 
 * $pdf->SetXY(X, Y);
 */

//Agregando la primera página
$pdf->AddPage();
$pdf->SetFont('helvetica','B',10); //Tipo de fuente y tamaño de letra
$pdf->SetXY(150, 25);
$pdf->Write(0, 'Fecha: '. date('d-m-Y'));
$pdf->SetXY(150, 30);
$pdf->Write(0, 'Hora: '. date('h:i A'));


$pdf->Ln(20); //Salto de Linea
$pdf->Cell(40,26,'',0,0,'C');
/*$pdf->SetDrawColor(50, 0, 0, 0);
$pdf->SetFillColor(100, 0, 0, 0); */
$pdf->SetTextColor(34,68,136);
//$pdf->SetTextColor(255,204,0); //Amarillo
//$pdf->SetTextColor(34,68,136); //Azul
//$pdf->SetTextColor(153,204,0); //Verde
//$pdf->SetTextColor(204,0,0); //Marron
//$pdf->SetTextColor(245,245,205); //Gris claro
//$pdf->SetTextColor(100, 0, 0); //Color Carne
$pdf->SetFont('courier', 'b', 10); 
$pdf->Cell(100,6,'REPORTE DE VENTAS DIARIO',0,1,'C');
$pdf->Ln(10); //Salto de Linea


$fecha = $_POST['date'];

$query = "SELECT venta.id_venta, venta.dni,
venta.fecha, producto.nombre, detalle_venta.cantidad,
venta.total, detalle_venta.precio_unitario
FROM venta
inner join detalle_venta
on venta.id_venta=detalle_venta.id_venta
inner join producto
on detalle_venta.id_prod=producto.id_prod
WHERE venta.fecha LIKE '$fecha%'";
 
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('courier', 'b', 10); 

$html = '<table id="tabla" border="1" cellspacing="0" cellpadding="3">
                    <thead>
                    <tr>
                    <th class="static">ID Venta</th>
                    <th style="cursor: pointer;" >DNI</th>
                    <th style="cursor: pointer;" >Fecha</th>
                    <th style="cursor: pointer;" >Nombre</th>
                    <th style="cursor: pointer;" >Cantidad</th>
                    <th style="cursor: pointer;" >Total Producto</th>
                    <th class="static">Total Venta</th>
                    </tr>
                    </thead>
                    <tbody>';
                        
                    $r = mysqli_query($con,$query);
                    while($venta = mysqli_fetch_assoc($r)){
                        $html .='<tr>
                        <td>'.$venta['id_venta'].'</td>
                        <td>'.$venta['dni'].'</td>
                        <td>'.$venta['fecha'].'</td>
                        <td>'.$venta['nombre'].'</td>
                        <td>'.$venta['cantidad'].'</td>
                        <td>'.$venta['cantidad']*$venta['precio_unitario'].'</td>
                        <td>'.$venta['total'].'</td>
                    </tr>';
                    }

                    $html .='</tbody>
                    </table>';
                    $pdf->writeHTML($html, true, false, true, false, '');


//$pdf->AddPage(); //Agregar nueva Pagina

$pdf->Output('Resumen_Ventas_'.date('d_m_y').'.pdf', 'I'); 


// Output funcion que recibe 2 parameros, el nombre del archivo, ver archivo o descargar,
// La D es para Forzar una descarga