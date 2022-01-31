<?php

namespace ModernJukebox\Bundle\Common\Data;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @see https://github.com/bbc/audiowaveform/blob/master/doc/DataFormat.md#json-data-format-json
 */
class WaveformData
{
    #[Assert\NotBlank]
    private int $bits;

    #[Assert\NotBlank]
    private int $channels;

    #[Assert\NotBlank]
    private array $data;

    #[Assert\NotBlank]
    private int $length;

    #[Assert\NotBlank]
    #[SerializedName('sample_rate')]
    private int $sampleRate;

    #[Assert\NotBlank]
    #[SerializedName('samples_per_pixel')]
    private int $samplesPerPixel;

    #[Assert\NotBlank]
    private int $version;

    public function __construct(
        int $version,
        int $channels,
        int $sampleRate,
        int $samplesPerPixel,
        int $bits,
        int $length,
        array $data,
    ) {
        $this->bits = $bits;
        $this->channels = $channels;
        $this->data = $data;
        $this->length = $length;
        $this->sampleRate = $sampleRate;
        $this->samplesPerPixel = $samplesPerPixel;
        $this->version = $version;
    }

    public function getChannels(): int
    {
        return $this->channels;
    }

    public function getBits(): int
    {
        return $this->bits;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function getSampleRate(): int
    {
        return $this->sampleRate;
    }

    public function getSamplesPerPixel(): int
    {
        return $this->samplesPerPixel;
    }

    public function getVersion(): int
    {
        return $this->version;
    }
}
