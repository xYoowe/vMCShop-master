### Ta wersja nie jest już wspierana!

Wersja: **1.6.4**

### Ogłoszenia

Zapraszam do polubienia [FanPage](https://www.facebook.com/verlikylos)

### Opis

Sklep oferuje obsługę wielu serwerów i usług, dodawanie newsów z obrazkami, realizację voucherów oraz tworzenie stron z własną zawartością. Dashboard ACP zawiera kilka podstawowych informacji takich jak ilosć sprzedanych usług czy aktualne zarobki. Znajduje się tam również wykres sprzedaży usług w bieżącym tygodniu, status serwerów podpiętych do skryptu, lista ostatnich zakupów oraz logowań do ACP. Panel sklepu obsługuje wiele kont, dlatego została dodana zakładka logów sklepu, aby móc sprawdzić co i kiedy dany użytkownik zrobił. Podczas realizacji usługi czy vouchera sprawdzane jest czy serwer, na którym komenda ma być wykonana jest aktualnie online.

### Obsługiwani operatorzy płatności
- MicroSMS.pl
- Homepay.pl
- LvlUp.pro
- Pukawka.pl

### Funkcje sklepu
- [x] Strona główna z newsami, ostatnimi zakupami i statusem serwerów
- [x] Strona sklepu z listą usług
- [x] Logowanie do ACP
- [x] Dashboard z wykresem statystyk sprzedaży, statusem serwerów, ostatnimi zakupami dla poszczególnych serwerów, historią logowań do panelu i kilkoma podstawowymi informacjami
- [x] Dodawanie i usuwanie użytkowników ACP
- [x] Ustawienia konta użytkownika ACP ze zmianą hasła i avataru
- [x] Dodawanie i usuwanie serwerów
- [x] Dodawanie i usuwanie usług
- [x] Dodawanie i usuwanie newsów
- [x] Tworzenie i usuwanie stron z własną zawartością oraz przycisków nawigacji
- [x] Historia zakupów
- [x] Realizacja zakupów (Sprawdzanie czy serwer jest włączony podczas realizacji usługi)
- [x] Obsługa voucherów
- [x] Logi panelu administratora

### Wymagania
 - PHP 5.6
 - MySQL
 - Aktywne mod_rewrite

### Instalacja

1. Wgraj pliki na serwer www.
2. Importuj plik ```database.sql``` do swojej bazy danych MySQL.
3. Edytuj plik ```application/config/config.php```. Zmienną ```$config['base_url']``` ustaw na adres do swojej witryny. Przykład ```$config['base_url'] = 'https://vmcshop.pro/'```.
4. Edytuj plik ```application/config/database.php```. Zmienne ```'hostname' => 'adres bazy danych'```, ```'username' => 'nazwa użytkownika bazy danych'```, ```'password' => 'hasło do bazy danych'```, ```'database' => 'nazwa bazy danych'``` ustaw na wartosci odpowiadające Twojej bazie danych.
5. Edytuj plik ```application/config/settings.php```. Skonfiguruj go według upodobań. Ustawiasz tam między innymi dane do integracji z operatorem płatnosci, tło strony, logo itp.
6. Przejdź do witryny ```twojadomena.com/admin``` i zaloguj się używając domyslnych danych. (Login: Admin, Hasło: password).
7. Sklep jest gotowy do użycia.

### Licencja: **GNU GPLv3**
