<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseGroup;

/**
 * User
 *
 * @ORM\Table(name="fos_group")
 * @ORM\Entity
 */
class Group extends BaseGroup
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
   * @var int
   *
   * @ORM\Column(name="count", type="integer")
   */
  protected $count;
  
  public function __construct($name, array $roles)
  {
    parent::__construct($name, $roles);
    
    $this->count = 0;
  }

  public function getCount()
  {
    return $this->count;
  }
  
  public function setCount($count)
  {
    $this->count = $count;
    
    return $this;
  }
  
  public function addCount()
  {
    $this->count = $this->count + 1;
  }

}