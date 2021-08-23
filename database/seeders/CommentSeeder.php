<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'author' => 'admin',
            'comment' => 'Сделал дня за 3. Фильтрацию по автору только по-другому сделал. Понятно, что нужно аяксом к базе обращаться и выводить список совпавших авторов. Но куда его потом пристроить так и не придумал.'
        ]);

        DB::table('comments')->insert([
            'author' => 'proger',
            'comment' => 'А почему на ларавеле?'
        ]);

        DB::table('comments')->insert([
            'author' => 'admin',
            'comment' => 'proger, потому что с данным фреймворком более-менее знаком.'
        ]);

        DB::table('comments')->insert([
            'author' => 'vovka',
            'comment' => 'А что самое трудное было?'
        ]);

        DB::table('comments')->insert([
            'author' => 'admin',
            'comment' => 'vovka, вёрстка. Вообще не моё. Да и ларавел в общем-то только изучать начал. Не такой большой опыт ещё, как хотелось бы.'
        ]);

        DB::table('comments')->insert([
            'author' => 'vovka',
            'comment' => 'А мне нравится верстать.'
        ]);

        DB::table('comments')->insert([
            'author' => 'proger',
            'comment' => 'vovka, ну ты вообще отбитый, конечно. Как можно сидеть и все элементы выставлять по своим местам?'
        ]);

        DB::table('comments')->insert([
            'author' => 'admin',
            'comment' => 'Согласен с proger-ом. Пиксель влево, пиксель вправо, всё постоянно куда-то уезжает... Знаю, что в руках дело, но это вообще не для меня. Аж в дрожь бросает.'
        ]);

        DB::table('comments')->insert([
            'author' => 'vovka',
            'comment' => 'Слабаки)'
        ]);

        DB::table('comments')->insert([
            'author' => 'proger',
            'comment' => 'vovka, дело вкуса) Не каждому дано. Накидал примерно, а там пусть дальше опытные верстальщики шаманят. Не всех это занятие радует.'
        ]);

        DB::table('comments')->insert([
            'author' => 'admin',
            'comment' => 'А ещё такая проблема, что код из документации не всегда работает. Хоть убей, делаешь всё так же, но не работает. Поэтому некоторые части кода весьма спорные.'
        ]);

        DB::table('comments')->insert([
            'author' => 'admin',
            'comment' => 'Но, в принципе, некоторые задания не обязательны же. Пускай окончательный вариант таким остаётся.'
        ]);
    }
}
