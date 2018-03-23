<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RoleResources
 *
 * @ORM\Table(name="role_resources", indexes={@ORM\Index(name="role_id", columns={"role_id"}), @ORM\Index(name="resource_id", columns={"resource_id"})})
 * @ORM\Entity
 */
class RoleResources
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Application\Entity\Roles
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Roles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $role;

    /**
     * @var \Application\Entity\Resources
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Resources")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="resource_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $resource;
    
    /**
     * @var string
     *
     * @ORM\Column(name="can_modify", type="string", precision=0, scale=0, nullable=false, unique=false)
     */
    private $canModify;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set role
     *
     * @param \Application\Entity\Roles $role
     *
     * @return RoleResources
     */
    public function setRole(\Application\Entity\Roles $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \Application\Entity\Roles
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set resource
     *
     * @param \Application\Entity\Resources $resource
     *
     * @return RoleResources
     */
    public function setResource(\Application\Entity\Resources $resource = null)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Get resource
     *
     * @return \Application\Entity\Resources
     */
    public function getResource()
    {
        return $this->resource;
    }
    
    /**
     * Set canModify
     *
     * @param string $canModify
     *
     * @return UseRoleResources
     */
    public function setCanModify($canModify)
    {
        $this->canModify = $canModify;

        return $this;
    }

    /**
     * Get canModify
     *
     * @return string
     */
    public function getCanModify()
    {
        return $this->canModify;
    }
}

