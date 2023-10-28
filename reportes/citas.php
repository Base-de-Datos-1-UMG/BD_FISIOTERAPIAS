<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    ob_start();

    include_once("./fpdf186/fpdf.php");
    include_once("./../includes/session.php");

    $url = "https://www.datos.gov.co/resource/gt2j-8ykr.json";
    $res = json_decode(file_get_contents($url));

    //Consultamos la tabla que queremos mostrar en la vista
    $sql = "SELECT 
                A.ID_CITA,F.NOMBRE1 || ' ' || F.NOMBRE2 || ' ' || F.APELLIDO1 || ' ' ||F.APELLIDO2 AS NOMBRE,
                B.HORA_INICIO,
                B.HORA_FIN,
                C.NOMBRE_SERVICIO,
                D.TIPO_ESTADO 
            FROM BD1_CITA A 
            INNER JOIN BD1_HORARIO B ON A.ID_HORARIO = B.ID_HORARIO
            INNER JOIN BD1_SERVICIO C ON A.ID_SERVICIO = C.ID_SERVICIO
            INNER JOIN BD1_ESTADO D ON A.ID_ESTADO = D.ID_ESTADO
            INNER JOIN BD1_CLIENTE E ON A.ID_CLIENTE = E.ID_CLIENTE
            INNER JOIN BD1_PERSONA F ON E.ID_PERSONA = F.ID_PERSONA
            ORDER BY A.ID_CITA ASC";

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
            $this->Cell(0,30,"  Reporte de Citas", 0, 1, 'L', true);
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
            $this->Cell(0,10,"Citas Agendadas", 0, 1, 'L', true);
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
            $this->Cell(80, 10, "Nombre", 0, 0, "C", 1);
            $this->Cell(20, 10, "Hora Inicio", 0, 0, "C", 1);
            $this->Cell(20, 10, "Hora Fin", 0, 0, "C", 1);
            $this->Cell(45, 10, "Servicio", 0, 0, "C", 1);
            $this->Cell(25, 10, "Estado", 0, 0, "C", 1);
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
                
                $this->Cell(80,6, $row['NOMBRE'],0,0,'C',$fill);
                $this->Cell(20,6, $row['HORA_INICIO'],0,0,'C',$fill);
                $this->Cell(20,6, $row['HORA_FIN'],0,0,'C',$fill);
                $this->Cell(45,6, $row['NOMBRE_SERVICIO'],0,0,'C',$fill);
                $this->Cell(25,6, $row['TIPO_ESTADO'],0,0,'C',$fill);
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
    $pdf->Output('Reporte citas.pdf', 'D');

    ob_end_flush();

?>