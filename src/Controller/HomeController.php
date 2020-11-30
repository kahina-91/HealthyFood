<?php
namespace App\Controller;

use App\Entity\Food;
use App\Repository\FoodRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



class HomeController extends AbstractController
{

    /**
     * @Route("/", name="homepage")
     *
     * @return void
     */
    public function home(EntityManagerInterface $manager)
    {

        /*$food = new Food();
        $food->setName('Avocado oil')
             ->setCategory('oils')
             ->setVitaminsAndMinerals('
             vitamin E, , Magnesium, Sodium, vitamin D, vitamin A.')
             ->setCalories('884')
             ->setIntroduction("Avocado oil is an edible oil pressed from the fruit of the Persea americana (avocado). As a food oil, it is used as an ingredient in other dishes, and as a cooking oil. It is also used for lubrication and in cosmetics, where it is valued for its supposed regenerative and moisturizing properties.[1]
             It is pressed from the fleshy pulp surrounding the avocado pit and not the pit itself.
             It has an unusually high smoke point: 250 °C for unrefined oil and 271 °C for refined oil.[better source needed] The exact smoke point depends heavily on the quality of refinement and the way the oil has been handled until reaching store shelves and subsequently kitchens.")
             ->setCoverImage('/images/alternative-906138_640.jpg')
             ->setBenefits("avocado oil has beneficial effects on blood cholesterol levels and it reduce risk of coronary heart disease. Avocado oil contains a fatty substance called lecithin, which acts as a lubricant, when applied directly to the hair, it protects the follicles from harsh climates and wind damage. Adding avocado oil to your diet can help to lower low density lipid (LDL) or “bad” cholesterol levels.");
        $manager->persist($food);
        $manager->flush();*/
        return $this->render(
            'home.html.twig'
        );
    }

}