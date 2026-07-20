<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // جلب الأقسام الـ 6 الجديدة
    $chickenCategory  = Category::where('name->en', 'Grilled & Broasted Chicken')->first();
    $friesCategory    = Category::where('name->en', 'French Fries & Appetizers')->first();
    $pizzaCategory    = Category::where('name->en', 'Italian Pizza')->first();
    $seafoodCategory  = Category::where('name->en', 'Seafood & Fish')->first();
    $burgerCategory   = Category::where('name->en', 'Beef & Chicken Burger')->first();
    $kabsaCategory    = Category::where('name->en', 'Grills & Arabic Kabsa')->first();

    $products = [
      // 1. قسم الفروج وبروستاند (3 منتجات)
      [
        'category_id' => $chickenCategory?->id,
        'name' => [
          'ar' => 'فروج مشوي عالفحم',
          'en' => 'Charcoal Grilled Chicken',
        ],
        'body' => [
          'ar' => 'فروج كامل متبل على الطريقة الشرقية ومسبك على الفحم، يقدم مع كريم الثوم، البطاطا، والمخلل.',
          'en' => 'Whole chicken marinated oriental style and grilled over charcoal, served with garlic cream, fries, and pickles.',
        ],
        'is_featured' => true,
      ],
      [
        'category_id' => $chickenCategory?->id,
        'name' => [
          'ar' => 'وجبة بروستد مقرمش',
          'en' => 'Crispy Broasted Chicken Meal',
        ],
        'body' => [
          'ar' => 'أربع قطع من الدجاج المقرمش الذهبي بخلطتنا الخاصة، تقدم مع بطاطا، ثومية، وكولسلو.',
          'en' => 'Four pieces of golden crispy chicken with our special blend, served with fries, garlic sauce, and coleslaw.',
        ],
        'is_featured' => false,
      ],
      [
        'category_id' => $chickenCategory?->id,
        'name' => [
          'ar' => 'فروج مسحب على الجريل',
          'en' => 'Boneless Grilled Chicken',
        ],
        'body' => [
          'ar' => 'صدر وفخذ دجاج مسحب ومتبل ببهارات الليمون والفلفل، مشوي على الجريل يقدم مع الخضار.',
          'en' => 'Boneless chicken breast and thigh marinated with lemon pepper spices, grilled and served with veggies.',
        ],
        'is_featured' => false,
      ],

      // 2. قسم البطاطا والمقبلات (3 منتجات)
      [
        'category_id' => $friesCategory?->id,
        'name' => [
          'ar' => 'بطاطا مقرمشة بالجبنة ولحم البيكون',
          'en' => 'Loaded Cheesy Fries with Bacon',
        ],
        'body' => [
          'ar' => 'أصابع بطاطا ذهبية مغطاة بصوص الجبن الشيدر الذائب وقطع لحم البيكون المقرمش.',
          'en' => 'Golden fries topped with melted cheddar cheese sauce and crispy beef bacon bits.',
        ],
        'is_featured' => false,
      ],
      [
        'category_id' => $friesCategory?->id,
        'name' => [
          'ar' => 'أصابع الموزاريلا المقلية',
          'en' => 'Fried Mozzarella Sticks',
        ],
        'body' => [
          'ar' => 'أصابع جبنة الموزاريلا المقرمشة والمغطاة بالبقسماط الأعشاب، تقدم مع صوص المارينارا.',
          'en' => 'Crispy breaded mozzarella cheese sticks seasoned with herbs, served with marinara sauce.',
        ],
        'is_featured' => false,
      ],
      [
        'category_id' => $friesCategory?->id,
        'name' => [
          'ar' => 'حلقات البصل المقرمشة',
          'en' => 'Crispy Onion Rings',
        ],
        'body' => [
          'ar' => 'حلقات بصل طازجة مغطاة بطبقة مقرمشة ذهبية، تقدم مع صوص الباربكيو.',
          'en' => 'Fresh onion rings coated in a crispy golden batter, served with BBQ sauce.',
        ],
        'is_featured' => false,
      ],

      // 3. قسم البيتزا (3 منتجات)
      [
        'category_id' => $pizzaCategory?->id,
        'name' => [
          'ar' => 'بيتزا باربكيو دجاج',
          'en' => 'BBQ Chicken Pizza',
        ],
        'body' => [
          'ar' => 'عجينة رقيقة، قطع دجاج مشوي، بصل أحمر، مغطاة بصوص الباربكيو المدخن وجبنة الموزاريلا الفاخرة.',
          'en' => 'Thin crust, grilled chicken chunks, red onions, drizzled with smoky BBQ sauce and premium mozzarella cheese.',
        ],
        'is_featured' => true,
      ],
      [
        'category_id' => $pizzaCategory?->id,
        'name' => [
          'ar' => 'بيتزا مارغريتا كلاسيك',
          'en' => 'Classic Margherita Pizza',
        ],
        'body' => [
          'ar' => 'بيتزا إيطالية تقليدية بصلصة الطماطم الغنية، جبنة الموزاريلا الطازجة، وأوراق الريحان وزيت الزيتون.',
          'en' => 'Traditional Italian pizza with rich tomato sauce, fresh mozzarella cheese, basil leaves, and olive oil.',
        ],
        'is_featured' => false,
      ],
      [
        'category_id' => $pizzaCategory?->id,
        'name' => [
          'ar' => 'بيتزا بيبروني عشاق اللحم',
          'en' => 'Pepperoni Meat Lovers Pizza',
        ],
        'body' => [
          'ar' => 'عجينة مميزة محشوة بقطع البيبروني البقري، صوص الطماطم، ورشة سخية من جبنة الموزاريلا.',
          'en' => 'Premium dough loaded with beef pepperoni slices, tomato sauce, and a generous sprinkle of mozzarella cheese.',
        ],
        'is_featured' => true,
      ],

      // 4. قسم المأكولات البحرية والسمك (3 منتجات)
      [
        'category_id' => $seafoodCategory?->id,
        'name' => [
          'ar' => 'ديناميت روبيان مقرمش',
          'en' => 'Crispy Dynamite Shrimp',
        ],
        'body' => [
          'ar' => 'حبات روبيان جامبو مقلية مقرمشة ومغموسة بصوص الديناميت الحار والمايونيز الياباني.',
          'en' => 'Crispy fried jumbo shrimp tossed in spicy dynamite sauce and Japanese mayo.',
        ],
        'is_featured' => true,
      ],
      [
        'category_id' => $seafoodCategory?->id,
        'name' => [
          'ar' => 'فيليه سمك مشوي بالليمون',
          'en' => 'Grilled Fish Fillet with Lemon',
        ],
        'body' => [
          'ar' => 'شريحة فيليه سمك الهامور المشوي بصوص الليمون، الزبدة، والثوم يقدم مع أرز الصيادية البني.',
          'en' => 'Grilled Hamour fish fillet slice with lemon butter garlic sauce, served with brown Sayadiya rice.',
        ],
        'is_featured' => false,
      ],
      [
        'category_id' => $seafoodCategory?->id,
        'name' => [
          'ar' => 'وجبة كالاماري مقلي',
          'en' => 'Fried Calamari Meal',
        ],
        'body' => [
          'ar' => 'حلقات كالاماري مقلية ومقرمشة متبلة بالأعشاب، تقدم مع صوص التارتار والليمون.',
          'en' => 'Crispy deep-fried calamari rings seasoned with herbs, served with tartar sauce and lemon.',
        ],
        'is_featured' => false,
      ],

      // 5. قسم البرجر (3 منتجات)
      [
        'category_id' => $burgerCategory?->id,
        'name' => [
          'ar' => 'برجر دبل تشيز كلاسيك',
          'en' => 'Double Classic Cheeseburger',
        ],
        'body' => [
          'ar' => 'شريحتين من لحم البقر الأنجوس الصافي مع الجبن السويسري الذائب، الخس، الطماطم وصوص البرجر الخاص.',
          'en' => 'Two patties of pure Angus beef with melted Swiss cheese, lettuce, tomato, and special burger sauce.',
        ],
        'is_featured' => true,
      ],
      [
        'category_id' => $burgerCategory?->id,
        'name' => [
          'ar' => 'برجر دجاج مقرمش حار',
          'en' => 'Spicy Crispy Chicken Burger',
        ],
        'body' => [
          'ar' => 'صدر دجاج مقرمش ومغموس بالبهارات الحارة، يقدم مع الجبن، الهلابينو، وصوص المايونيز الحار.',
          'en' => 'Crispy chicken breast dipped in hot spices, served with cheese, jalapenos, and spicy mayo.',
        ],
        'is_featured' => false,
      ],
      [
        'category_id' => $burgerCategory?->id,
        'name' => [
          'ar' => 'برجر المشروم والجبنة السويسرية',
          'en' => 'Mushroom Swiss Burger',
        ],
        'body' => [
          'ar' => 'شريحة لحم مشوية مغطاة بصوص المشروم الكريمي البني الذائب مع شريحة جبنة سويسرية فاخرة.',
          'en' => 'Grilled beef patty smothered in creamy mushroom brown sauce with a slice of premium Swiss cheese.',
        ],
        'is_featured' => false,
      ],

      // 6. قسم الكبسة والمشويات (3 منتجات)
      [
        'category_id' => $kabsaCategory?->id,
        'name' => [
          'ar' => 'وجبة كبسة لحم غنم فاخرة',
          'en' => 'Premium Lamb Kabsa Meal',
        ],
        'body' => [
          'ar' => 'لحم غنم بلدي مطهو ببطء يقدم فوق أرز بسمتي معطر بالبهارات السعودية والزبيب والمكسرات المحمصة مع الدقوس.',
          'en' => 'Slow-cooked local lamb served over aromatic basmati rice with Saudi spices, raisins, roasted nuts, and Daqoos sauce.',
        ],
        'is_featured' => true,
      ],
      [
        'category_id' => $kabsaCategory?->id,
        'name' => [
          'ar' => 'وجبة كبسة دجاج مظبي',
          'en' => 'Chicken Madhbi Kabsa Meal',
        ],
        'body' => [
          'ar' => 'نصف دجاجة مشوية على أحجار المظبي الساخنة تقدم مع أرز الكبسة الشعبي الطويل الحبة والبصل المقلي.',
          'en' => 'Half chicken grilled on hot Madhbi stones served with traditional long-grain Kabsa rice and fried onions.',
        ],
        'is_featured' => false,
      ],
      [
        'category_id' => $kabsaCategory?->id,
        'name' => [
          'ar' => 'مشويات مشكلة شرقاوية',
          'en' => 'Assorted Mix Oriental Grills',
        ],
        'body' => [
          'ar' => 'سيخ كباب لحم، سيخ كفتة دجاج، وسيخ شيش طاووق مشوي على الفحم مع الخضار المشوية والخبز البيواز.',
          'en' => 'Skewers of beef kebab, chicken kofta, and shish taouk grilled over charcoal with grilled veggies and Biwaz bread.',
        ],
        'is_featured' => true,
      ],
    ];

    foreach ($products as $productData) {
      if ($productData['category_id']) {
        Product::updateOrCreate(
          ['name->en' => $productData['name']['en']],
          [
            'category_id' => $productData['category_id'],
            'name' => $productData['name'],
            'body' => $productData['body'],
            'is_featured' => $productData['is_featured'],
          ]
        );
      }
    }

    $this->command->info('18 Products seeded successfully (3 per category) without images!');
  }
}
