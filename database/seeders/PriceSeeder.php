<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Price;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $p1 = new Price();
      $p1->title = 'Получение ГПЗУ';
      $p1->type = 'realty';
      $p1->price1 = 1000;
      $p1->price2 = 1100;
      $p1->price3 = 1200;
      $p1->percent = 20;
      $p1->save();

      $p2 = new Price();
      $p2->title = 'Получение официальной выписки из ЕГРН';
      $p2->type = 'realty';
      $p2->price1 = 1000;
      $p2->price2 = 1100;
      $p2->price3 = 1200;
      $p2->percent = 20;
      $p2->save();

      $p3 = new Price();
      $p3->title = 'Выписка из ЕГРП о переходе прав';
      $p3->type = 'realty';
      $p3->price1 = 1000;
      $p3->price2 = 1100;
      $p3->price3 = 1200;
      $p3->percent = 20;
      $p3->save();

      $p4 = new Price();
      $p4->title = 'Справка о кадастровой стоимости';
      $p4->type = 'realty';
      $p4->price1 = 1000;
      $p4->price2 = 1100;
      $p4->price3 = 1200;
      $p4->percent = 20;
      $p4->save();

      $p5 = new Price();
      $p5->title = 'Проверка объекта на арест';
      $p5->type = 'realty';
      $p5->price1 = 1000;
      $p5->price2 = 1100;
      $p5->price3 = 1200;
      $p5->percent = 20;
      $p5->save();

      $p6 = new Price();
      $p6->title = 'Жилой дом';
      $p6->type = 'realty';
      $p6->price1 = 1000;
      $p6->price2 = 1100;
      $p6->price3 = 1200;
      $p6->percent = 20;
      $p6->save();

      $p7 = new Price();
      $p7->title = 'Нежилое строение';
      $p7->type = 'realty';
      $p7->price1 = 1000;
      $p7->price2 = 1100;
      $p7->price3 = 1200;
      $p7->percent = 20;
      $p7->save();

      $p22 = new Price();
      $p22->title = 'Список';
      $p22->type = 'realty';
      $p22->price1 = 0;
      $p22->price2 = 0;
      $p22->price3 = 0;
      $p22->percent = 20;
      $p22->save();

      $p8 = new Price();
      $p8->title = 'Гараж';
      $p8->type = 'realty';
      $p8->price1 = 1000;
      $p8->price2 = 1100;
      $p8->price3 = 1200;
      $p8->percent = 20;
      $p8->save();

      $p9 = new Price();
      $p9->title = 'Баня';
      $p9->type = 'realty';
      $p9->price1 = 1000;
      $p9->price2 = 1100;
      $p9->price3 = 1200;
      $p9->percent = 20;
      $p9->save();

      $p10 = new Price();
      $p10->title = 'Хозяйственный блок';
      $p10->type = 'realty';
      $p10->price1 = 1000;
      $p10->price2 = 1100;
      $p10->price3 = 1200;
      $p10->percent = 20;
      $p10->save();

      $p11 = new Price();
      $p11->title = 'Навес';
      $p11->type = 'realty';
      $p11->price1 = 1000;
      $p11->price2 = 1100;
      $p11->price3 = 1200;
      $p11->percent = 20;
      $p11->save();

      $p12 = new Price();
      $p12->title = 'Теплица';
      $p12->type = 'realty';
      $p12->price1 = 1000;
      $p12->price2 = 1100;
      $p12->price3 = 1200;
      $p12->percent = 20;
      $p12->save();

      $p13 = new Price();
      $p13->title = 'Садовый дом';
      $p13->type = 'realty';
      $p13->price1 = 1000;
      $p13->price2 = 1100;
      $p13->price3 = 1200;
      $p13->percent = 20;
      $p13->save();

      $p14 = new Price();
      $p14->title = 'Другое';
      $p14->type = 'realty';
      $p14->price1 = 1000;
      $p14->price2 = 1100;
      $p14->price3 = 1200;
      $p14->percent = 20;
      $p14->save();

      $p15 = new Price();
      $p15->title = 'Кадастровым инженером';
      $p15->type = 'realty';
      $p15->price1 = 1000;
      $p15->price2 = 1100;
      $p15->price3 = 1200;
      $p15->percent = 20;
      $p15->save();

      $p16 = new Price();
      $p16->title = 'Самостоятельно в МФУ';
      $p16->type = 'realty';
      $p16->price1 = 0;
      $p16->price2 = 0;
      $p16->price3 = 0;
      $p16->percent = 20;
      $p16->save();

      $p17 = new Price();
      $p17->title = 'Получить результаты на email';
      $p17->type = 'realty';
      $p17->price1 = 0;
      $p17->price2 = 0;
      $p17->price3 = 0;
      $p17->percent = 20;
      $p17->save();

      $p18 = new Price();
      $p18->title = 'Курьером в бумажном виде';
      $p18->type = 'realty';
      $p18->price1 = 1000;
      $p18->price2 = 1100;
      $p18->price3 = 1200;
      $p18->percent = 20;
      $p18->save();

      $p19 = new Price();
      $p19->title = 'Запись тех. плана на CD';
      $p19->type = 'realty';
      $p19->price1 = 1000;
      $p19->price2 = 1100;
      $p19->price3 = 1200;
      $p19->percent = 20;
      $p19->save();

      $p20 = new Price();
      $p20->title = 'Доставка тех. плана курьером';
      $p20->type = 'realty';
      $p20->price1 = 1000;
      $p20->price2 = 1100;
      $p20->price3 = 1200;
      $p20->percent = 20;
      $p20->save();

      $p21 = new Price();
      $p21->title = 'Госпошлина за жилой дом';
      $p21->type = 'realty';
      $p21->price1 = 1000;
      $p21->price2 = 1100;
      $p21->price3 = 1200;
      $p21->percent = 20;
      $p21->save();

      $p23 = new Price();
      $p23->title = 'Госпошлина за нежилое строение';
      $p23->type = 'realty';
      $p23->price1 = 1000;
      $p23->price2 = 1100;
      $p23->price3 = 1200;
      $p23->percent = 20;
      $p23->save();

      $p24 = new Price();
      $p24->title = 'Постановка на учет (ранее зарегистрированного строения)';
      $p24->type = 'realty';
      $p24->price1 = 1000;
      $p24->price2 = 1100;
      $p24->price3 = 1200;
      $p24->percent = 20;
      $p24->save();

      $p25 = new Price();
      $p25->title = 'Оформление права собственности на нежилое строение';
      $p25->type = 'realty';
      $p25->price1 = 1000;
      $p25->price2 = 1100;
      $p25->price3 = 1200;
      $p25->percent = 20;
      $p25->save();

      $p26 = new Price();
      $p26->title = 'Оформление права собственности на жилой дом';
      $p26->type = 'realty';
      $p26->price1 = 1000;
      $p26->price2 = 1100;
      $p26->price3 = 1200;
      $p26->percent = 20;
      $p26->save();

      $p27 = new Price();
      $p27->title = 'Топографическая съемка 20';
      $p27->type = 'geo';
      $p27->price1 = 30000;
      $p27->price2 = 25000;
      $p27->price3 = 20000;
      $p27->percent = 20;
      $p27->save();

      $p28 = new Price();
      $p28->title = 'Топографическая съемка 100';
      $p28->type = 'geo';
      $p28->price1 = 50000;
      $p28->price2 = 70000;
      $p28->price3 = 150000;
      $p28->percent = 20;
      $p28->save();

      $p29 = new Price();
      $p29->title = 'Топографическая съемка >100';
      $p29->type = 'geo';
      $p29->price1 = 15000;
      $p29->price2 = 20000;
      $p29->price3 = 25000;
      $p29->percent = 20;
      $p29->save();

      $p30 = new Price();
      $p30->title = 'Вынос границ земельных участков 3';
      $p30->type = 'geo';
      $p30->price1 = 5000;
      $p30->price2 = 4900;
      $p30->price3 = 4800;
      $p30->percent = 20;
      $p30->save();

      $p31 = new Price();
      $p31->title = 'Вынос границ земельных участков 100';
      $p31->type = 'geo';
      $p31->price1 = 1500;
      $p31->price2 = 1400;
      $p31->price3 = 1300;
      $p31->percent = 20;
      $p31->save();

      $p32 = new Price();
      $p32->title = 'Вынос границ земельных участков >100';
      $p32->type = 'geo';
      $p32->price1 = 1000;
      $p32->price2 = 900;
      $p32->price3 = 800;
      $p32->percent = 20;
      $p32->save();

      $p33 = new Price();
      $p33->title = 'Исполнительная съемка коммуникаций 100';
      $p33->type = 'geo';
      $p33->price1 = 35000;
      $p33->price2 = 25000;
      $p33->price3 = 15000;
      $p33->percent = 20;
      $p33->save();

      $p34 = new Price();
      $p34->title = 'Исполнительная съемка коммуникаций >100';
      $p34->type = 'geo';
      $p34->price1 = 20000;
      $p34->price2 = 15000;
      $p34->price3 = 10000;
      $p34->percent = 20;
      $p34->save();

      $p35 = new Price();
      $p35->title = 'Разбивка осей зданий и сооружений';
      $p35->type = 'geo';
      $p35->price1 = 5000;
      $p35->price2 = 5500;
      $p35->price3 = 6000;
      $p35->percent = 20;
      $p35->save();

      $p36 = new Price();
      $p36->title = 'Кадастровая съемка земельного участка 20';
      $p36->type = 'geo';
      $p36->price1 = 10000;
      $p36->price2 = 12000;
      $p36->price3 = 15000;
      $p36->percent = 20;
      $p36->save();

      $p37 = new Price();
      $p37->title = 'Кадастровая съемка земельного участка 100';
      $p37->type = 'geo';
      $p37->price1 = 40000;
      $p37->price2 = 50000;
      $p37->price3 = 55000;
      $p37->percent = 20;
      $p37->save();

      $p38 = new Price();
      $p38->title = 'Кадастровая съемка земельного участка >100';
      $p38->type = 'geo';
      $p38->price1 = 9000;
      $p38->price2 = 8000;
      $p38->price3 = 7000;
      $p38->percent = 20;
      $p38->save();

      $p39 = new Price();
      $p39->title = 'Межевание земельного участка 20';
      $p39->type = 'plot';
      $p39->price1 = 10000;
      $p39->price2 = 12000;
      $p39->price3 = 15000;
      $p39->percent = 20;
      $p39->save();

      $p40 = new Price();
      $p40->title = 'Межевание земельного участка 100';
      $p40->type = 'plot';
      $p40->price1 = 40000;
      $p40->price2 = 50000;
      $p40->price3 = 55000;
      $p40->percent = 20;
      $p40->save();

      $p41 = new Price();
      $p41->title = 'Межевание земельного участка >100';
      $p41->type = 'plot';
      $p41->price1 = 9000;
      $p41->price2 = 8000;
      $p41->price3 = 7000;
      $p41->percent = 20;
      $p41->save();

      $p42 = new Price();
      $p42->title = 'Раздел земельного участка 2';
      $p42->type = 'plot';
      $p42->price1 = 25000;
      $p42->price2 = 20000;
      $p42->price3 = 15000;
      $p42->percent = 20;
      $p42->save();

      $p43 = new Price();
      $p43->title = 'Раздел земельного участка 10';
      $p43->type = 'plot';
      $p43->price1 = 20000;
      $p43->price2 = 15000;
      $p43->price3 = 10000;
      $p43->percent = 20;
      $p43->save();

      $p44 = new Price();
      $p44->title = 'Раздел земельного участка >10';
      $p44->type = 'plot';
      $p44->price1 = 10000;
      $p44->price2 = 9000;
      $p44->price3 = 8000;
      $p44->percent = 20;
      $p44->save();

      $p45 = new Price();
      $p45->title = 'Оформление сервитута';
      $p45->type = 'plot';
      $p45->price1 = 10000;
      $p45->price2 = 9000;
      $p45->price3 = 8000;
      $p45->percent = 20;
      $p45->save();

      $p46 = new Price();
      $p46->title = 'Объеденние земельных участков 2';
      $p46->type = 'plot';
      $p46->price1 = 25000;
      $p46->price2 = 20000;
      $p46->price3 = 15000;
      $p46->percent = 20;
      $p46->save();

      $p47 = new Price();
      $p47->title = 'Объеденние земельных участков 10';
      $p47->type = 'plot';
      $p47->price1 = 20000;
      $p47->price2 = 15000;
      $p47->price3 = 10000;
      $p47->percent = 20;
      $p47->save();

      $p48 = new Price();
      $p48->title = 'Объеденние земельных участков >10';
      $p48->type = 'plot';
      $p48->price1 = 10000;
      $p48->price2 = 9000;
      $p48->price3 = 8000;
      $p48->percent = 20;
      $p48->save();

      $p49 = new Price();
      $p49->title = 'Исправление реестровой ошибки';
      $p49->type = 'plot';
      $p49->price1 = 10000;
      $p49->price2 = 9000;
      $p49->price3 = 8000;
      $p49->percent = 20;
      $p49->save();

      $p50 = new Price();
      $p50->title = 'Землеустроительная экспертиза';
      $p50->type = 'plot';
      $p50->price1 = 10000;
      $p50->price2 = 9000;
      $p50->price3 = 8000;
      $p50->percent = 20;
      $p50->save();



    }
}
