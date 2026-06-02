<?php

namespace App\DataFixtures;


use App\Entity\Category;
use App\Entity\Link;
use App\Entity\Account;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        //

        $categoryIds = [];
       
        for ($i = 0; $i <= 100; $i++) {
             $category = new Category();
            $category->setName($faker->unique()->word());
            array_push($categoryIds, $category);
            $manager->persist($category);
            
        }

        //

        
        $accountIds = [];
        for ($i = 0; $i <= 10; $i++) {
            $account = new Account();
            $account->setFirstname($faker->unique()->firstName())
                ->setLastname($faker->unique()->lastName())
                ->setEmail($faker->unique()->email())
                ->setLastname($faker->unique()->name())
                ->setRoles(['ROLE_USER'])
                ->setImg($faker->unique()->imageUrl(96,96))
                ->setPassword($this->hasher->hashPassword($account, '12345678AA'));
            array_push($accountIds, $account);
            $manager->persist($account);
        }
        
        for ($i = 0; $i <= 20; $i++) {
            $link = new Link();
            $link->setUrl($faker->unique()->name())
                ->setUrl($faker->unique()->url())
                ->setIcon($faker->unique()->imageUrl(24,24))
                ->setName($faker->unique()->name())
                ->setCreatedAt(\DateTimeImmutable::createFromFormat('Y-m-d', $faker->date()))
                ->setAccount($accountIds[rand(1, count($accountIds) - 1)]);
            for ($j = 0; $j <= 3; $j++) {
                $link->addCategory($categoryIds[rand(1, count($categoryIds) - 1)]);
            }
            $manager->persist($link);

        }
$manager->flush();
       
        //
    }
}
