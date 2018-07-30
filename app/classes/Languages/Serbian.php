<?php
namespace App\Languages;

use \App\Languages\Language as Language;


//PREVODI SRPSKI

class Serbian extends Language{

  public $site_title = "napjenu.com - BATRIĆEVIĆ & PRIJATELJI PRETRAGA SMJEŠTAJA";

  // =====opšti termini===========
  public $vlasnik = 'vlasnik';
  public $Vlasnik = 'Vlasnik';
  public $Mjesto = 'Mjesto';
  public $Objekat = 'Objekat';

  // ===amenities=======
  public $kuhinja = 'Kuhinja';
  public $kupatilo = 'Kupatilo';
  public $terasa = 'Terasa';
  public $klima = "Klima uređaj";
  public $tv = "TV";
  public $broj_kreveta = 'Broj kreveta';
  public $kreveta = 'Kreveta';
  public $trazi = 'Pretraga!';


// =====menu navigation============
public $menu_sobe = 'Sobe';
public $menu_objekti = "Objekti";
public $menu_kontakt = "Kontakt";

// =====sekcija sobe na index.php===========
public $objekat = "Objekat";
public $rooms_title1 = "Izaberite smještaj za sebe, a ostalo prepustite nama.";
public $rooms_title2 = "Dostupne sobe";


// ==datumi, kalendari====

public $dol_datum = "Dolazni datum";
public $odl_datum = "Odlazni datum";
public $nije_odabran = "nije odabrano";

public $izaberite_dolazak = 'Izaberite datum dolaska';
public $izaberite_odlazak = 'Izaberite datum odlaska';


    ///room selected, oko kalendara
    public $aranzman_naslov = "Mogućnost aranžmana";
    public $aranzman_podnaslov  = "Provjerite mogućnost i cijenu arnžmana odabirom željenih datuma";
    public $aranzman_moguc = 'Aranzman je moguć. Cijena:';
    public $sa_popustom = 'sa uračunatim popustom';
    public $aranzman_nemoguc = 'Aranzman nije moguć. Pokušajte sa drugim datumima.';
    public $izaberite_datume = 'Molimo, izaberite datume aranžmana.';


//room_selected contact
public $pogledajte_obj = 'Pogledajte objekat';
public $profil_vlasnika = 'Profil vlasnika';
public $poruka_soba = 'Pošaljite poruku o sobi';


//facilities.php
public $sva_mjesta = 'Sva mjesta';
public $objekti_naslov = "Dostupni objekti";

//facility.php
public $poruka_objekat = "Pošaljite poruku";
public $Adresa = "Adresa";
public $telefon1 = "Telefon 1";
public $telefon2 = "Telefon 2";
public $objekat_sobe_naslov = 'Sobe i apartmani u objektu';

//owner.php


public $Korisnik = "Korisnik";
public $ime_prezime = "Ime i prezime";
public $poruka_korisnik = "Pоšaljite poruku korisniku";
public $vlasnik_objekti_naslov = 'OBJEKTI VLASNIKA';
public $vlasnik_sobe_naslov = 'SOBE VLASNIKA';


// send_email.php
public $naslov_poruke = 'Naslov poruke';
public $vase_ime = "Vaše ime*";
public $vas_email = "Vaše e-mail*";
public $poruka = "Poruka";
public $default_poruka = "Tekst vaše poruke...";
public $posaljite = 'Pošaljite!';


}



?>
