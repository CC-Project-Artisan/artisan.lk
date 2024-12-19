<?php

namespace App\Livewire\Vendor;

use Livewire\Component;
use App\Models\Exhibition;
use Carbon\Carbon;
use App\Notifications\ExhibitionActivated;
use App\Notifications\ExhibitionDeactivated;
use PhpParser\Node\Expr\FuncCall;

class ExhitionCard extends Component
{

    public $exhibitionId;
    public $exhibition;
    public $isActive;
    public $status;

    public function render()
    {
        return view('livewire.vendor.exhition-card');
    }

    // Mount method to get the exhibition id
    public function mount($exhibitionId)
    {
        $this->exhibitionId = $exhibitionId;
        $this->exhibition = Exhibition::with('user')->find($this->exhibitionId);
        $this->isActive = $this->exhibition->isActive;
        $this->status = $this->exhibition->status;
    }

    // Method to toggle the active status
    public function toggleActiveStatus()
    {
        $this->exhibition = Exhibition::with('user')->find($this->exhibitionId);
        if ($this->exhibition) {
            // Toggle the isActive status
            $this->exhibition->isActive = !$this->exhibition->isActive;
            $this->exhibition->status_updated_at = Carbon::now();
            $this->exhibition->save();

            $this->isActive = $this->exhibition->isActive;
            $status = $this->exhibition->isActive ? 'activated' : 'deactivated';
            session()->flash('message', "Exhibition $status successfully.");

            // // Send notification to the user
            // if ($this->exhibition->user) {
            //     if ($this->exhibition->isActive) {
            //         $this->exhibition->user->notify(new ExhibitionActivated($this->exhibition));
            //     } else {
            //         $this->exhibition->user->notify(new ExhibitionDeactivated($this->exhibition));
            //     }
            // }
        }
    }

    public function deleteExhibition()
    {
        $this->exhibition = Exhibition::with('user')->find($this->exhibitionId);
        if ($this->exhibition) {
            $this->exhibition->delete();
            session()->flash('message', 'Exhibition deleted successfully.');
        }
    }

    public function editExhibition()
    {
        return redirect()->route('exhibition.edit', ['id' => $this->exhibitionId]);    
    }
    
}