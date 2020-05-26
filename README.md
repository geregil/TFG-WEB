# TFG-WEB
Racó d'Estudi - Plataforma educativa online

Projecte de final de grau, enginyeria informàtica UOC.

# Què és?
El Racó d'Estudi és una plataforma educativa online que s'ha creat com a projecte de final de grau, dels estudis de Enginyeria informàtica de la UOC. Aquesta plataforma permet registrar-te com alumne o professor i tenir una sèrie d'eines online per tal de poder donar serveis d'estudis a distància.

# Instal·lació?
Per instal·lar el projecte és necessari un hosting compatible amb PHP 7.4.0 i base de dades MYSQL 5.7.28. 
Per exemple el que jo he fet servir és el WAMP SERVER x32 bits per desenvolupar el projecte de forma offline al teu pc.

Cal tenir les llibreries de Bootstrap i jQuery.

Importar la base de dades del projecte al gestor de base de dades MYSQL. 
Carpeta WEB/BD/racoestudi.sql amb dummy data, si voleu buidar les dades entrar al gestor de base de dades i buidar les taules. 
usuari: root, password: " "(en blanc). 
Assegurar-se que la base de dades està aquí: $conn = mysqli_connect('localhost:3308','root','','racoestudi'); 
Sinó la connexió no funcionarà.

Finalment un cop importada la base de dades, carregar tots els arxius WEB al hosting per tal de poder accedir-hi amb el navegador.


Atentament,
Gerard
Estudiant d'Enginyeria Informàtica de la UOC.
