<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
   header("Location: ../index.php");
   exit();
}

// Include the main TCPDF library (search for installation path).
require_once('../TCPDF-main/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator('JNTUGV');
$pdf->setAuthor('JNTUGV');
$pdf->setTitle('Remuneration Bill');
$pdf->setSubject('Remuneration Bill');
$pdf->setKeywords('Remuneration Bill');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set font
$pdf->setFont('times', 'B', 12.74);

// add a page
$pdf->AddPage();

// set logo.
$img_file = './images/logo.png';
$pdf->Image($img_file, 38, 10, 22, 22, '', '', '', false, 300, '', false, false, 0);


// college name
$pdf->SetTextColor(83, 4, 125);
$pdf->Cell(0, 0, 'JNTU-GV COLLEGE OF ENGINEERING', 0, 10, 'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->Ln('1.74');
$pdf->Cell(0, 0, 'Vizianagaram - 535003 ', 0, 10, 'C');
$pdf->Ln('1.74');
$pdf->setTextColor(252, 3, 3);
$pdf->Cell(0, 0, 'Remuneration Bill ', 0, 10, 'C');
$pdf->Ln('1.74');
$pdf->Line(10, 35, 200, 35);
$pdf->SetTextColor(0, 0, 0);
$pdf->Ln('8.74');
// set some text to print 

$html = <<<EOD
    
    <!-----------------------Style sheet llinks -------------------------->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!---------------------------icons------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        td{
            border:0.7px solid black;
            text-size:6px;
            font-weight:300;
        }
        .headtext{
            text-align:center;
            background-color:yellow;
            padding:2px;
        }
        
    </style>
    <p>Proceedings No /Purpose : --------------------------------------------------------------------------------------- </p>
    <p>Name of the Examination : -------------------------------------------------------------------------------------- </p>
    <p>Name of the Subject : --------------------------------------- Subject Code : ---------------------------------- </p>
    <p>Name of the Staff : ------------------------------------------ Phone No  : --------------------------------------- </p>
    <p>Designation & Address : ----------------------------------------------------------------------------------------- </p>
    <p>Bank A/C No: -------------------------------------------- PAN No: --------------------------------------------- </p>
    <p>IFSC Code: --------------------------------------------- Branch: ------------------------------------------------ </p>
    <p></p>
    <table>
        <center>
            <tr class="headtext">
                <td>Select</td>
                <td>Nature of Work</td>
                <td>Number</td>
                <td>Rate (Rs)</td>
                <td>Total (Rs)</td>
            </tr>
        </center>
        <tr>
           <td></td>
           <td>Scheme of Valuation</td>
           <td></td>
           <td></td>
           <td></td> 
        </tr>
        <tr>
           <td></td>
           <td>Paper Valuation</td>
           <td></td>
           <td></td>
           <td></td> 
        </tr>
        <tr>
           <td></td>
           <td>Chief Examiner</td>
           <td></td>
           <td></td>
           <td></td> 
        </tr>
        <tr>
           <td></td>
           <td>Scrutinizer</td>
           <td></td>
           <td></td>
           <td></td> 
        </tr>
        <tr>
           <td></td>
           <td>Others (Specify below)</td>
           <td></td>
           <td></td>
           <td></td> 
        </tr>
        <tr>
           <td colspan="4">Total</td>
           <td></td>
           <td></td>
           <td></td>
           <td></td> 
        </tr>
        <tr>
           <td colspan="4">T.D.S (10%) Deduction</td>
           <td></td>
           <td></td>
           <td></td>
           <td></td> 
        </tr>
        <tr>
           <td colspan="4">Grand Total</td>
           <td></td>
           <td></td>
           <td></td>
           <td></td> 
        </tr>
    </table>
    <p>Received Rupees ----------------------------------------------------------------------------------------------- Only</p>
    <p>I certify that the work assigned is completed and this bill is not claimed earlier from any source</p>
    <p>Station : </p>
    <p>Date : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Stamp & Signature</p>
    <p>The bill is passed for Rs ------------------------------------------------------------------------------------- Only.</p>
    <br>
    <p>Clerk &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; A/S &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Addl. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Controller of Examination &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; D.E. /C.E.</p>    
EOD;





// print a block of text using Write()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Remuneration Bill.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
