<?php
namespace App\Languages;

use \App\Languages\Language as Language;

//PREVODI ENGLESKI

class English extends Language{

  public $site_title = "napjenu.com - BATRIĆEVIĆ & FRIENDS ROOMS IN HERCEG NOVI";
  // =====opšti termini===========
  public $vlasnik = 'owner';
  public $Vlasnik = 'Owner';
  public $Mjesto = 'Place';
  public $Objekat = 'Facility';

  // ===amenities=======

  public $kuhinja = 'Kitchen';
  public $kupatilo = 'Bathroom';
  public $terasa = 'Terrace';
  public $klima = "Air conditioner";
  public $tv = "TV";
  public $broj_kreveta = 'Beds';
  public $kreveta = 'Beds';
  public $trazi = 'Search!';


// =====menu navigation============
public $menu_sobe = 'Rooms';
public $menu_objekti = "Facilities";
public $menu_kontakt = "Contact";

// =====sekcija sobe na index.php===========
public $objekat = "Facility";
public $rooms_title1 = "Please choose room for yourself and let us do the rest.";
public $rooms_title2 = "Rooms available";


// ==datumi, kalendari====

public $dol_datum = "Arrival date";
public $odl_datum = "Departure date";
public $nije_odabran = "not selected";

public $izaberite_dolazak = 'Please Choose Arrival Date';
public $izaberite_odlazak = 'Please Choose Departure Date';


    ///room selected, oko kalendara
    public $aranzman_naslov = "Room Availability";
    public $aranzman_podnaslov  = "Check availability and prices by choosing desired dates";
    public $aranzman_moguc = 'All dates are available. Price:';
    public $sa_popustom = 'with included discount';
    public $aranzman_nemoguc = 'Not available. Please try with the other dates.';
    public $izaberite_datume = 'Please, choose dates.';


//room_selected contact
public $pogledajte_obj = 'Visit facility page';
public $profil_vlasnika = "Owner's profile";
public $poruka_soba = 'Send a question about the room';


//facilities.php
public $sva_mjesta = 'All locations';
public $objekti_naslov = "Facilities Available";

//facility.php
public $poruka_objekat = "Send a question about the facility";
public $Adresa = "Adress";
public $telefon1 = "Phone 1";
public $telefon2 = "Phone 2";
public $objekat_sobe_naslov = 'Rooms and Suites in The Facility';


//owner.php
public $Korisnik = "user";
public $ime_prezime = "Name";
public $poruka_korisnik = "Send a message to the user";
public $vlasnik_objekti_naslov = "OWNER'S FACILITIES";
public $vlasnik_sobe_naslov = "OWNERS ROOM'S";

// send_email.php
public $naslov_poruke = 'Subject';
public $vase_ime = "Your name*";
public $vas_email = "Your email*";
public $poruka = "Message";
public $default_poruka = "Message text here...";
public $posaljite = 'Send!';



}



?>
