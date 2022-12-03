<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Time {
    //attributes
    public $value = 1;
    public $arrange = array();
}

class EventController extends Controller
{
    //segregateTime
    //rearrangeTime

    public function segregateTime(): void {
        //Pobiera użytkownika
        //Pętla po dniach od dzisiaj do x => x = ostatni_event.dzień + 7
            //Pobiera godziny lekcji przed i po.
            //Pobiera start i koniec dnia (NOWE USTAWIENIE) [GODZINY PRACY]
            //Pobieranie eventów z tego dnia
            //Liczy optymalny czas pracy tego dnia i maksymalny pracy tego dnia
                //OPTIMAL: MAX / 2
                //MAXIMAL: 1440 => 1440 = min_dnia => 1440 - [ CZAS PRACY + PRZERWY(set_by_user) ]

    }
}
