# Skupina19 WEBTECH2 FEI STU API

![type](https://img.shields.io/badge/FEI-School_Project-blue.svg)
![version](https://img.shields.io/badge/version-0.0.1-lightgray.svg)
![status](https://img.shields.io/badge/status-development-red.svg)
![licence](https://img.shields.io/badge/licence-MIIT-blue.svg)

## Rady

### Git

* Žiadne force-push/rebase/squash (len pokiaľ viete čo robíte)
* Pokiaľ git moc neovládate/preferujete GUI, radím GitKraken

### Frontend

* Prosím robte úlohy/ich časti ideálne ako funkcie ktoré budú vraciať nejaký objekt, lepšie sa s tým potom pracuje
* Napíšte mi potom samozrejme že aká funkcia bude cca čo vraciať (myslím že aký štýl objektu)

### Backend

* Dám vám môj __config.php__, je tam celá práca s db predkódená (tento budem aj includovať všade aby ste nemuseli vy), stačí tam zmeniť len dbinfo a práca s tým vyzerá napr. takto:

    ```php
    //dbStatement("statement",isSelect?);
    <?php
        //some code..
        if(dbConnect()){
            dbStatement("INSERT INTO table(column) VALUES ($v1)",false);
            $result = dbStatement("SELECT * from table", true);
        }
        //continue code..
        echo '<pre>';
        print_r($result);
        echo '</pre>';
    ?>
    ```

* Samozrejme môžte mať aj vlastný konfigurák atď, len mi potom dajte niekde koment aby som vedel že používate niečo iné
* Hádžte mi pls aj .sql súbory keď vám to už pôjde aby som to dal do jednej db, alebo možem skúsiť rozchodiť keďtak aj nejakú free mysql db aby sme celú db aby sme mali údaje na jednom mieste (rýchlejšie importy na vlastné servery)
* Budete tam mať aj __test.php__, je to presne čo si myslíte

## Authors

* __Silvia Holecová__ - [Sisuska](https://github.com/Sisuska)
* __Patrícia Hulinová__ - [xhulinova](https://github.com/xhulinova)
* __Alena Jankajová__ - [PiaAli](https://github.com/PiaAli)
* __Lukáš Odler__ - [ZukyDesigns](https://github.com/zukydesigns)
* __Rastislav Uhrin__ - [Rasto538](https://github.com/TheHawk43)

## Licence

This project is licensed under the MIT License - see the [LICENSE.md](https://github.com/zukydesigns/area19/blob/master/LICENSE) file for details.