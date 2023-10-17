<?php
    include_once('agenda.inc.php');

    $agenda = new Agenda();

    $contacto1 = new Contacto("Diego", "Rico", "Lopez", 1);
    $contacto2 = new Contacto("Alejandro", "Muñoz", "Gonzalez", 2);
    $contacto3 = new Contacto("Adrián", "Danvila", "Daria", 3);


    $agenda->addContact($contacto1);
    $agenda->addContact($contacto2);
    $agenda->addContact($contacto3);

    echo $agenda;

    $agenda->removeContact($contacto1);

    echo $agenda;
?>