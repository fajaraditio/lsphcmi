<?php

namespace App\Http\Livewire\Modals\Test;

use App\Http\Livewire\Components\Alert;
use App\Http\Livewire\Tables\Test\TestReportTable;
use App\Models\TestReport;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class SubmitBnspCertificateModal extends ModalComponent
{
    use WithFileUploads;

    public $testReport;
    public $bnspCertificateNumber;
    public $bnspCertificateDate;
    public $bnspCertificateFile;

    protected $rules = [
        'bnspCertificateNumber' => 'required',
        'bnspCertificateDate'   => 'required|date_format:Y-m-d',
        'bnspCertificateFile'   => 'required|mimes:pdf',
    ];

    protected $validationAttributes = [
        'bnspCertificateNumber' => 'Nomor Sertifikat BNSP',
        'bnspCertificateDate'   => 'Tanggal Sertifikat BNSP',
        'bnspCertificateFile'   => 'Berkas Sertifikat BNSP',
    ];

    public function mount(TestReport $testReport)
    {
        $this->testReport = $testReport;
    }

    public function upload()
    {
        $this->validate();

        $bnspCertificateFilename  = 'bnsp_certificate_' . $this->testReport->id . '.' . $this->bnspCertificateFile->getClientOriginalExtension();
        $bnspCertificateUploaded  = $this->bnspCertificateFile->storeAs('public/bnsp', $bnspCertificateFilename);

        $bnspCertificateFile = str_replace('public/', '', $bnspCertificateUploaded);

        $this->testReport->update([
            'bnsp_certificate'          => $bnspCertificateFile,
            'bnsp_certificate_number'   => $this->bnspCertificateNumber,
            'bnsp_certificate_date'     => $this->bnspCertificateDate,
        ]);

        $this->emitTo(
            Alert::class,
            'sendAlert',
            $title = 'Sertifikat BNSP berhasil diunggah!',
            $message = 'Berhasil mengunggah sertifikat BNSP untuk asesi ' . $this->testReport->assessor_user->name,
            $type = 'success'
        );

        $this->emitTo(TestReportTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.test.submit-bnsp-certificate-modal');
    }
}
