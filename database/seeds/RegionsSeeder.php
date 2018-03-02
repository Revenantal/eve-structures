<?php

use App\Models\EVE\Region;
use Illuminate\Database\Seeder;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = [['id'=>10000001,'name'=>'Derelik'],['id'=>10000002,'name'=>'The Forge'],['id'=>10000003,'name'=>'Vale of the Silent'],['id'=>10000004,'name'=>'UUA-F4'],['id'=>10000005,'name'=>'Detorid'],['id'=>10000006,'name'=>'Wicked Creek'],['id'=>10000007,'name'=>'Cache'],['id'=>10000008,'name'=>'Scalding Pass'],['id'=>10000009,'name'=>'Insmother'],['id'=>10000010,'name'=>'Tribute'],['id'=>10000011,'name'=>'Great Wildlands'],['id'=>10000012,'name'=>'Curse'],['id'=>10000013,'name'=>'Malpais'],['id'=>10000014,'name'=>'Catch'],['id'=>10000015,'name'=>'Venal'],['id'=>10000016,'name'=>'Lonetrek'],['id'=>10000017,'name'=>'J7HZ-F'],['id'=>10000018,'name'=>'The Spire'],['id'=>10000019,'name'=>'A821-A'],['id'=>10000020,'name'=>'Tash-Murkon'],['id'=>10000021,'name'=>'Outer Passage'],['id'=>10000022,'name'=>'Stain'],['id'=>10000023,'name'=>'Pure Blind'],['id'=>10000025,'name'=>'Immensea'],['id'=>10000027,'name'=>'Etherium Reach'],['id'=>10000028,'name'=>'Molden Heath'],['id'=>10000029,'name'=>'Geminate'],['id'=>10000030,'name'=>'Heimatar'],['id'=>10000031,'name'=>'Impass'],['id'=>10000032,'name'=>'Sinq Laison'],['id'=>10000033,'name'=>'The Citadel'],['id'=>10000034,'name'=>'The Kalevala Expanse'],['id'=>10000035,'name'=>'Deklein'],['id'=>10000036,'name'=>'Devoid'],['id'=>10000037,'name'=>'Everyshore'],['id'=>10000038,'name'=>'The Bleak Lands'],['id'=>10000039,'name'=>'Esoteria'],['id'=>10000040,'name'=>'Oasa'],['id'=>10000041,'name'=>'Syndicate'],['id'=>10000042,'name'=>'Metropolis'],['id'=>10000043,'name'=>'Domain'],['id'=>10000044,'name'=>'Solitude'],['id'=>10000045,'name'=>'Tenal'],['id'=>10000046,'name'=>'Fade'],['id'=>10000047,'name'=>'Providence'],['id'=>10000048,'name'=>'Placid'],['id'=>10000049,'name'=>'Khanid'],['id'=>10000050,'name'=>'Querious'],['id'=>10000051,'name'=>'Cloud Ring'],['id'=>10000052,'name'=>'Kador'],['id'=>10000053,'name'=>'Cobalt Edge'],['id'=>10000054,'name'=>'Aridia'],['id'=>10000055,'name'=>'Branch'],['id'=>10000056,'name'=>'Feythabolis'],['id'=>10000057,'name'=>'Outer Ring'],['id'=>10000058,'name'=>'Fountain'],['id'=>10000059,'name'=>'Paragon Soul'],['id'=>10000060,'name'=>'Delve'],['id'=>10000061,'name'=>'Tenerifis'],['id'=>10000062,'name'=>'Omist'],['id'=>10000063,'name'=>'Period Basis'],['id'=>10000064,'name'=>'Essence'],['id'=>10000065,'name'=>'Kor-Azor'],['id'=>10000066,'name'=>'Perrigen Falls'],['id'=>10000067,'name'=>'Genesis'],['id'=>10000068,'name'=>'Verge Vendor'],['id'=>10000069,'name'=>'Black Rise'],['id'=>11000001,'name'=>'A-R00001'],['id'=>11000002,'name'=>'A-R00002'],['id'=>11000003,'name'=>'A-R00003'],['id'=>11000004,'name'=>'B-R00004'],['id'=>11000005,'name'=>'B-R00005'],['id'=>11000006,'name'=>'B-R00006'],['id'=>11000007,'name'=>'B-R00007'],['id'=>11000008,'name'=>'B-R00008'],['id'=>11000009,'name'=>'C-R00009'],['id'=>11000010,'name'=>'C-R00010'],['id'=>11000011,'name'=>'C-R00011'],['id'=>11000012,'name'=>'C-R00012'],['id'=>11000013,'name'=>'C-R00013'],['id'=>11000014,'name'=>'C-R00014'],['id'=>11000015,'name'=>'C-R00015'],['id'=>11000016,'name'=>'D-R00016'],['id'=>11000017,'name'=>'D-R00017'],['id'=>11000018,'name'=>'D-R00018'],['id'=>11000019,'name'=>'D-R00019'],['id'=>11000020,'name'=>'D-R00020'],['id'=>11000021,'name'=>'D-R00021'],['id'=>11000022,'name'=>'D-R00022'],['id'=>11000023,'name'=>'D-R00023'],['id'=>11000024,'name'=>'E-R00024'],['id'=>11000025,'name'=>'E-R00025'],['id'=>11000026,'name'=>'E-R00026'],['id'=>11000027,'name'=>'E-R00027'],['id'=>11000028,'name'=>'E-R00028'],['id'=>11000029,'name'=>'E-R00029'],['id'=>11000030,'name'=>'F-R00030'],['id'=>11000031,'name'=>'G-R00031'],['id'=>11000032,'name'=>'H-R00032'],['id'=>11000033,'name'=>'K-R00033']];
        foreach ($regions as $key=>$value) {
            Region::create($value);
        }
    }
}
