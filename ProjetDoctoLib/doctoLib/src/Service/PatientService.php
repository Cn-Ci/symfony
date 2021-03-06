<?php

namespace App\Service;

use App\DTO\PatientDTO;
use App\Entity\Patient;
use App\Mapper\PatientMapper;
use App\Repository\PatientRepository;
use App\Repository\RendezVousRepository;
use App\Service\Exceptions\PatientServiceException;
use Doctrine\DBAL\Exception\DriverException;
use Doctrine\ORM\EntityManagerInterface;

class PatientService {

    private $repository;
    private $entityManager;
    private $patientMapper;
    private $rendezVousRepository;
    private $patientRepository;

    public function __construct(PatientRepository $repo, EntityManagerInterface $entityManager, PatientMapper $patientMapper, RendezVousRepository $rendezVousRepository, PatientRepository $patientRepository){
        $this->repository = $repo;
        $this->entityManager = $entityManager;
        $this->patientMapper = $patientMapper;
        $this->rendezVousRepository = $rendezVousRepository;
        $this->patientRepository = $patientRepository;
    }

    public function searchAll(){
        try {
            $patients = $this->repository->findAll();
            $patientDTOs = [];
            foreach ($patients as $patient) {
                $patientDTOs[] = $this->patientMapper->transformePatientEntityToPatientDTO($patient);
            }
            return $patientDTOs;
        }catch (DriverException $e){
            throw new PatientServiceException("Un problème est technique est servenu. Veuilllez réessayer ultérieurement.", $e->getCode());
        }
        
    }

    public function delete(Patient $patient){
        try {
            $this->entityManager->remove($patient);
            $this->entityManager->flush();
        } catch(DriverException $e){
            throw new PatientServiceException("Un problème est technique est servenu. Veuilllez réessayer ultérieurement.", $e->getCode());
        }
    }

    public function persist(Patient $patient, PatientDTO $patientDTO){
        try{
            // if($PatientDTO->getId()){
            //     // Cas de modification d'une Patient
            //     $Patient = $this->repository->find($PatientDTO->getId());
            // } else {
            //     // Cas de création d'une nouvelle Patient
            //     $Patient = new Patient();
            // }

            $rendezVouss=$patientDTO->getRendezVouses();
            $rendezVous = [];
            foreach($rendezVouss as $rdvKey => $rdvValue){
                $rendezVous[]=$this->rendezVousRepository->findOneby(['id' => $rdvValue]);
            }

            $patient = $this->patientMapper->transformePatientDTOToPatientEntity($patientDTO, $patient, $rendezVous);
            $this->entityManager->persist($patient);
            $this->entityManager->flush();
        } catch(DriverException $e){
            throw new PatientServiceException("Un problème est technique est servenu. Veuilllez réessayer ultérieurement.", $e->getCode());
        }
    }

    public function searchById(int $id){
        try {
            $patient = $this->repository->find($id);
            return $this->patientMapper->transformePatientEntityToPatientDto($patient);
        } catch(DriverException $e){
            throw new PatientServiceException("Un problème est technique est servenu. Veuilllez réessayer ultérieurement.", $e->getCode());
        }
    }

}
