<?php

namespace App\Mapper;

use App\Entity\Patient;
use App\Entity\Praticien;
use App\DTO\RendezVousDTO;
use App\Entity\RendezVous;
use App\Mapper\PatientMapper;
use App\Mapper\PraticienMapper;

class RendezVousMapper {
    private $patientMapper;
    private $praticienMapper;

    public function __construct(PatientMapper $patientMapper, PraticienMapper $praticienMapper)
    {
        $this->patientMapper = $patientMapper;
        $this->praticienMapper = $praticienMapper; 
    }

    public function transformeRendezVousDTOToRendezVousEntity(RendezVousDTO $rendezVousDTO, RendezVous $rendezVous, array $patient, array $praticien){
        // $rendezVous->setId($rendezVousDTO->getId());
        $rendezVous->setDateAndHeure($rendezVousDTO->getDateAndHeure());

        foreach($patient as $rdvPatient){
            $rendezVous->setRendezVousPatient($rdvPatient);
        }

        foreach($praticien as $rdvpraticien){
            $rendezVous->setRendezVousPraticien($rdvpraticien);

        return $rendezVous;
        }
    }

    public function transformeRendezVousEntityToRendezVousDTO(RendezVous $rendezVous){
        $rendezVousPatients=[ ($rendezVous->getRendezVousPatient())->getId(),
                                ($rendezVous->getRendezVousPatient())->getNom(),
                                ($rendezVous->getRendezVousPatient())->getPrenom(),
                                ($rendezVous->getRendezVousPatient())->getEmail(),
                                ($rendezVous->getRendezVousPatient())->getTelephone(),
                                ($rendezVous->getRendezVousPatient())->getAdresse(),
                            ];

        $rendezVousPraticiens=[ ($rendezVous->getRendezVousPraticien())->getId(),
                                ($rendezVous->getRendezVousPraticien())->getNom(),
                                ($rendezVous->getRendezVousPraticien())->getPrenom(),
                                ($rendezVous->getRendezVousPraticien())->getEmail(),
                                ($rendezVous->getRendezVousPraticien())->getSpecialite(),
                                ($rendezVous->getRendezVousPraticien())->getTelephone(),
                            ];

        $rendezVousDTO = new rendezVousDTO();
        $rendezVousDTO->setId($rendezVous->getId());
        $rendezVousDTO->setDateAndHeure($rendezVous->getDateAndHeure());
        $rendezVousDTO->setRendezVousPatient($rendezVousPatients); 
        $rendezVousDTO->setRendezVousPraticien($rendezVousPraticiens); 
        return $rendezVousDTO;
    }
}


//** POST   => IdPatient Null */
