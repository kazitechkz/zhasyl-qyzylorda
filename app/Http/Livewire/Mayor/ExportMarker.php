<?php

namespace App\Http\Livewire\Mayor;

use App\Exports\MarkerExport;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
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

//        $batch = Bus::batch([
//            new \App\Jobs\ExportMarker($this->forExp)
//        ])->dispatch();

//        $this->batchId = $batch->id;

        return (new MarkerExport($this->forExp))->download('markers.xlsx');
    }

//    public function getExportBatchProperty()
//    {
//        if (!$this->batchId) {
//            return null;
//        }
//
//        return Bus::findBatch($this->batchId);
//    }

//    public function downloadExport(): \Symfony\Component\HttpFoundation\StreamedResponse
//    {
//        return Storage::download('markers.xlsx');
//    }

//    public function updateExportProgress()
//    {
//        $this->exportFinished = $this->exportBatch->finished();
//
//        if ($this->exportFinished) {
//            $this->exporting = false;
//        }
//    }
    public function render()
    {
        return view('livewire.mayor.export-marker');
    }
}
