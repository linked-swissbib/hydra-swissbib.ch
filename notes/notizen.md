
### Installation der API-platform auf Basis von Symphony 4

https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheets

neu wird das Flex package bereitgestellt, welches es möglich macht, ganze packages über sog. recipes bereitzustellen
Zusätzlich werden noch Defaultkonfigurationen gesetzt

Voraussetzung ist jedoch, dass die Komponente ein solche "Pack" zur Verfügung stellt.

api-platform unterstützt dies

composer require api

s. auch https://gist.github.com/guenterh/e7f87436f468339038b92a43ab9688e9


###### offene Punkte ######

* wie kann man updaten?

Version 2.2.8 war installiert, composer update api startete jedoch keinen update auf die Version 3

Ich musste ****composer remove api**** und anschliessend ****composer install api**** laufen lassen

Sollen wir weiterhin mit dem package Mechanismus (Symphony4) arbeiten oder zurück zur native API und dem einfachen 
composer Mechanismus?

Es kann auch sein, dass durch den Einsatz der mitgelieferten client Version (Docker) hier noch Anpassungen 
notwendig sind.


 