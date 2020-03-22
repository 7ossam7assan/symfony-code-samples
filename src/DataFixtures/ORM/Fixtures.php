<?php
/**
 * Created by PhpStorm.
 * User: hossam
 * Date: 12/30/18
 * Time: 10:29 PM
 */

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures\ORM;


use ConfigBundle\Entity\Config;
use ConfigBundle\Entity\ConfigCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create config seeder!
            $category1 = $manager->getRepository(ConfigCategory::class)->find(1);
            $category2 = $manager->getRepository(ConfigCategory::class)->find(2);
            $category3 = $manager->getRepository(ConfigCategory::class)->find(3);
            $category4 = $manager->getRepository(ConfigCategory::class)->find(4);
            $config = new Config();
            $config->setVariable("logo");
            $config->setDiplayName("logo");
            $config->setValue("logo.jpeg");
            $config->setType("2");
            $config->setCategory($category1);

            $config->setVariable("favicon");
            $config->setDiplayName("favicon");
            $config->setValue("favicon.jpeg");
            $config->setType("2");
            $config->setCategory($category1);

            $config->setVariable("site_name");
            $config->setDiplayName("اسم الموقع");
            $config->setValue("site_name.jpeg");
            $config->setType("1");
            $config->setCategory($category1);

            $config->setVariable("site_desc");
            $config->setDiplayName("وصف الموقع");
            $config->setValue("site_desc.jpeg");
            $config->setType("3");
            $config->setCategory($category1);

            $config->setVariable("fb_link");
            $config->setDiplayName("facebook");
            $config->setValue("https://www.facebook.com");
            $config->setType("1");
            $config->setCategory($category3);

            $config->setVariable("tw_link");
            $config->setDiplayName("twitter");
            $config->setValue("https://www.twitter.com");
            $config->setType("1");
            $config->setCategory($category3);

            $config->setVariable("youtube_link");
            $config->setDiplayName("youtube");
            $config->setValue("https://www.youtube.com");
            $config->setType("1");
            $config->setCategory($category3);

            $config->setVariable("googleplus_link");
            $config->setDiplayName("google plus");
            $config->setValue("https://plus.google.com");
            $config->setType("1");
            $config->setCategory($category3);

            $config->setVariable("instgram_link");
            $config->setDiplayName("instgram");
            $config->setValue("https://instagram.com");
            $config->setType("1");
            $config->setCategory($category3);

            $config->setVariable("skype_link");
            $config->setDiplayName("skype");
            $config->setValue("https://skype.com");
            $config->setType("1");
            $config->setCategory($category3);

            $config->setVariable("meta_title");
            $config->setDiplayName("Meta Title");
            $config->setValue("Title1");
            $config->setType("1");
            $config->setCategory($category2);

            $config->setVariable("meta_desc");
            $config->setDiplayName("Meta Description");
            $config->setValue("Description1 Description1 Description1 Description1 Description1 Description1");
            $config->setType("3");
            $config->setCategory($category2);

            $config->setVariable("meta_keyword");
            $config->setDiplayName("Meta Keyword");
            $config->setValue("Keyword");
            $config->setType("4");
            $config->setCategory($category2);

            $config->setVariable("phone");
            $config->setDiplayName("الهاتف");
            $config->setValue("01122114227");
            $config->setType("5");
            $config->setCategory($category4);

            $config->setVariable("email");
            $config->setDiplayName("البريد الالكترونى");
            $config->setValue("info@vita.com");
            $config->setType("6");
            $config->setCategory($category4);

            $config->setVariable("google_analytics");
            $config->setDiplayName("Google Analytics");
            $config->setValue('<script async src=\"https://www.googletagmanager.com/gtag/js?id=GA_TRACKING_ID\"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag(\'js\', new Date());

  gtag(\'config\', \'GA_TRACKING_ID\');
</script>');

            $manager->persist($config);


        $manager->flush();
    }
}

