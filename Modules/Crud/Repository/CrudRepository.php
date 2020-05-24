<?php

namespace Modules\Crud\Repository;

use Modules\Crud\Entities\Crud;
use Doctrine\ORM\EntityManager;

class CrudRepository
{

    /**
     * @var string
     */
    private $class = 'Modules\Crud\Entities\Crud';
    /**
     * @var EntityManager
     */
    private $em;


    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    public function create(Crud $post)
    {
        $this->em->persist($post);
        $this->em->flush();
    }

    public function update(Crud $post, $data)
    {
        $post->setFirstName($data['first_name']);
        $post->setLastName($data['last_name']);
        $this->em->persist($post);
        $this->em->flush();
    }

    public function PostOfId($id)
    {
        return $this->em->getRepository($this->class)->findOneBy([
            'id' => $id
        ]);
    }

    public function delete(Crud $post)
    {
        $this->em->remove($post);
        $this->em->flush();
    }

    /**
     * create Crud
     * @return Crud
     */
    private function prepareData($data)
    {
        return new Crud($data);
    }
}
