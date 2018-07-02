<?php

namespace AppBundle\Entity;

use Sonata\UserBundle\Entity\BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity
 */
class User extends BaseUser
{

  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @var string
   *
   * @ORM\Column(name="hcode", type="string", length=255, nullable=true)
   */
  protected $hcode;

  /**
   * @var string
   *
   * @ORM\Column(name="address", type="string", length=255, nullable=true)
   */
  protected $address;

  /**
   * @var string
   *
   * @ORM\Column(name="code_postal", type="string", length=255, nullable=true)
   */
  protected $codePostal;

  /**
   * @var string
   *
   * @ORM\Column(name="city", type="string", length=255, nullable=true)
   */
  protected $city;

  /**
   * @var string
   *
   * @ORM\Column(name="company", type="string", length=255, nullable=true)
   */
  protected $company;

  /**
   * @var string
   *
   * @ORM\Column(name="activity", type="string", length=255, nullable=true)
   */
  protected $activity;

  /**
   * @var string
   *
   * @ORM\Column(name="proffession", type="string", length=255, nullable=true)
   */
  protected $proffession;
  
  public function getHcode()
  {
    return $this->hcode;
  }
  
  public function setHcode($hcode)
  {
    $this->hcode = $hcode;
    
    return $this;
  }
  
  public function getAddress()
  {
    return $this->address;
  }
  
  public function setAddress($address)
  {
    $this->address = $address;
    
    return $this;
  }
  
  public function getCodePostal()
  {
    return $this->codePostal;
  }
  
  public function setCodePostal($codePostal)
  {
    $this->codePostal = $codePostal;
    
    return $this;
  }
  
  public function getCity()
  {
    return $this->city;
  }
  
  public function setCity($city)
  {
    $this->city = $city;
    
    return $this;
  }
  
  public function getCompany()
  {
    return $this->company;
  }
  
  public function setCompany($company)
  {
    $this->company = $company;
    
    return $this;
  }
  
  public function getActivity()
  {
    return $this->activity;
  }
  
  public function setActivity($activity)
  {
    $this->activity = $activity;
    
    return $this;
  }
  
  public function getProffession()
  {
    return $this->proffession;
  }
  
  public function setProffession($proffession)
  {
    $this->proffession = $proffession;
    
    return $this;
  }

}