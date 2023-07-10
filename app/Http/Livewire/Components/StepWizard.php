<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class StepWizard extends Component
{
    public $stepWizards;
    public $currentStep;
    public $stepStyles;

    protected $listeners = ['updateCurrentStep'];

    public function mount($stepWizards, $currentStep = 0)
    {
        $this->stepWizards = $stepWizards;
        $this->currentStep = $currentStep;
    }

    public function updateCurrentStep($currentStep)
    {
        $this->currentStep = $currentStep;
    }

    public function render()
    {
        $this->stepStyles = [];

        foreach ($this->stepWizards as $step => $wizard) {
            $this->stepStyles[$step]['step_span_class'] = 'flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full lg:h-12 lg:w-12 dark:bg-gray-700 shrink-0';

            if ($step == 0) {
                $this->stepStyles[$step]['step_class']   = 'flex w-1/4 items-center text-red-600 dark:text-red-500 after:content-[""] after:w-full after:h-1 after:border-b after:border-gray-100 after:border-4 after:inline-block dark:after:border-gray-700';
                $this->stepStyles[$step]['wizard_class'] = 'flex w-1/4 items-center text-red-600 dark:text-red-500 after:content-[""] after:w-full after:h-1 after:inline-block';
            } else if ($step == count($this->stepWizards) - 1) {
                $this->stepStyles[$step]['step_class']   = 'flex w-1/4 items-center before:content-[""] before:w-full before:h-1 before:border-b before:border-gray-100 before:border-4 before:inline-block dark:before:border-gray-700';
                $this->stepStyles[$step]['wizard_class'] = 'flex w-1/4 items-center before:content-[""] before:w-full before:h-1 before:inline-block';
            } else {
                $this->stepStyles[$step]['step_class']   = 'flex w-1/2 items-center after:content-[""] after:w-full after:h-1 after:border-b after:border-gray-100 after:border-4 after:inline-block dark:after:border-gray-700 before:content-[""] before:w-full before:h-1 before:border-b before:border-gray-100 before:border-4 before:inline-block dark:before:border-gray-700';
                $this->stepStyles[$step]['wizard_class'] = 'flex w-1/2 items-center after:content-[""] after:w-full after:h-1 before:content-[""] before:w-full before:h-1 before:inline-block';
            }

            for ($prevStep = 0; $prevStep <= $this->currentStep; $prevStep++) {
                if ($prevStep === 0) {
                    $this->stepStyles[$prevStep]['step_class']   = 'flex w-1/4 items-center text-red-600 dark:text-red-500 after:content-[""] after:w-full after:h-1 after:border-b after:border-red-100 after:border-4 after:inline-block dark:after:border-red-700';
                    $this->stepStyles[$prevStep]['wizard_class'] = 'flex w-1/4 items-center text-red-600 dark:text-red-500 after:content-[""] after:w-full after:h-1 after:inline-block';
                } else if ($prevStep == count($this->stepWizards) - 1) {
                    $this->stepStyles[$prevStep]['step_class']   = 'flex w-1/4 items-center before:content-[""] before:w-full before:h-1 before:border-b before:border-red-100 before:border-4 before:inline-block dark:before:border-red-700';
                    $this->stepStyles[$prevStep]['wizard_class'] = 'flex w-1/4 items-center text-red-600 dark:text-red-500 before:content-[""] before:w-full before:h-1 before:inline-block';
                } else {
                    $this->stepStyles[$prevStep]['step_class']   = 'flex w-1/2 items-center after:content-[""] after:w-full after:h-1 after:border-b after:border-red-100 after:border-4 after:inline-block dark:after:border-red-700 before:content-[""] before:w-full before:h-1 before:border-b before:border-red-100 before:border-4 before:inline-block dark:before:border-red-700';
                    $this->stepStyles[$prevStep]['wizard_class'] = 'flex w-1/2 items-center text-red-600 dark:text-red-500 after:content-[""] after:w-full after:h-1 before:content-[""] before:w-full before:h-1 before:inline-block';
                }

                $this->stepStyles[$prevStep]['step_span_class'] = 'flex items-center justify-center w-10 h-10 bg-red-100 rounded-full lg:h-12 lg:w-12 dark:bg-red-800 text-red-600 dark:text-red-500 shrink-0';
            }
        }

        return view('components.step-wizard');
    }
}
