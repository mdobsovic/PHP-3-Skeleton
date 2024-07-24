<?php

function generujHeslo(): string
{
    // heslo bude vyzerat nasledovne:
    // (VELKE PISMENO) (tri male pismena) (znak ./*-+) (styri cisla)
    // Dxoa.5729      Vdpw*6514
    $specialneZnaky = ['.', '/', '*', '-', '+'];

    // $heslo .= "nieco" je to iste ako keby som napisal $heslo = $heslo . "nieco"
    $heslo = chr(rand(65,90)); // znak, kt. ASCII kod je od 65 do 90 - A-Z
    $heslo .= chr(rand(97,122)) . chr(rand(97,122)) . chr(rand(97,122)); // 3 male pismena
    $heslo .= $specialneZnaky[rand(0, count($specialneZnaky) - 1)]; // z pola specialneZnaky vyberiem jeden nahodny prvok ($specialneZnaky[0], $specialneZnaky[1], ....)
    $heslo .= rand(1000, 9999); // pridam do hesla nahodne cislo od 1000 do 9999

    return $heslo;
}