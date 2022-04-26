<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function set_tab0_session() {
        session()->forget('tab0');
        session()->forget('tab1');
        session()->forget('tab2');
        session()->forget('tab3');
        session()->forget('tab4');
        session()->forget('tab5');
        session(['tab0' => 'value']);
    }

    public function set_tab1_session() {
        session()->forget('tab0');
        session()->forget('tab1');
        session()->forget('tab2');
        session()->forget('tab3');
        session()->forget('tab4');
        session()->forget('tab5');
        session(['tab1' => 'value']);
    }

    public function set_tab2_session() {
        session()->forget('tab0');
        session()->forget('tab1');
        session()->forget('tab2');
        session()->forget('tab3');
        session()->forget('tab4');
        session()->forget('tab5');
        session(['tab2' => 'value']);
    }

    public function set_tab3_session() {
        session()->forget('tab0');
        session()->forget('tab1');
        session()->forget('tab2');
        session()->forget('tab3');
        session()->forget('tab4');
        session()->forget('tab5');
        session(['tab3' => 'value']);
    }

    public function set_tab4_session() {
        session()->forget('tab0');
        session()->forget('tab1');
        session()->forget('tab2');
        session()->forget('tab3');
        session()->forget('tab4');
        session()->forget('tab5');
        session(['tab4' => 'value']);
    }

    public function set_tab5_session() {
        session()->forget('tab0');
        session()->forget('tab1');
        session()->forget('tab2');
        session()->forget('tab3');
        session()->forget('tab4');
        session()->forget('tab5');
        session(['tab5' => 'value']);
    }
}
