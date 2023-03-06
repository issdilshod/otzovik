<?php

namespace Database\Seeders;

use App\Models\Admin\Setting\Seo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seos = [
            [
                'url' => 'home',
                'title' => 'Главная страница',
                'description' => 'Главная страница'
            ],
            [
                'url' => 'poisk',
                'title' => 'Подборать ВУЗ',
                'description' => 'Подобрать ВУЗ'
            ],
            [
                'url' => 'poisk2',
                'title' => 'Поиск',
                'description' => 'Поиск'
            ],
            [
                'url' => 'poisk2',
                'title' => 'Поиск',
                'description' => 'Поиск'
            ],
            [
                'url' => 'universitety',
                'title' => 'Университеты',
                'description' => 'Университеты'
            ],
            [
                'url' => 'dobavit-vuz',
                'title' => 'Добавить ВУЗ',
                'description' => 'Добавить ВУЗ'
            ],
            [
                'url' => 'otzyvy',
                'title' => 'Отзывы',
                'description' => 'Отзывы'
            ],
            [
                'url' => 'dobavit-otzyv',
                'title' => 'Добавить отзыв',
                'description' => 'Добавить отзыв'
            ],
            [
                'url' => 'posti',
                'title' => 'Посты',
                'description' => 'Посты'
            ],
            [
                'url' => 'o-service',
                'title' => 'О сервисе',
                'description' => 'О сервисе'
            ],
            [
                'url' => 'faq',
                'title' => 'FAQ',
                'description' => 'FAQ'
            ],
            [
                'url' => 'uchebnim-zavedeniyam',
                'title' => 'Учебным заведениям',
                'description' => 'Учебным заведениям'
            ],
            [
                'url' => 'top-universitety',
                'title' => 'Топ университеты',
                'description' => 'Топ университеты'
            ],
            [
                'url' => 'legal',
                'title' => 'Leagal',
                'description' => 'Legal'
            ],
            [
                'url' => 'policy',
                'title' => 'Policy',
                'description' => 'Policy'
            ]
        ];

        foreach($seos as $key => $value):
            $tmpSeo = Seo::where('url', $value['url'])
                                ->first();
            if ($tmpSeo==null){
                Seo::create($value);
            }else{
                $tmpSeo->update($value);
            }
        endforeach;

    }
}
