<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    ob_start();

    include_once("./fpdf186/fpdf.php");
    include_once("./../includes/session.php");

    $url = "https://www.datos.gov.co/resource/gt2j-8ykr.json";
    $res = json_decode(file_get_contents($url));

    //Consultamos la tabla que queremos mostrar en la vista
    $sql = "SELECT * FROM BD1_VISTA_EMPLEADOS";

    //usamos db_select para traer multiples filas
    $result = db_select($sql, $conn);

    $registros = 20;

    class PDF extends FPDF{
        function Header(){
            //header
            $this->SetY(0);
            $this->SetFont("Arial","B",30);
            $this->SetFillColor(14,22,61);
            $this->SetTextColor(255, 255, 255);
            $this->Cell(0,30,"  Reporte de Empleados", 0, 1, 'L', true);
        }

        function Footer(){
            $this->SetY(-15);
            $this->SetFont('Arial','I',8);
            $this->SetTextColor(0,0,0);
            $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
        }

        function ChapterTitle(){
            $this->SetY(31);
            $this->SetFont("Arial","B", 16);
            $this->SetFillColor(255, 255, 255);
            $this->SetTextColor(14, 22, 61);
            $this->Cell(0,10,"Informacion de accesos de empleados", 0, 1, 'L', true);
        }

        function FancyTable($result,$registros){
            // Colores, ancho de línea y fuente en negrita
            $this->SetFillColor(224,235,255);
            $this->SetTextColor(14,22,61);
            $this->SetDrawColor(238,156,0);
            $this->SetLineWidth(.3);
            $this->SetFont('','B', 10);
            $w = array(24,58,15,15,30,18,29);
            // Cabecera
            $this->Cell(20, 10, "ID", 0, 0, "C", 1);
            $this->Cell(50, 10, "Nombre", 0, 0, "L", 1);
            $this->Cell(40, 10, "Puesto", 0, 0, "L", 1);
            $this->Cell(40, 10, "Usuario", 0, 0, "L", 1);
            $this->Cell(40, 10, "Password", 0, 0, "L", 1);
            $this->Ln();
            
            // Restauración de colores y fuentes
            $this->SetFillColor(224,235,255);
            $this->SetTextColor(0);
            $this->SetFont('Arial', '', 9);
            // Datos
            $fill = false;
            $i = 0;
            $M = 0;
            $F = 0;
            $promedioEdad = 0;
            $comunitaria = 0;
            $relacionado = 0;
            $recuperados = 0;
            foreach($result as $row){
                
                $this->Cell(20,6, $row['ID_EMPLEADO'],0,0,'C',$fill);
                $this->Cell(50,6, $row['NOMBRE1'].' '.$row['NOMBRE2'].' '.$row['APELLIDO1'].' '.$row['APELLIDO2'],0,0,'L',$fill);
                $this->Cell(40,6, $row['PUESTO'],0,0,'L',$fill);
                $this->Cell(40,6, $row['USUARIO'],0,0,'L',$fill);
                $this->Cell(40,6, $row['PASSWORD'],0,0,'L',$fill);
                $this->Ln();
                $fill = !$fill;

                $i++;
                if($i == $registros){
                    break;
                }
            }
            // Línea de cierre
            $this->Cell(array_sum($w) + 1,6,'','T');

            $this->Ln();

        }

        function PrintChapter($result,$registros){
            $this->AddPage();
            $this->ChapterTitle();
            $this->FancyTable($result,$registros);
        }
    }

    //Objeto FPDF
    $pdf = new PDF();
    $pdf->PrintChapter($result,$registros);
    $pdf->Output('Reporte empleados.pdf', 'D');

    ob_end_flush();

?>