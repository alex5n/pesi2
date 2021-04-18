<?php

namespace App\Http\Controllers;

/*mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');*/
//header("Content-Type: text/html;charset=utf-8");

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Empresa;
use App\Proceso;
use App\Subproceso;
use App\Organizacion;
use App\DetalleProceso;
use App\Responsabilidad;
use PDF;
use PhpOficce\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Style\Cell as Cell;
use PhpOffice\PhpWord\Style\Language;

class imprimirController extends Controller
{
    public function pdf($id){
        $empresa=Empresa::findOrFail($id);
        $proceso=Proceso::where('ruc','=',$id)->distinct()->where('estado','=','1')->get();
        $subproceso=Subproceso::where('ruc','=',$id)->orderBy('idproceso')->get();
        $area=Organizacion::where('ruc','=',$id)->orderBy('idarea')->get();
        $detalle[] = new DetalleProceso();
        $j=0;
        foreach ($subproceso as $item) {
            $temp=DetalleProceso::where('idsubproceso','=',$item->idsubproceso)->orderBy('idarea')->get();
            foreach ($temp as $item2) {
                $detalle[$j]=$item2;
                $j++;
            }
        }
        $array=array();
        foreach ($proceso as $item) {
            $i=0;
            foreach ($subproceso as $item2) {
                if ($item2->idproceso==$item->idproceso) {
                    $i=$i+1;
                }
            }
            if ($i==0) {
                $i=1;
            }
            $array[]=$i;
        }
        $cantidad = DB::table('organizacion')->where('ruc','=',$id)->count();
        $pdf = PDF::loadView('descargas.imprimirpdf', compact('empresa','proceso','subproceso','area','detalle','cantidad','array'));
        return $pdf->setPaper('A4','landscape')->download('Matriz.pdf');
    }
    
