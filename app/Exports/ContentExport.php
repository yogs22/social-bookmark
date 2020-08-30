<?php
namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ContentExport implements FromView, WithEvents, ShouldAutoSize
{
    protected $request;
    protected $contents;

    public function __construct($contents, $request)
    {
        $this->request = $request;
        $this->contents = $contents;
    }

    public function view(): View
    {
        return view('exports.content', [
            'request' => $this->request,
            'contents' => $this->contents,
        ]);
    }

    public function registerEvents(): array
    {
        $count = (int)$this->contents->count() + 4;
        $rangeHeader = 'A4:E4';
        $range = 'A5:E'. ($count-1);
        $rangeFooter = 'A'.$count.':E'.$count;
        $rangeValue = 'E5:E' . $count;

        return [
            AfterSheet::class => function(AfterSheet $event) use ($rangeValue) {
                $styleArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ]
                ];
            },
        ];
    }
}
