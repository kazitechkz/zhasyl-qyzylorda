<?php

namespace App\Http\Livewire\Agronom;

use App\Exports\MarkerExport;
use Livewire\Component;

class ExportMarker extends Component
{
    public $batchId;
    public $exporting = false;
    public $exportFinished = false;
    public $forExp;
    public $errMessage = false;

    public function mount($forExp)
    {
        $this->forExp = $forExp;
    }

    public function export()
    {
        $this->exporting = true;
        $this->exportFinished = false;
        return (new MarkerExport($this->forExp))->download('markers.xlsx');
    }
    public function render()
    {
        return view('livewire.agronom.export-marker');
    }
}
