<?php

namespace App\Http\Livewire\Pages\Participant;

use App\Models\Participant;
use Livewire\Component;

class RegisterStep2 extends Component
{
    public $participant;
    public $genders = [
        [
            'attr'  => '-- Pilih Jenis Kelamin --',
            'value' => '',
        ],
        [
            'attr'  => 'Laki-laki',
            'value' => 'Male',
        ],
        [
            'attr'  => 'Perempuan',
            'value' => 'Female',
        ]
    ];
    public $stepWizards = [
        [
            'label'     => 'Mulai',
            'attr'      => 'Memilih Skema',
            'desc'      => 'Memilih salah satu skema sertifikasi yang akan diujikan',
        ],
        [
            'label'     => '2',
            'attr'      => 'Rincian Data Pemohon',
            'desc'      => 'Mengisi rincian data pemohon',
        ],
        [
            'label'     => '3',
            'attr'      => 'Isi Persyaratan Dasar',
            'desc'      => 'Mengisi persyaratan dasar',
        ],
        [
            'label'     => '4',
            'attr'      => 'Informasi Pembayaran',
            'desc'      => 'Mengunggah bukti pembayaran sertifikasi',
        ],
        [
            'label'     => '5',
            'attr'      => 'Asesmen Mandiri',
            'desc'      => 'Mengisi asesmen mandiri',
        ],
    ];
    public $currentStep = 2;

    protected $rules = [
        'participant.name'          => 'required',
        'participant.identity_number' => 'required|numeric',
        'participant.email'         => 'required|email',
        'participant.birth_place'   => 'required',
        'participant.birth_date'    => 'required',
        'participant.gender'        => 'required|in:Male,Female',
        'participant.nationality'   => 'required',
        'participant.address'       => 'required',
        'participant.city'          => 'required',
        'participant.zip_code'      => 'required',
        'participant.cell_phone_number'     => 'required',
        'participant.home_phone_number'     => 'nullable',
        'participant.office_phone_number'   => 'nullable',
        'participant.company_name'          => 'required',
        'participant.position_at_work'      => 'required',
        'participant.company_address'       => 'required',
        'participant.company_city'          => 'required',
        'participant.company_zip_code'      => 'required',
        'participant.company_phone_number'  => 'required',
        'participant.company_fax_number'    => 'nullable',
        'participant.company_cell_phone_number'  => 'nullable',
    ];

    protected $validationAttributes = [
        'participant.name'              => 'Nama Lengkap',
        'participant.identity_number'   => 'Nomor KTP / NIK / Paspor',
        'participant.birth_place'       => 'Tempat Lahir',
        'participant.birth_date'        => 'Tanggal Lahir',
        'participant.gender'            => 'Jenis Kelamin',
        'participant.nationality'       => 'Kebangsaan',
        'participant.address'           => 'Alamat Lengkap',
        'participant.city'              => 'Kota',
        'participant.zip_code'          => 'Kode Pos',
        'participant.home_phone_number' => 'No Telp. Rumah',
        'participant.office_phone_number'   => 'No Telp. Kantor',
        'participant.cell_phone_number'     => 'No Handphone',
        'participant.company_name'          => 'Nama Institusi / Perusahaan',
        'participant.position_at_work'      => 'Jabatan',
        'participant.company_address'       => 'Alamat kantor',
        'participant.company_city'          => 'Kota',
        'participant.company_zip_code'      => 'Kode pos',
        'participant.company_phone_number'  => 'No Telp. Perusahaan',
        'participant.company_fax_number'    => 'No Fax. Perusahaan',
        'participant.company_cell_phone_number' => 'No HP Perusahaan',
    ];

    public function mount()
    {
        $this->participant = Participant::where('user_id', auth()->user()->id)->first();

        if (!empty($this->participant->second_apl_verified_at)) {
            return redirect()->route('participant.registration.verified');
        }
    }

    public function back($step = null)
    {
        if (!empty($step)) {
            return redirect()->route('participant.register.' . $step);
        } else {
            return redirect()->route('participant.register.' . $this->currentStep - 1);
        }
    }

    public function save()
    {
        $this->validate();

        $this->participant->step = 3;
        $this->participant->save();

        return redirect()->route('participant.register.3');
    }

    public function render()
    {
        return view('livewire.pages.participant.register-step2');
    }
}
