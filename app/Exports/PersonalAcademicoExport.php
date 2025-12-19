<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Style\Border;

class PersonalAcademicoExport implements FromView, WithStyles
{
    use Exportable;

    protected $evaluacion;
    protected $criterios;

    public function __construct($evaluacion, $criterios)
    {
        $this->evaluacion = $evaluacion;
        $this->criterios = $criterios;
    }

    public function view(): View
    {
        return view('acreditacion_caces.personal_academico.excel', [
            'evaluacion' => $this->evaluacion,
            'criterios' => $this->criterios
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        // Obtener el rango de celdas de la columna A
        $columnARange = 'A:A';

        // Aplicar estilo de alineación para ajustar automáticamente el texto en la columna A
        $sheet->getStyle($columnARange)->getAlignment()->setWrapText(true);

        $sheet->getColumnDimension('A')->setWidth(75); // Columna A, ancho de 15
        $sheet->getColumnDimension('B')->setWidth(50);
        $sheet->getColumnDimension('C')->setWidth(50);
        $sheet->getColumnDimension('D')->setWidth(50);
        $sheet->getColumnDimension('E')->setWidth(50);
        $sheet->getColumnDimension('F')->setWidth(50);
        $sheet->getColumnDimension('G')->setWidth(50);
        $sheet->getColumnDimension('H')->setWidth(50);
        $sheet->getColumnDimension('I')->setWidth(50);

        // Obtener el rango de celdas que contienen datos
        $cellRange = $sheet->calculateWorksheetDimension();

        // Estilo de borde para los bordes externos (todas las celdas)
        $outerBorder = [
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'], // Color de borde (negro)
                ],
            ],
        ];

        // Aplicar el estilo de borde externo a todas las celdas dentro del rango de celdas con datos
        $sheet->getStyle($cellRange)->applyFromArray($outerBorder);

        // Estilo de borde para los bordes internos (solo las celdas dentro del rango de datos)
        $innerBorder = [
            'borders' => [
                'inside' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'], // Color de borde (negro)
                ],
            ],
        ];

        // Aplicar el estilo de borde interno a las celdas dentro del rango de celdas con datos
        $sheet->getStyle($cellRange)->applyFromArray($innerBorder);
    }
}
