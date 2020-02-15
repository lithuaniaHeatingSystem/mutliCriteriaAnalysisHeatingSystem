<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ResultRepository")
 */
class Result
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Component")
     * @ORM\JoinColumn(nullable=false)
     */
    private $heatingOne;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Component")
     * @ORM\JoinColumn(nullable=false)
     */
    private $heatingTwo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Component")
     * @ORM\JoinColumn(nullable=false)
     */
    private $valveOne;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Component")
     * @ORM\JoinColumn(nullable=false)
     */
    private $valveTwo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Component")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pipeOne;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Component")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pipeTwo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Component")
     * @ORM\JoinColumn(nullable=false)
     */
    private $thermostaticValveOne;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Component")
     * @ORM\JoinColumn(nullable=false)
     */
    private $thermostaticValveTwo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Component")
     * @ORM\JoinColumn(nullable=false)
     */
    private $circulationPumpOne;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Component")
     * @ORM\JoinColumn(nullable=false)
     */
    private $circulationPumpTwo;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Component|null
     */
    public function getHeatingOne(): ?Component
    {
        return $this->heatingOne;
    }

    /**
     * @param Component|null $heatingOne
     *
     * @return $this
     */
    public function setHeatingOne(?Component $heatingOne): self
    {
        $this->heatingOne = $heatingOne;

        return $this;
    }

    /**
     * @return Component|null
     */
    public function getHeatingTwo(): ?Component
    {
        return $this->heatingTwo;
    }

    /**
     * @param Component|null $heatingTwo
     *
     * @return $this
     */
    public function setHeatingTwo(?Component $heatingTwo): self
    {
        $this->heatingTwo = $heatingTwo;

        return $this;
    }

    /**
     * @return Component|null
     */
    public function getValveOne(): ?Component
    {
        return $this->valveOne;
    }

    /**
     * @param Component|null $valveOne
     *
     * @return $this
     */
    public function setValveOne(?Component $valveOne): self
    {
        $this->valveOne = $valveOne;

        return $this;
    }

    /**
     * @return Component|null
     */
    public function getValveTwo(): ?Component
    {
        return $this->valveTwo;
    }

    /**
     * @param Component|null $valveTwo
     *
     * @return $this
     */
    public function setValveTwo(?Component $valveTwo): self
    {
        $this->valveTwo = $valveTwo;

        return $this;
    }

    /**
     * @return Component|null
     */
    public function getPipeOne(): ?Component
    {
        return $this->pipeOne;
    }

    /**
     * @param Component|null $pipeOne
     *
     * @return $this
     */
    public function setPipeOne(?Component $pipeOne): self
    {
        $this->pipeOne = $pipeOne;

        return $this;
    }

    /**
     * @return Component|null
     */
    public function getPipeTwo(): ?Component
    {
        return $this->pipeTwo;
    }

    /**
     * @param Component|null $pipeTwo
     *
     * @return $this
     */
    public function setPipeTwo(?Component $pipeTwo): self
    {
        $this->pipeTwo = $pipeTwo;

        return $this;
    }

    /**
     * @return Component|null
     */
    public function getThermostaticValveOne(): ?Component
    {
        return $this->thermostaticValveOne;
    }

    /**
     * @param Component|null $thermostaticValveOne
     *
     * @return $this
     */
    public function setThermostaticValveOne(?Component $thermostaticValveOne): self
    {
        $this->thermostaticValveOne = $thermostaticValveOne;

        return $this;
    }

    /**
     * @return Component|null
     */
    public function getThermostaticValveTwo(): ?Component
    {
        return $this->thermostaticValveTwo;
    }

    /**
     * @param Component|null $thermostaticValveTwo
     *
     * @return $this
     */
    public function setThermostaticValveTwo(?Component $thermostaticValveTwo): self
    {
        $this->thermostaticValveTwo = $thermostaticValveTwo;

        return $this;
    }

    /**
     * @return Component|null
     */
    public function getCirculationPumpOne(): ?Component
    {
        return $this->circulationPumpOne;
    }

    /**
     * @param Component|null $circulationPumpOne
     *
     * @return $this
     */
    public function setCirculationPumpOne(?Component $circulationPumpOne): self
    {
        $this->circulationPumpOne = $circulationPumpOne;

        return $this;
    }

    /**
     * @return Component|null
     */
    public function getCirculationPumpTwo(): ?Component
    {
        return $this->circulationPumpTwo;
    }

    /**
     * @param Component|null $circulationPumpTwo
     *
     * @return $this
     */
    public function setCirculationPumpTwo(?Component $circulationPumpTwo): self
    {
        $this->circulationPumpTwo = $circulationPumpTwo;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