    public function word($id)
    {
        $empresa=Empresa::findOrFail($id);
        $proceso=Proceso::where('ruc','=',$id)->distinct()->where('estado','=','1')->get();
        $subproceso=Subproceso::where('ruc','=',$id)->orderBy('idproceso')->get();
        $area=Organizacion::where('ruc','=',$id)->orderBy('idarea')->get();
        $detalle[] = new DetalleProceso();
        $j=0;
        foreach ($subproceso as $item) {
            $temp=DetalleProceso::where('idsubproceso','=',$item->idsubproceso)->orderBy('idarea')->get();
            foreach ($temp as $item2) {
                $detalle[$j]=$item2;
                $j++;
            }
        }
        $array=array();
        foreach ($proceso as $item) {
            $i=0;
            foreach ($subproceso as $item2) {
                if ($item2->idproceso==$item->idproceso) {
                    $i=$i+1;
                }
            }
            $array[]=$i;
        }
        $cantidad = DB::table('organizacion')->where('ruc','=',$id)->count();

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        
        //$section = $phpWord->addSection();
        $section = $phpWord->addSection(
            [
                'orientation' => 'landscape',
                //'Zoom' => 110,
            ]
        );

        $fontStyle = new \PhpOffice\PhpWord\Style\Font();
        $fontStyle->setBold(true);
        $fontStyle->setName('Arial');
        $fontStyle->setSize(18);
        
        $ParagraphStyle = new \PhpOffice\PhpWord\Style\Paragraph();
        $ParagraphStyle->setAlign('center');

        $myTextElement = $section->addText(strtoupper($empresa->nombre));
        $myTextElement->setFontStyle($fontStyle);
        $myTextElement->setParagraphStyle($ParagraphStyle);

        $tableStyle = [
            //'width' => 100,
            'borderSize' => 5,
            'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,
            //'cellMargin'=>50,
        ];

        $phpWord->addTableStyle('myTable', $tableStyle);
        $table = $section->addTable('myTable');
        
        $row = $table->addRow(500);
        $row->addCell(null,['gridSpan' => 2, 'vMerge' => 'restart', 'valign' => 'center', 'bgColor' => '#DEB887']);
        $row->addCell(null,['gridSpan' => $cantidad, 'valign' => 'center', 'bgColor' => '#6495ED'])->addText('ORGANIZACIÓN', ['bold' => true,  'size' => 12], ['align' => 'center','spaceAfter' => 0]);

        $row = $table->addRow(500);
        $row->addCell(null,['gridSpan' => 2, 'vMerge' => 'continue', 'valign' => 'center']);
        foreach ($area as $item) {
            $row->addCell(200, ['valign' => 'center', 'bgColor'=>'#77E7E7'])->addText(strtoupper(utf8_decode($item->descripcion)), ['bold' => true, 'size' => 11], ['align' => 'center', 'spaceAfter' => 0]);
        }

        


        $row = $table->addRow();
        $row->addCell(500, ['bgColor' => '#61B668', 'valign' => 'center'])->addText('PROCESOS', ['bold' => true, 'size' => 11], ['align' => 'center', 'spaceAfter' => 0]);
        $row->addCell(null, ['bgColor' => '#61B668', 'valign' => 'center'])->addText('SUBPROCESOS', ['bold' => true, 'size' => 11], ['align' => 'center', 'spaceAfter' => 0]);
        for ($i=0; $i < $cantidad; $i++) { 
            $row->addCell(null, ['bgColor' => '#61B668']);
        }
        $i=0;
        $j=0;
        $k=0;
        $l=0;
        foreach ($proceso as $item) {
            $j=0;
            for ($a=0; $a < $array[$i]; $a++) { 
                $row = $table->addRow();
                if ($j == 0) {
                    $row->addCell(null, ['vMerge' => 'restart', 'bgColor' => '#D2691E', 'valign' => 'center'])->addText($item->descripcion, ['size' => 11], ['align' => 'center', 'spaceAfter' => 0]);
                    $j=1;
                }
                else {
                    $row->addCell(null, ['vMerge' => 'continue']);
                }
                $row->addCell(null, ['bgColor' => '#DAA520', 'valign' => 'center'])->addText($subproceso[$l]->descripcion, ['size' => 11], ['spaceAfter' => 0]);
                for ($b=0; $b < $cantidad; $b++) { 
                    if ($detalle[$k]->idresponsabilidad == 1) {
                        $row->addCell(null, ['valign' => 'center'])->addText('X', ['bold' => true, 'size' => 11], ['align' => 'center', 'spaceAfter' => 0]);
                    } else if ($detalle[$k]->idresponsabilidad == 2) {
                        $row->addCell(null, ['valign' => 'center'])->addText('X', ['size' => 11], ['align' => 'center', 'spaceAfter' => 0]);
                    } else if ($detalle[$k]->idresponsabilidad == 3) {
                        $row->addCell(null, ['valign' => 'center'])->addText('/', ['size' => 11], ['align' => 'center', 'spaceAfter' => 0]);
                    } else {
                        $row->addCell();
                    }
                    $k++;
                }
                $l++;
            }
            if ($j == 0) {
                $row->addCell(null, ['vMerge' => 'restart', 'valign' => 'center'])->addText($item->descripcion, ['size' => 11], ['spaceAfter' => 0]);
                $row->addCell();
                for ($a=0; $a < $cantidad; $a++) { 
                    $row->addCell();
                }
            }
            $i++;
        }

        //$phpWord->getCompatibility()->setOoxmlVersion(15);
        $phpWord->getSettings()->setThemeFontLang(new Language("ES-MX"));
        $phpWord->getSettings()->setZoom(110);
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('Matriz.docx');

        return response()->download('Matriz.docx');
    }

    /*public function ver($id)
    {
        $empresa=Empresa::findOrFail($id);
        $proceso=Proceso::where('ruc','=',$id)->distinct()->where('estado','=','1')->get();
        $subproceso=Subproceso::where('ruc','=',$id)->get();
        $area=Organizacion::where('ruc','=',$id)->orderBy('idarea')->get();
        $detalle[] = new DetalleProceso();
        $j=0;
        foreach ($subproceso as $item) {
            $temp=DetalleProceso::where('idsubproceso','=',$item->idsubproceso)->orderBy('idarea')->get();
            foreach ($temp as $item2) {
                $detalle[$j]=$item2;
                $j++;
            }
        }
        $array=array();
        foreach ($proceso as $item) {
            $i=0;
            foreach ($subproceso as $item2) {
                if ($item2->idproceso==$item->idproceso) {
                    $i=$i+1;
                }
            }
            if ($i==0) {
                $i=1;
            }
            $array[]=$i;
        }
        $cantidad = DB::table('organizacion')->where('ruc','=',$id)->count();
        return view('descargas.imprimirpdf',compact('empresa','proceso','subproceso','area','detalle','cantidad','array'));
    }*/
}
