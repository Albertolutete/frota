<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manutencoe;
use App\User;
use App\Empresa;
use App\Previlegio;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\Auth;

class RelatorioManutencaoController extends Controller
{

  public function imprimirManuPrevent($manutencao)
  {
    // if (!Previlegio::temPrevilegio("imprimir_relatorio", Auth::user()->id)) :
    //   return view("semPermissao");
    // endif;
    
    // $equipamento_id =  base64_decode($equipamento_id);
    // $manutencao = Manutencoe::find($equipamento_id);
    $tecnico = User::find($manutencao->tecnico_id);
    $empresaPresServico = Empresa::find($tecnico->empresa_id);
   

    $fpdf = new Fpdf("P", "mm", "A4");
    $fpdf->setXY(40, 30);
    $fpdf->setFont("arial");
    $fpdf->AddPage();
    $fpdf->SetTextColor(0, 0, 0);
    $fpdf->setFillColor(26, 87, 167);

    $extensao = $this->getExtensao($empresaPresServico->logo);
    if (!empty($extensao)) {
      $fpdf->Image("storage/app/public/" . $empresaPresServico->logo, 20, 12, 40, 15, $extensao);
    }
    //$fpdf->Image("havan.png", 150, 12, 40, 15, "png");



    $fpdf->setY(40);
    if ($manutencao->tipo == "p") :


      foreach ($manutencao->preventivas as $preventiva) :

        $fpdf->setY($fpdf->getY() + 5);
        $fpdf->Cell(180, 6, tratarCaracter($preventiva->titulo), 1, 1, "L");
        $fpdf->Cell(180, 6, tratarCaracter($preventiva->subtitulo), 1, 1, "L");
        $fpdf->Cell(180, 6, tratarCaracter("Status : " . $preventiva->status), 1, 1, "L");
        $fpdf->Cell(180, 6, tratarCaracter("Observações: " . $preventiva->observacoes), 1, 1, "L");
        $fpdf->Cell(180, 6, tratarCaracter("Data: " . $preventiva->created_at), 1, 1, "L");
        
         $partes = array();
         if (!empty(trim($preventiva->foto))) :
          
           $partes =  explode(".", $preventiva->foto);
          
          
           endif;
            if (count($partes) > 0) :

              
           $fpdf->Image("storage/app/public/ficheiros/" . $preventiva->foto, 10, $fpdf->getY() + 4, 50, 50, $partes[count($partes) - 1]);
           
           
          endif;

            
      endforeach;
    
      
    else :

      foreach ($manutencao->corretivas as $preventiva) :
        $fpdf->setY($fpdf->getY() + 5);
        $fpdf->Cell(180, 6, tratarCaracter($preventiva->titulo), 1, 1, "L");
        $fpdf->Cell(180, 6, tratarCaracter($preventiva->subtitulo), 1, 1, "L");
        $fpdf->Cell(180, 6, tratarCaracter("Status : " . $preventiva->status), 1, 1, "L");
        $fpdf->Cell(180, 6, tratarCaracter("Observações:" . $preventiva->observacoes), 1, 1, "L");

         $partes = array();
         if (!empty(trim($preventiva->foto))) :
           $partes =  explode(".", $preventiva->foto);
         endif;
        // if (count($partes) > 0) :
        //   $fpdf->Image("storage/app/public/ficheiros/" . $preventiva->foto, 10, $fpdf->getY() + 30, 50, 50, $partes[count($partes) - 1]);
        // endif;

      endforeach;
    endif;

    $extensao = $this->getExtensao($manutencao->assinaturaTecnico);

    $fpdf->ln(60);
    $fpdf->Cell(90, 6, tratarCaracter("Assinatura do Tecnico"), 0, 0, "C");
    $fpdf->Cell(90, 6, tratarCaracter("Assinatura do Cliente"), 0, 1, "C");
    if (!empty($extensao)) {
      $fpdf->Image("sign/" . $manutencao->assinaturaTecnico, 10, $fpdf->getY() + 10, 80, 50, $extensao);
    }

    $extensao = $this->getExtensao($manutencao->assinaturaCliente);
    if (!empty($extensao)) {
      $fpdf->Image("sign/" . $manutencao->assinaturaCliente, 110, $fpdf->getY() + 10, 80, 50, $extensao);
    }


    $fpdf->Output();
    exit;
  }

  public function imprimirManuCorretiva($manutencao)
  {
    $tecnico = User::find($manutencao->tecnico_id);
    $empresaPresServico = Empresa::find($tecnico->empresa_id);

    $fpdf = new Fpdf("P", "mm", "A4");
    $fpdf->setXY(40, 30);
    $fpdf->setFont("arial");
    $fpdf->AddPage();
    $fpdf->SetTextColor(0, 0, 0);
    $fpdf->setFillColor(26, 87, 167);

    $extensao = $this->getExtensao($empresaPresServico->logo);
    if (!empty($extensao)) {
      $fpdf->Image("storage/app/public/" . $empresaPresServico->logo, 20, 12, 40, 15, $extensao);
    }
   // $fpdf->Image("havan.png", 150, 12, 40, 15, "png");



    $fpdf->setY(40);
    foreach ($manutencao->corretivas as $corretiva) :

      $fpdf->setY($fpdf->getY() + 5);
      $fpdf->Cell(180, 6, tratarCaracter("Material aplicado: " . $corretiva->material_aplicado), 1, 1, "L");
      $fpdf->Cell(180, 6, tratarCaracter("Observações: " . $corretiva->observacoes), 1, 1, "L");

      // $partes = array();
      // if (!empty(trim($corretiva->foto))) :
      //   $partes =  explode(".", $corretiva->foto);
      // endif;
      // if (count($partes) > 0) :
      //   $fpdf->Image("storage/app/public/ficheiros/" . $corretiva->foto, 10, $fpdf->getY() + 30, 180, 70, $partes[count($partes) - 1]);
      // endif;

    endforeach;


  $fpdf->Cell(180, 6, tratarCaracter("Data  " . $corretiva->created_at), 1, 1, "L");
  
    $extensao = $this->getExtensao($manutencao->assinaturaTecnico);

    $fpdf->ln(5);
    $fpdf->Cell(90, 6, tratarCaracter("Assinatura do Tecnico"), 0, 0, "C");
    $fpdf->Cell(90, 6, tratarCaracter("Assinatura do Cliente"), 0, 1, "C");
    if (!empty($extensao)) {
      $fpdf->Image("sign/" . $manutencao->assinaturaTecnico, 10, $fpdf->getY() + 10, 80, 50, $extensao);
    }

    $extensao = $this->getExtensao($manutencao->assinaturaCliente);
    if (!empty($extensao)) {
      $fpdf->Image("sign/" . $manutencao->assinaturaCliente, 110, $fpdf->getY() + 10, 80, 50, $extensao);
    }


    $fpdf->Output();
    exit;
  }


  function tratarCaracter($string)
  {
    $retorno = utf8_decode($string);
    return $retorno;
  }

  public function getExtensao($file)
  {
    if (empty($file)) {
      return "";
    }
    $logo_partes = explode(".", $file);
    return $logo_partes[count($logo_partes) - 1];
  }
  function imprimir($equipamento_id)
  {
    function tratarCaracter($string)
    {
      return utf8_decode($string);
    }
    // include_once "fpdf/fpdf/fpdf.php";

    $equipamento_id =  base64_decode($equipamento_id);
    $manutencao = Manutencoe::find($equipamento_id);

    if ($manutencao->tipo == "p") {
      $this->imprimirManuPrevent($manutencao);
    } else {
      $this->imprimirManuCorretiva($manutencao);
    }
  }
}
