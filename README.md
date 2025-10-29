# Programowanie-aplikacji-internetowych
🚀 Opis Projektu

Prosty system logowania i rejestracji napisany w PHP z wykorzystaniem MySQL. System umożliwia użytkownikom rejestrację, logowanie oraz dostęp do panelu użytkownika.

✨ Funkcjonalności

🔐 Rejestracja nowych użytkowników
🔑 Logowanie do systemu
🛡️ Zarządzanie sesjami użytkowników
🎨 Responsywny interfejs
🚪 Bezpieczne wylogowanie
📊 Panel użytkownika (dashboard)
🛠️ Wymagania Techniczne

PHP 7.4 lub nowszy
MySQL 5.7 lub nowszy
Serwer WWW (Apache, Nginx)
Przeglądarka internetowa z obsługą CSS3
📁 Struktura Plików

text
/
├── index.php          # Strona powitalna
├── index.html         # Formularz logowania
├── login.php          # Obsługa logowania
├── register.php       # Rejestracja użytkownika
├── dashboard.php      # Panel użytkownika
├── logout.php         # Wylogowanie
├── styl1.css          # Style dla formularzy
├── dashboard.css      # Style dla panelu
└── README.md          # Ten plik
⚙️ Instalacja i Konfiguracja

1. 🗃️ Przygotowanie Bazy Danych

Utwórz bazę danych i tabelę dla użytkowników:

sql
CREATE DATABASE login_demo;
USE login_demo;

CREATE TABLE logins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL UNIQUE,
    passwd VARCHAR(255) NOT NULL
);
2. ⚙️ Konfiguracja Połączenia z Bazą Danych

Edytuj pliki login.php i register.php i ustaw swoje dane dostępowe:

php
$servername = "localhost";
$username = "twoja_nazwa_uzytkownika";
$password = "twoje_haslo";
$dbname = "login_demo";

3. 🌐 Wgranie na Serwer

Skopiuj wszystkie pliki na swój serwer WWW w odpowiednim katalogu (np. public_html lub htdocs).

🎯 Jak Używać

Rejestracja
📝 Wejdź na register.php
👤 Wprowadź login i hasło (potwierdź hasło)
✅ Kliknij "Zarejestruj"
🔄 Zostaniesz przekierowany do strony logowania

Logowanie
🔑 Wejdź na index.html lub login.php
👤 Wprowadź login i hasło
✅ Kliknij "Zaloguj"
🎉 Zostaniesz przekierowany do panelu użytkownika

Panel Użytkownika
👋 Widzisz spersonalizowane powitanie
🧭 Masz dostęp do menu nawigacyjnego
🚪 Możesz się wylogować przyciskiem "Wyloguj"
🔒 Uwagi Bezpieczeństwa

👨‍💻 Rozwój
Możliwe rozszerzenia funkcjonalności:
📧 Potwierdzenie rejestracji przez email
🔄 Zmiana hasła
👥 Różne poziomy dostępu (admin/user)
📝 Edycja profilu użytkownika
🔐 Ochrona przed brute force

📄 Licencja
Projekt open-source. Możesz go dowolnie modyfikować i używać.

🤝 Kontakt
Masz pytania lub potrzebujesz pomocy?
Sprawdź kod źródłowy lub skontaktuj się z developerm! 🚀

💫 Miłego korzystania z systemu logowania!
