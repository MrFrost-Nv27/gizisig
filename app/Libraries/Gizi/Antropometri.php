<?php

namespace App\Libraries\Gizi;

use App\Libraries\Gizi\Enums\BeratBadan;
use App\Libraries\Gizi\Enums\Gender;
use App\Libraries\Gizi\Enums\StatusGizi;
use App\Libraries\Gizi\Enums\StatusMassa;
use App\Libraries\Gizi\Enums\Stunt;
use App\Libraries\Gizi\Table\IndexBB;
use App\Libraries\Gizi\Table\IndexBBTB;
use App\Libraries\Gizi\Table\IndexIMT;
use App\Libraries\Gizi\Table\IndexTB;

class Antropometri
{
    public BeratBadan $indexBB;
    public Stunt $indexTB;
    public StatusGizi $indexBBTB;
    public StatusGizi|StatusMassa $indexIMT;
    public function __construct(
        public float|array|null $bb = null,
        public ?float $tb = null,
        public ?float $massa = null,
        public ?int $usia = null,
        public ?Gender $gender = null
    ) {
        if (is_array($bb)) {
            $this->fill($bb);
        }
    }

    public function calculateIndexBB()
    {
        if (!$this->checkAttr('bb', 'usia', 'gender')) {
            throw new \Exception('Berat Badan, usia dan gender harus diisi');
        }
        if ($this->usia > 60) {
            throw new \Exception('Perhitungan Index BB/U hanya untuk Usia Balita');
        }
        $sd = IndexBB::get($this->gender, $this->usia);
        switch ($this->bb <=> $sd[3]) {
            case -1:
                $this->bb > $sd[1] ? $this->indexBB = BeratBadan::Normal : ($this->bb < $sd[0] ? $this->indexBB = BeratBadan::SeverelyUnderweight : $this->indexBB = BeratBadan::Underweight);
                break;
            case 0:
                $this->indexBB = BeratBadan::Normal;
                break;
            case 1:
                $this->bb > $sd[4] ? $this->indexBB = BeratBadan::RiskOverweight : $this->indexBB = BeratBadan::Normal;
                break;
        }
        return $this;
    }

    public function calculateIndexTB(): self
    {
        if (!$this->checkAttr('tb', 'usia', 'gender')) {
            throw new \Exception('Tinggi Badan, usia dan gender harus diisi');
        }
        if ($this->usia > 60) {
            throw new \Exception('Perhitungan Index TB/U hanya untuk Usia Balita');
        }
        $sd = IndexTB::get($this->gender, $this->usia);
        switch ($this->tb <=> $sd[3]) {
            case -1:
                $this->tb > $sd[1] ? $this->indexTB = Stunt::Normal : ($this->tb < $sd[0] ? $this->indexTB = Stunt::SeverelyStunted : $this->indexTB = Stunt::Stunted);
                break;
            case 0:
                $this->indexTB = Stunt::Normal;
                break;
            case 1:
                $this->tb > $sd[6] ? $this->indexTB = Stunt::High : $this->indexTB = Stunt::Normal;
                break;
        }
        return $this;
    }

    public function calculateIndexBBTB(): self
    {
        if (!$this->checkAttr('bb', 'tb', 'usia', 'gender')) {
            throw new \Exception('Berat Badan, Tinggi Badan, usia dan gender harus diisi');
        }
        if ($this->usia > 60) {
            throw new \Exception('Perhitungan Index BB/TB hanya untuk Usia Balita');
        }
        $sd = IndexBBTB::get($this->gender, $this->usia, $this->tb);
        switch ($this->bb <=> $sd[3]) {
            case -1:
                $this->bb > $sd[1] ? $this->indexBBTB = StatusGizi::Normal : ($this->bb < $sd[0] ? $this->indexBBTB = StatusGizi::SeverelyWasted : $this->indexBBTB = StatusGizi::Wasted);
                break;
            case 0:
                $this->indexBBTB = StatusGizi::Normal;
                break;
            case 1:
                $this->bb <= $sd[4] ? $this->indexBBTB = StatusGizi::Normal : ($this->bb > $sd[6] ? $this->indexBBTB = StatusGizi::Obese : ($this->bb > $sd[5] ? $this->indexBBTB = StatusGizi::Overweight : $this->indexBBTB = StatusGizi::RiskOverweight));
                break;
        }
        return $this;
    }

    public function calculateIndexIMT(): self
    {
        if (!$this->checkAttr('massa', 'usia', 'gender')) {
            throw new \Exception('Massa Tubuh, usia dan gender harus diisi');
        }
        if ($this->usia > 216) {
            throw new \Exception('Perhitungan Index BB/TB hanya untuk Usia maksimal 18 Tahun');
        }
        $sd = IndexIMT::get($this->gender, $this->usia);
        $isBalita = $this->usia <= 60;
        $status = $isBalita ? StatusGizi::Normal : StatusMassa::Normal;
        switch ($this->massa <=> $sd[3]) {
            case -1:
                $this->massa > $sd[1] ? $this->indexIMT = $status::Normal : ($this->massa < $sd[0] ? $this->indexIMT = $status::tryFrom(1) : $this->indexIMT = $status::tryFrom(2));
                break;
            case 0:
                $this->indexIMT = $status::Normal;
                break;
            case 1:
                $this->massa <= $sd[4] ? $this->indexIMT = $status::Normal : ($this->massa > $sd[6] ? $this->indexIMT = $status::tryFrom(6) : ($this->massa > $sd[5] ? $this->indexIMT = ($isBalita ? $status::Overweight : $status::Obese) : $this->indexIMT = $status::tryFrom(4)));
                break;
        }
        return $this;
    }

    public function checkAttr(...$attr): bool
    {
        foreach ($attr as $v) {
            if (!isset($this->{$v})) {
                return false;
            }
        }
        return true;
    }

    public function fill(...$prop)
    {
        if (array_is_list($prop)) {
            foreach ($prop[0] as $k => $v) {
                if (property_exists($this, $k)) {
                    $this->{$k} = $v;
                }
            }
        } else {
            foreach ($prop as $k => $v) {
                if (property_exists($this, $k)) {
                    $this->{$k} = $v;
                }
            }
        }
    }
}
