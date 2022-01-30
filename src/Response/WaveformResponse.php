<?php

namespace ModernJukebox\Bundle\Common\Response;

use ModernJukebox\Bundle\Common\Data\WaveformData;
use Symfony\Component\Validator\Constraints as Assert;

class WaveformResponse
{
    #[Assert\Valid()]
    private WaveformData $waveform;

    public function __construct(WaveformData $waveform)
    {
        $this->waveform = $waveform;
    }

    public function getWaveform(): WaveformData
    {
        return $this->waveform;
    }
}
